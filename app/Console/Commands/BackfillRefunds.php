<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;
use App\Core\Logger;
use App\Services\CommissionService;
use App\Services\RefundService;
use Illuminate\Database\Capsule\Manager as DB;
use Throwable;

/**
 * One-time: records refunds issued before refund handling existed, and takes back their commissions.
 *
 *   php artisan commissions:backfill-refunds file=/path/refunds.csv            (dry run: shows what it would do)
 *   php artisan commissions:backfill-refunds file=/path/refunds.csv apply=1    (does it)
 *
 * CSV: one refunded payment per line, `charge_id[,refund_id]` — the Stripe charge (ch_) or
 * PaymentIntent (pi_), the PayPal capture ID, or the PayPal Standard transaction ID, as exported from
 * the gateway. A header line and blank lines are skipped. Safe to run twice.
 */
class BackfillRefunds implements CommandInterface
{
    public $signature = 'commissions:backfill-refunds';
    public $description = 'One-time: record past refunds from a CSV of charge IDs and reverse their commissions (dry run unless apply=1).';

    public function handle($arguments)
    {
        $file  = (string) ($arguments['file'] ?? '');
        $apply = ($arguments['apply'] ?? '') === '1';

        if ($file === '' || !is_readable($file)) {
            echo "Usage: php artisan commissions:backfill-refunds file=/path/refunds.csv [apply=1]" . PHP_EOL;
            return true;
        }

        $service = new RefundService();
        $counts  = ['lines' => 0, 'not_found' => 0, 'done' => 0, 'errors' => 0];

        $handle = fopen($file, 'r');
        while (($line = fgetcsv($handle, 0, ',', '"', '')) !== false) {
            $chargeId = trim((string) ($line[0] ?? ''));
            if ($chargeId === '' || !preg_match('/^[A-Za-z0-9_\-]+$/', $chargeId) || in_array(strtolower($chargeId), ['charge_id', 'id'], true)) {
                continue;
            }
            $counts['lines']++;
            $refundId = trim((string) ($line[1] ?? '')) ?: 'backfill-' . $chargeId;

            $payment = $service->findPaymentByCharge([$chargeId]);
            if (!$payment) {
                $counts['not_found']++;
                echo "{$chargeId}: no assessment payment found" . PHP_EOL;
                continue;
            }

            $relationship = DB::table(CommissionService::TABLE)->where('assessment_id', $payment->assessment_id)->orderByDesc('id')->first();
            $commission   = $relationship ? ((string) $relationship->transfer_status ?: 'none') : 'no affiliate';
            $already      = $payment->refund_status ? ' (payment already marked refunded)' : '';

            if (!$apply) {
                echo "{$chargeId}: assessment #{$payment->assessment_id}, \${$payment->end_price}, commission {$commission}{$already} -> would record refund" . PHP_EOL;
                continue;
            }

            try {
                $result = $service->recordByCharge([$chargeId], ['refund_id' => $refundId, 'source' => 'api_cron', 'gateway' => 'backfill']);
                $counts['done']++;
                echo "{$chargeId}: assessment #{$payment->assessment_id}: commission {$result}" . PHP_EOL;
            } catch (Throwable $e) {
                $counts['errors']++;
                echo "{$chargeId}: failed: " . $e->getMessage() . PHP_EOL;
                Logger::warning("commissions:backfill-refunds {$chargeId}: " . $e->getMessage());
            }
        }
        fclose($handle);

        $mode    = $apply ? 'applied' : 'dry run (add apply=1 to record)';
        $summary = "commissions:backfill-refunds {$mode}: {$counts['lines']} line(s), {$counts['not_found']} not found, {$counts['done']} recorded, {$counts['errors']} error(s).";
        Logger::info($summary);
        echo $summary . PHP_EOL;

        return true;
    }
}
