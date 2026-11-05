<?php
namespace App\Services;

use App\Core\Logger;
use App\Core\Mail\Mail;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as DB;
use RuntimeException;
use Throwable;

/**
 * Applies PayPal's result to a payout, for the PayPal webhook and for payouts:sync-paypal.
 *
 * Same rules as affcp_payout_sync_one() in wp-affiliates-coupons, which an admin can run from the
 * Payouts screen; keep the two in step. All of them may run at once: a status only moves if it is
 * still the one that was read, so one wins and the others do nothing, and the refund commits with
 * its status change.
 */
class PayoutResultService
{
    public const TABLE = 'affcp_withdrawals';

    private const GIVE_BACK = ['FAILED', 'RETURNED', 'BLOCKED', 'REFUNDED', 'REVERSED'];

    private PayPalPayoutsService $paypal;

    public function __construct(?PayPalPayoutsService $paypal = null)
    {
        $this->paypal = $paypal ?? new PayPalPayoutsService();
    }

    public function paypal(): PayPalPayoutsService
    {
        return $this->paypal;
    }

    /**
     * Handles one webhook delivery.
     *
     * The event is only a signal. Its signature proves it came from PayPal; the result itself is
     * read from PayPal, so the event's own contents decide nothing.
     *
     * A 5xx makes PayPal send it again, and payouts:sync-paypal catches anything still missed.
     *
     * @return array{0:int, 1:array} HTTP status and body.
     */
    public function handleWebhook(string $raw, array $headers): array
    {
        $event = json_decode($raw, true);

        if (!is_array($event) || empty($headers['Paypal-Transmission-Sig'])) {
            return [400, ['error' => 'Not a PayPal webhook.']];
        }

        if ($this->paypal->webhookId() === '') {
            Logger::warning('PayPal webhook received, but no webhook ID is saved for the active mode.');
            return [503, ['error' => 'Webhook not configured.']];
        }

        try {
            if (!$this->paypal->verifyWebhook($headers, $raw)) {
                Logger::warning('PayPal webhook refused: the signature did not verify.');
                return [400, ['error' => 'Invalid signature.']];
            }

            if (!str_starts_with((string) ($event['event_type'] ?? ''), 'PAYMENT.PAYOUTS')) {
                return [200, ['result' => 'ignored']];
            }

            $resource = $event['resource'] ?? [];
            $batchId  = (string) ($resource['payout_batch_id'] ?? $resource['batch_header']['payout_batch_id'] ?? '');

            // Not found: another site sharing this sandbox, or WordPress has not saved the batch ID
            // yet. In that second case the job picks it up.
            $payout = $batchId === '' ? null : DB::table(self::TABLE)
                ->where('paypal_batch_id', $batchId)
                ->whereIn('status', ['processing', 'paid'])
                ->first();

            if (!$payout) {
                return [200, ['result' => 'ignored']];
            }

            return [200, ['result' => $this->apply($payout)]];
        } catch (Throwable $e) {
            Logger::warning('PayPal webhook failed: ' . $e->getMessage());
            return [500, ['error' => 'Could not process the event.']];
        }
    }

    /**
     * Reads a payout's batch from PayPal and applies the result.
     *
     * A paid payout can still be given back, when PayPal reports it refunded or reversed later.
     *
     * @return string 'paid', 'returned', 'waiting' or 'skipped'.
     * @throws RuntimeException When PayPal cannot be read, or another run handled the payout first.
     */
    public function apply(object $payout): string
    {
        $body   = $this->paypal->getBatch($payout->paypal_batch_id);
        $item   = $body['items'][0] ?? [];
        $batch  = strtoupper((string) ($body['batch_header']['batch_status'] ?? ''));
        $status = strtoupper((string) ($item['transaction_status'] ?? ''));
        $isPaid = $payout->status === 'paid';

        $data = ['paypal_status' => $status !== '' ? $status : $batch];
        if (!empty($item['payout_item_id'])) {
            $data['paypal_item_id'] = (string) $item['payout_item_id'];
        }

        if (in_array($status, self::GIVE_BACK, true) || ($status === '' && in_array($batch, ['DENIED', 'CANCELED'], true))) {
            $data['status']  = 'returned';
            $data['paid_at'] = null;

            return $this->giveBack($payout, $data);
        }

        if ($isPaid) {
            return 'skipped';
        }

        if ($status === 'SUCCESS') {
            $data['status']  = 'paid';
            $data['paid_at'] = Carbon::now('UTC')->format('Y-m-d H:i:s');

            // When the platform pays, keep what it really cost. An affiliate's fee stays what they were shown.
            if ($payout->fee_payer === 'platform' && isset($item['payout_item_fee']['value'])) {
                $data['fee'] = (string) $item['payout_item_fee']['value'];
            }

            if ($this->move($payout, $data) !== 1) {
                return 'skipped';
            }

            $this->notify($payout, 'paid');
            return 'paid';
        }

        // Pending or unclaimed: wait. PayPal reports RETURNED after 30 days if nobody claims it.
        $this->move($payout, $data);

        return 'waiting';
    }

    private function giveBack(object $payout, array $data): string
    {
        $result = CreditLedgerService::post('affiliate', (int) $payout->affiliate_id, [
            'bucket'          => 'earnings',
            'entry_type'      => 'withdraw_return',
            'amount'          => (float) $payout->amount,
            'reference_type'  => 'payout',
            'reference_id'    => $payout->payout_id,
            'idempotency_key' => 'payout_return_' . $payout->payout_id,
            'public_note'     => 'Withdrawal request of $' . number_format((float) $payout->amount, 2) . ' was returned by PayPal. The amount is back in your balance.',
            'source'          => 'api_cron',
        ], [
            // Same transaction as the refund: if another run got here first, nothing is written.
            'inside' => function () use ($payout, $data) {
                if ($this->move($payout, $data) !== 1) {
                    throw new RuntimeException('already handled.');
                }
            },
        ]);

        if (!empty($result['duplicate'])) {
            return 'skipped';
        }

        $this->notify($payout, 'returned');

        return 'returned';
    }

    /** Changes a payout only while it still has the status that was read. Returns the rows changed. */
    private function move(object $payout, array $data): int
    {
        return DB::table(self::TABLE)
            ->where('payout_id', $payout->payout_id)
            ->where('status', $payout->status)
            ->update($data);
    }

    /** The payout is already saved, so a failed email must not stop the run. */
    private function notify(object $payout, string $status): void
    {
        try {
            $user = DB::table('users')->where('ID', $payout->user_id)->first(['user_email', 'display_name']);
            if (!$user || !$user->user_email) {
                return;
            }

            $firstName = DB::table('usermeta')->where(['user_id' => $payout->user_id, 'meta_key' => 'first_name'])->value('meta_value');
            $pageId    = get_settings_option(['affcp_settings' => ['affiliates_page']]);
            $fresh     = DB::table(self::TABLE)->where('payout_id', $payout->payout_id)->first();

            $subject = $status === 'paid' ? 'Your withdrawal has been paid' : 'Your withdrawal was returned';

            Mail::send($user->user_email, $subject, 'payout-result', [
                'payout'     => $fresh ?: $payout,
                'status'     => $status,
                'name'       => $firstName ?: $user->display_name,
                'payoutsUrl' => rtrim((string) get_settings_option('home'), '/') . '/?page_id=' . (int) $pageId . '&tab=payouts&show=withdraw',
            ]);
        } catch (Throwable $e) {
            Logger::warning("PayPal payout #{$payout->payout_id}: email failed: " . $e->getMessage());
        }
    }
}
