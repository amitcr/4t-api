<?php
namespace App\Services;

use App\Core\Logger;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as DB;
use RuntimeException;
use Throwable;

/**
 * Affiliate commission after an assessment payment: release when the hold ends, cancel or reverse
 * on refund.
 *
 * WordPress (wp-affiliates-coupons, affcp_hold_affiliate_commission()) puts a new commission on hold:
 * an "on hold" ledger row that changes no balance, and the relationship row marked
 * transfer_status = 'pending' with commission_amount, commission_affiliate_id and
 * commission_release_at. From there:
 *
 *   pending  --release-->  success    ledger 'transfer' (+amount), key commission_<relationship id>
 *   pending  --refund--->  cancelled  ledger 'commission_cancel', status 'cancelled' (balance unchanged)
 *   success  --refund--->  reversed   ledger 'commission_reversal' (-amount, may go negative)
 *
 * Every status change commits in the same transaction as its ledger entry, and only moves from the
 * status that was read. The ledger locks the affiliate row, so a release and a refund for the same
 * commission run one after the other: the second finds the status changed, and the refund then
 * retries from the new status.
 */
class CommissionService
{
    public const TABLE = 'affcp_assessment_relationship';

    /**
     * Releases every held commission whose hold has ended and whose payment was not refunded.
     *
     * @return array{released:int, errors:int}
     */
    public function releaseDue(int $limit = 200): array
    {
        $counts = ['released' => 0, 'errors' => 0];

        $rows = DB::table(self::TABLE)
            ->where('transfer_status', 'pending')
            ->whereNull('refund_status')
            ->whereNotNull('commission_release_at')
            ->where('commission_release_at', '<=', $this->now())
            ->orderBy('commission_release_at')
            ->limit($limit)
            ->get();

        foreach ($rows as $row) {
            try {
                if ($this->release($row)) {
                    $counts['released']++;
                }
            } catch (Throwable $e) {
                $counts['errors']++;
                Logger::warning("commissions:release: relationship #{$row->id} (assessment #{$row->assessment_id}): " . $e->getMessage());
            }
        }

        return $counts;
    }

    /**
     * Adds one held commission to the affiliate's earnings.
     *
     * @return bool True when released by this call.
     */
    public function release(object $row): bool
    {
        $amount      = (float) $row->commission_amount;
        $affiliateId = (int) $row->commission_affiliate_id;

        if ($amount <= 0 || $affiliateId <= 0) {
            throw new RuntimeException('no commission amount or affiliate saved on the row.');
        }

        $result = CreditLedgerService::post('affiliate', $affiliateId, [
            'bucket'          => 'earnings',
            'entry_type'      => 'transfer',
            'amount'          => $amount,
            'reference_type'  => 'assessment',
            'reference_id'    => $row->assessment_id,
            'idempotency_key' => 'commission_' . $row->id,
            'public_note'     => 'Commission of $' . number_format($amount, 2) . ' for ' . $this->subject((int) $row->assessment_id) . ' added to your balance after the hold period.',
            'admin_note'      => 'Assessment #' . $row->assessment_id . '.',
            'source'          => 'api_cron',
        ], [
            'inside' => function (array $result) use ($row) {
                $moved = DB::table(self::TABLE)
                    ->where('id', $row->id)
                    ->where('transfer_status', 'pending')
                    ->whereNull('refund_status')
                    ->update([
                        'transfer_status'   => 'success',
                        'transfer_id'       => (string) $result['entry_id'],
                        'transfer_datetime' => $this->now(),
                        'update_datetime'   => $this->now(),
                    ]);

                if ($moved !== 1) {
                    throw new RuntimeException('changed by another run (refunded or released).');
                }
            },
        ]);

        // The key was already used, so the money is in: bring the row in line.
        if (!empty($result['duplicate'])) {
            DB::table(self::TABLE)
                ->where('id', $row->id)
                ->where('transfer_status', 'pending')
                ->update(['transfer_status' => 'success', 'transfer_id' => (string) $result['entry_id'], 'transfer_datetime' => $this->now(), 'update_datetime' => $this->now()]);
            return false;
        }

        return true;
    }

    /**
     * Applies a refund of an assessment payment to its commission.
     *
     * @param int    $assessmentId Assessment ID.
     * @param string $refundRef    Gateway refund / dispute ID (or a manual reference), for the notes.
     * @param string $source       Ledger source: 'system' (webhook), 'api_cron', 'wp_admin'.
     * @param int    $actorUserId  Admin who marked it, if any.
     * @return string 'none', 'cancelled', 'reversed', 'already' or 'missing_entry'.
     */
    public function onRefund(int $assessmentId, string $refundRef, string $source = 'system', int $actorUserId = 0): string
    {
        // A release can win the race; then the refund retries once from the new status.
        for ($attempt = 0; $attempt < 2; $attempt++) {
            $row = DB::table(self::TABLE)->where('assessment_id', $assessmentId)->orderByDesc('id')->first();

            if (!$row) {
                return 'none';
            }

            try {
                return match ((string) $row->transfer_status) {
                    ''                     => $this->markRefundedWithoutCommission($row),
                    'pending'              => $this->cancel($row, $refundRef, $source, $actorUserId),
                    'success'              => $this->reverse($row, $refundRef, $source, $actorUserId),
                    'cancelled', 'reversed' => 'already',
                    default                => throw new RuntimeException("unknown transfer_status {$row->transfer_status}."),
                };
            } catch (RuntimeException $e) {
                if ($attempt === 1 || !str_contains($e->getMessage(), 'changed by another run')) {
                    throw $e;
                }
            }
        }

        return 'already';
    }

    /**
     * No commission was held or paid (yet). Mark the row so a later "finished" hook does not hold one.
     */
    private function markRefundedWithoutCommission(object $row): string
    {
        $moved = DB::table(self::TABLE)
            ->where('id', $row->id)
            ->where(fn($q) => $q->whereNull('transfer_status')->orWhere('transfer_status', ''))
            ->whereNull('refund_status')
            ->update(['refund_status' => 'refunded', 'refunded_at' => $this->now(), 'update_datetime' => $this->now()]);

        if ($moved !== 1 && $row->refund_status === null) {
            throw new RuntimeException('changed by another run (commission held meanwhile).');
        }

        return 'none';
    }

    /** Refund during the hold: the commission never reaches the balance. */
    private function cancel(object $row, string $refundRef, string $source, int $actorUserId): string
    {
        $amount = number_format((float) $row->commission_amount, 2);

        $result = CreditLedgerService::post('affiliate', (int) $row->commission_affiliate_id, [
            'bucket'          => 'earnings',
            'entry_type'      => 'commission_cancel',
            'amount'          => -1 * (float) $row->commission_amount,
            'status'          => 'cancelled',
            'reference_type'  => 'assessment',
            'reference_id'    => $row->assessment_id,
            'idempotency_key' => 'commission_cancel_' . $row->id,
            'public_note'     => 'A refund was given for ' . $this->subject((int) $row->assessment_id) . ', so the commission of $' . $amount . ' on hold was cancelled. Your balance did not change.',
            'admin_note'      => 'Assessment #' . $row->assessment_id . '. Refund ' . $refundRef . ' (' . $source . ').',
            'source'          => $source,
            'actor_user_id'   => $actorUserId ?: null,
        ], [
            'inside' => function () use ($row) {
                $moved = DB::table(self::TABLE)
                    ->where('id', $row->id)
                    ->where('transfer_status', 'pending')
                    ->update(['transfer_status' => 'cancelled', 'refund_status' => 'refunded', 'refunded_at' => $this->now(), 'update_datetime' => $this->now()]);

                if ($moved !== 1) {
                    throw new RuntimeException('changed by another run (released meanwhile).');
                }
            },
        ]);

        return empty($result['duplicate']) ? 'cancelled' : 'already';
    }

    /** Refund after release: take the commission back, even if that leaves the balance negative. */
    private function reverse(object $row, string $refundRef, string $source, int $actorUserId): string
    {
        $entry = $this->findTransferEntry($row);

        if (!$entry) {
            Logger::warning("Refund {$refundRef}: assessment #{$row->assessment_id} has a paid commission (relationship #{$row->id}) but no ledger transfer was found. Reverse it by hand.");
            DB::table(self::TABLE)->where('id', $row->id)->whereNull('refund_status')
                ->update(['refund_status' => 'refunded', 'refunded_at' => $this->now(), 'update_datetime' => $this->now()]);
            return 'missing_entry';
        }

        $amount = abs((float) $entry->amount);

        $result = CreditLedgerService::post($entry->account_type, (int) $entry->account_id, [
            'bucket'          => 'earnings',
            'entry_type'      => 'commission_reversal',
            'amount'          => -$amount,
            'reference_type'  => 'assessment',
            'reference_id'    => $row->assessment_id,
            'idempotency_key' => 'commission_reversal_' . $row->id,
            'public_note'     => 'A refund was given for ' . $this->subject((int) $row->assessment_id) . ', so its commission of $' . number_format($amount, 2) . ' was taken back from your balance.',
            'admin_note'      => 'Assessment #' . $row->assessment_id . '. Refund ' . $refundRef . ' (' . $source . '). Reverses ledger entry #' . $entry->entry_id . '.',
            'source'          => $source,
            'actor_user_id'   => $actorUserId ?: null,
        ], [
            'allow_negative' => true,
            'inside'         => function () use ($row) {
                $moved = DB::table(self::TABLE)
                    ->where('id', $row->id)
                    ->where('transfer_status', 'success')
                    ->update(['transfer_status' => 'reversed', 'refund_status' => 'refunded', 'refunded_at' => $this->now(), 'update_datetime' => $this->now()]);

                if ($moved !== 1) {
                    throw new RuntimeException('changed by another run (already reversed).');
                }
            },
        ]);

        return empty($result['duplicate']) ? 'reversed' : 'already';
    }

    /**
     * The ledger entry that paid this commission. Since 1.1.2 it carries the key commission_<id>;
     * older commissions were copied in by the ledger migration with legacy_transaction_id set to the
     * old mytemp_transactions row that transfer_id pointed to.
     */
    private function findTransferEntry(object $row): ?object
    {
        $ledger = DB::table(CreditLedgerService::TABLE);

        $entry = (clone $ledger)->where('idempotency_key', 'commission_' . $row->id)->first();

        if (!$entry && is_numeric((string) $row->transfer_id)) {
            $entry = (clone $ledger)
                ->where('legacy_transaction_id', (int) $row->transfer_id)
                ->where('entry_type', 'transfer')
                ->where('account_type', 'affiliate')
                ->first();
        }

        return ($entry && (float) $entry->amount > 0) ? $entry : null;
    }

    /**
     * Whose assessment a commission is for, for the affiliate's notes: "John Smith's assessment
     * (code AFFCP01-9)". Affiliates never see the assessment ID (it goes in the admin note).
     * Same wording as affcp_commission_subject() in wp-affiliates-coupons; keep the two in step.
     */
    public function subject(int $assessmentId): string
    {
        $assessment = DB::table('mytemp_assessments')->where('assessment_id', $assessmentId)->first(['first_name', 'last_name', 'user_id']);

        $name = $assessment ? trim(trim((string) $assessment->first_name) . ' ' . trim((string) $assessment->last_name)) : '';
        if ($name === '' && $assessment && $assessment->user_id) {
            $name = trim((string) DB::table('users')->where('ID', $assessment->user_id)->value('display_name'));
        }

        $code = (string) DB::table('affcp_coupons_tracking as t')
            ->join('affcp_wp_coupons as c', 'c.coupon_id', '=', 't.coupon_id')
            ->where('t.assessment_id', $assessmentId)
            ->orderByDesc('t.id')
            ->value('c.coupon_code');

        $subject = $name !== '' ? $name . "'s assessment" : "a participant's assessment";

        return $code !== '' ? $subject . ' (code ' . $code . ')' : $subject;
    }

    private function now(): string
    {
        return Carbon::now('UTC')->format('Y-m-d H:i:s');
    }
}
