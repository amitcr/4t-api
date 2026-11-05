<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;
use App\Core\Logger;
use App\Services\PayoutResultService;
use Illuminate\Database\Capsule\Manager as DB;
use Throwable;

/**
 * Backup for the PayPal webhook: reads the result of every payout still waiting on PayPal and applies
 * it, so a missed webhook only delays a payout by up to 15 minutes.
 */
class SyncPayPalPayouts implements CommandInterface
{
    public $signature = 'payouts:sync-paypal';
    public $description = 'Read PayPal results for payouts in processing, and mark them paid or returned.';

    private PayoutResultService $results;

    public function __construct(?PayoutResultService $results = null)
    {
        $this->results = $results ?? new PayoutResultService();
    }

    public function handle($arguments)
    {
        // WordPress creates the table on the first wp-admin load after the plugin update.
        if (!DB::schema()->hasTable(PayoutResultService::TABLE)) {
            return true;
        }

        $payouts = DB::table(PayoutResultService::TABLE)
            ->where('status', 'processing')
            ->whereNotNull('paypal_batch_id')
            ->where('paypal_batch_id', '<>', '')
            ->orderBy('requested_at')
            ->limit(100)
            ->get();

        $counts = ['checked' => 0, 'paid' => 0, 'returned' => 0, 'errors' => 0];

        if ($payouts->isNotEmpty() && !$this->results->paypal()->isConfigured()) {
            Logger::warning('payouts:sync-paypal: PayPal credentials are missing for the active mode.');
            return true;
        }

        foreach ($payouts as $payout) {
            $counts['checked']++;

            try {
                $result = $this->results->apply($payout);
                if (isset($counts[$result])) {
                    $counts[$result]++;
                }
            } catch (Throwable $e) {
                $counts['errors']++;
                Logger::warning("payouts:sync-paypal: payout #{$payout->payout_id}: " . $e->getMessage());
            }
        }

        $summary = "payouts:sync-paypal: {$counts['checked']} checked, {$counts['paid']} paid, {$counts['returned']} returned, {$counts['errors']} could not be read.";
        Logger::info($summary);
        echo $summary . PHP_EOL;

        return true;
    }
}
