<?php
namespace App\Services;

use App\Core\Logger;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as DB;
use RuntimeException;
use Stripe\Charge;
use Stripe\Dispute;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\Webhook;
use Throwable;
use UnexpectedValueException;

/**
 * Records a refunded assessment payment and takes back the affiliate's commission.
 *
 * The one place refund logic lives. It is reached from:
 *   - POST /api/v1/webhooks/stripe   charge.refunded, charge.dispute.funds_withdrawn (card + wallets)
 *   - POST /api/v1/webhooks/paypal   PAYMENT.CAPTURE.REFUNDED / REVERSED (PayPal Express + Venmo)
 *   - ProcessRefundJob               queued by WordPress: the PayPal Standard IPN, and the admin
 *                                    "Mark as refunded" button
 *   - commissions:backfill-refunds   refunds issued before this existed
 *
 * Refunds are always full (business rule): a partial refund is logged and left alone.
 *
 * The payment keeps status 'captured', so the participant keeps their report; the refund is saved in
 * the payment's refund_* columns and as a 'refund' row in mytemp_transactions. Both run once per
 * payment (the payment row only moves while refund_status is empty); the commission step is
 * idempotent too, so a repeated webhook or job changes nothing.
 */
class RefundService
{
    public const PAYMENTS     = 'mytemp_assessment_payments';
    public const TRANSACTIONS = 'mytemp_transactions';

    private CommissionService $commissions;

    public function __construct(?CommissionService $commissions = null)
    {
        $this->commissions = $commissions ?? new CommissionService();
    }

    /**
     * Records a refund for the assessment payment made with one of the given gateway IDs
     * (Stripe ch_ / pi_, PayPal capture ID, PayPal Standard txn_id).
     *
     * @param string[] $chargeIds
     * @param array    $refund refund_id, amount, source ('system'|'api_cron'|'wp_admin'), gateway, actor_user_id.
     * @return string 'ignored' when the charge is not an assessment payment of this site, otherwise
     *                the commission result ('none', 'cancelled', 'reversed', 'already', 'missing_entry').
     */
    public function recordByCharge(array $chargeIds, array $refund): string
    {
        $payment = $this->findPaymentByCharge($chargeIds);

        if (!$payment) {
            return 'ignored';
        }

        return $this->recordForPayment($payment, $refund);
    }

    /** Same as recordByCharge(), for an assessment ID (admin button). */
    public function recordByAssessment(int $assessmentId, array $refund): string
    {
        $payment = DB::table(self::PAYMENTS)->where('assessment_id', $assessmentId)->orderByDesc('payment_id')->first();

        if (!$payment) {
            throw new RuntimeException("Assessment #{$assessmentId} has no payment.");
        }

        return $this->recordForPayment($payment, $refund);
    }

    /** The assessment payment behind a gateway ID, or null. */
    public function findPaymentByCharge(array $chargeIds): ?object
    {
        $chargeIds = array_values(array_filter(array_map('strval', $chargeIds), static fn($id) => $id !== ''));
        if (!$chargeIds) {
            return null;
        }

        $transaction = DB::table(self::TRANSACTIONS)
            ->whereIn('charge_id', $chargeIds)
            ->where('transaction_type', 'assessment')
            ->orderByDesc('transaction_id')
            ->first();

        if (!$transaction) {
            return null;
        }

        return DB::table(self::PAYMENTS)->where('transaction_id', (string) $transaction->transaction_id)->orderByDesc('payment_id')->first();
    }

    /**
     * @return string Commission result (see recordByCharge()), or 'not_paid'.
     */
    public function recordForPayment(object $payment, array $refund): string
    {
        $assessmentId = (int) $payment->assessment_id;
        $refundId     = (string) ($refund['refund_id'] ?? '');
        $source       = (string) ($refund['source'] ?? 'system');
        $gateway      = (string) ($refund['gateway'] ?? $payment->payment_method ?? '');
        $actor        = (int) ($refund['actor_user_id'] ?? 0);

        if (!in_array(strtolower((string) $payment->status), ['captured', 'paid'], true) || (float) $payment->end_price <= 0) {
            Logger::warning("Refund {$refundId}: assessment #{$assessmentId} has no paid payment (status {$payment->status}, price {$payment->end_price}); nothing recorded.");
            return 'not_paid';
        }

        $amount = isset($refund['amount']) && is_numeric($refund['amount']) && (float) $refund['amount'] > 0
            ? (float) $refund['amount']
            : (float) $payment->end_price;

        $now = Carbon::now('UTC')->format('Y-m-d H:i:s');

        $recorded = DB::connection()->transaction(function () use ($payment, $refundId, $amount, $gateway, $assessmentId, $now) {
            $moved = DB::table(self::PAYMENTS)
                ->where('payment_id', $payment->payment_id)
                ->whereNull('refund_status')
                ->update([
                    'refund_status'   => 'refunded',
                    'refund_id'       => $refundId !== '' ? mb_substr($refundId, 0, 255) : null,
                    'refund_amount'   => CreditLedgerService::normalise($amount),
                    'refund_datetime' => $now,
                ]);

            if ($moved !== 1) {
                return false;
            }

            DB::table(self::TRANSACTIONS)->insert([
                'object_id'               => (int) $payment->participant_id,
                'transaction_object_type' => 'participant',
                'transaction_type'        => 'refund',
                'amount'                  => CreditLedgerService::normalise($amount),
                'status'                  => 'success',
                'charge_id'               => $refundId !== '' ? $refundId : null,
                'notes'                   => 'Refund of $' . number_format($amount, 2) . ' for assessment #' . $assessmentId . ($gateway !== '' ? ' (' . $gateway . ')' : ''),
                'created_datetime'        => $now,
            ]);

            return true;
        });

        $result = $this->commissions->onRefund($assessmentId, $refundId !== '' ? $refundId : 'manual', $source, $actor);

        Logger::info("Refund {$refundId} for assessment #{$assessmentId}: " . ($recorded ? 'recorded' : 'already recorded') . ", commission {$result}.");

        return $result;
    }

    // ---------------------------------------------------------------------------------------------
    // Stripe

    /**
     * Handles one Stripe webhook delivery.
     *
     * The signature proves the event came from Stripe; the charge is then read back from Stripe, so
     * the event's own contents decide nothing. A 5xx makes Stripe send it again.
     *
     * @return array{0:int, 1:array} HTTP status and body.
     */
    public function handleStripeWebhook(string $raw, array $headers): array
    {
        $secret = $this->stripeWebhookSecret();
        if ($secret === '') {
            Logger::warning('Stripe webhook received, but no signing secret is saved (Plugin 1 Settings > Payments > Webhook Signing Secret, or STRIPE_WEBHOOK_SECRET in .env).');
            return [503, ['error' => 'Webhook not configured.']];
        }

        try {
            $event = Webhook::constructEvent($raw, (string) ($headers['Stripe-Signature'] ?? ''), $secret);
        } catch (SignatureVerificationException | UnexpectedValueException $e) {
            Logger::warning('Stripe webhook refused: ' . $e->getMessage());
            return [400, ['error' => 'Invalid signature.']];
        }

        if (!in_array($event->type, ['charge.refunded', 'charge.dispute.funds_withdrawn'], true)) {
            return [200, ['result' => 'ignored']];
        }

        try {
            $object   = $event->data->object;
            $chargeId = $event->type === 'charge.refunded' ? (string) $object->id : (string) $object->charge;

            // Not an assessment payment of this site (credit purchase, another site): nothing to do.
            $ids = array_filter([$chargeId, is_string($object->payment_intent ?? null) ? $object->payment_intent : null]);
            if (!$this->findPaymentByCharge($ids)) {
                return [200, ['result' => 'ignored']];
            }

            Stripe::setApiKey((string) get_settings_option('mytemp_settings.stripe_secret_key'));
            $charge = Charge::retrieve($chargeId);
            $ids    = array_filter([(string) $charge->id, is_string($charge->payment_intent) ? $charge->payment_intent : null]);

            if ($event->type === 'charge.refunded') {
                if (!$charge->refunded) {
                    Logger::warning("Stripe charge {$charge->id} is only partly refunded; refunds are expected to be full, so nothing was changed.");
                    return [200, ['result' => 'partial_ignored']];
                }

                $latest = Refund::all(['charge' => $charge->id, 'limit' => 1])->data[0] ?? null;
                $refund = [
                    'refund_id' => $latest ? (string) $latest->id : (string) $event->id,
                    'amount'    => $charge->amount_refunded / 100,
                    'gateway'   => 'stripe',
                ];
            } else {
                $dispute = Dispute::retrieve((string) $object->id);
                $refund  = [
                    'refund_id' => (string) $dispute->id,
                    'amount'    => $dispute->amount / 100,
                    'gateway'   => 'stripe dispute',
                ];
            }

            return [200, ['result' => $this->recordByCharge($ids, $refund + ['source' => 'system'])]];
        } catch (Throwable $e) {
            Logger::warning("Stripe webhook {$event->id} failed: " . $e->getMessage());
            return [500, ['error' => 'Could not process the event.']];
        }
    }

    /**
     * The Stripe endpoint's signing secret: Plugin 1's setting (Settings > Payments, next to the
     * Stripe keys), else STRIPE_WEBHOOK_SECRET in .env.
     */
    private function stripeWebhookSecret(): string
    {
        $saved = trim((string) get_settings_option('mytemp_settings.stripe_webhook_secret'));

        return $saved !== '' ? $saved : trim((string) getenv('STRIPE_WEBHOOK_SECRET'));
    }

    // ---------------------------------------------------------------------------------------------
    // PayPal (Orders v2: PayPal Express and Venmo)

    /**
     * Handles PAYMENT.CAPTURE.REFUNDED / REVERSED. The signature was already checked by
     * PayoutResultService::handleWebhook(); the capture is read back from PayPal here.
     *
     * @return array{0:int, 1:array} HTTP status and body.
     */
    public function handlePayPalCaptureEvent(array $event, PayPalPayoutsService $paypal): array
    {
        $type = (string) ($event['event_type'] ?? '');
        if (!in_array($type, ['PAYMENT.CAPTURE.REFUNDED', 'PAYMENT.CAPTURE.REVERSED'], true)) {
            return [200, ['result' => 'ignored']];
        }

        $resource  = $event['resource'] ?? [];
        $captureId = '';
        foreach ((array) ($resource['links'] ?? []) as $link) {
            if (($link['rel'] ?? '') === 'up' && preg_match('#/captures/([^/?]+)#', (string) ($link['href'] ?? ''), $m)) {
                $captureId = $m[1];
                break;
            }
        }
        if ($captureId === '' && isset($resource['final_capture'])) {
            $captureId = (string) ($resource['id'] ?? ''); // The resource is the capture itself.
        }

        if ($captureId === '' || !$this->findPaymentByCharge([$captureId])) {
            return [200, ['result' => 'ignored']];
        }

        $capture = $paypal->getCapture($captureId);
        $status  = strtoupper((string) ($capture['status'] ?? ''));

        if ($status === 'PARTIALLY_REFUNDED') {
            Logger::warning("PayPal capture {$captureId} is only partly refunded; refunds are expected to be full, so nothing was changed.");
            return [200, ['result' => 'partial_ignored']];
        }

        if (!in_array($status, ['REFUNDED', 'REVERSED'], true)) {
            Logger::warning("PayPal {$type} for capture {$captureId}, but PayPal reports it {$status}; nothing changed.");
            return [200, ['result' => 'ignored']];
        }

        $result = $this->recordByCharge([$captureId], [
            'refund_id' => (string) ($resource['id'] ?? $event['id'] ?? ''),
            'amount'    => $capture['amount']['value'] ?? null,
            'gateway'   => $type === 'PAYMENT.CAPTURE.REVERSED' ? 'paypal reversal' : 'paypal',
            'source'    => 'system',
        ]);

        return [200, ['result' => $result]];
    }
}
