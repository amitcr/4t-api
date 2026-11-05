<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;
use App\Core\Logger;
use App\Services\CreditLedgerService;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Daily report: for every account bucket with ledger entries, the newest entry's balance_after must
 * equal the balance column on the affiliates / companies table.
 *
 * Report only: it never changes a balance or an entry. Every balance change goes through the ledger
 * in one transaction, so a difference means something wrote to a balance column directly (a manual
 * database edit, or old code); an admin decides what to do about it.
 *
 * Accounts with no ledger entries are skipped: nothing to compare yet.
 */
class ReconcileCredits implements CommandInterface
{
    public $signature = 'credits:reconcile';
    public $description = 'Report accounts whose balance differs from their newest credit ledger entry (changes nothing).';

    public function handle($arguments)
    {
        $checked = 0;
        $differences = 0;

        $buckets = DB::table(CreditLedgerService::TABLE)
            ->select('account_type', 'account_id', 'bucket')
            ->distinct()
            ->orderBy('account_type')
            ->orderBy('account_id')
            ->get();

        foreach ($buckets as $row) {
            $account = CreditLedgerService::ACCOUNTS[$row->account_type] ?? null;
            $config  = $account['buckets'][$row->bucket] ?? null;
            if (!$config) {
                $differences++;
                Logger::warning("credits:reconcile: unknown bucket {$row->bucket} on {$row->account_type} #{$row->account_id}");
                continue;
            }

            $checked++;
            $column = DB::table($account['table'])->where($account['pk'], $row->account_id)->value($config['column']);
            $ledger = CreditLedgerService::lastBalance($row->account_type, (int) $row->account_id, $row->bucket);

            $stored = CreditLedgerService::normalise($column);
            $newest = CreditLedgerService::normalise($ledger);

            if ($stored !== $newest) {
                $differences++;
                $message = "credits:reconcile: {$row->account_type} #{$row->account_id} {$row->bucket}: balance column {$stored}, newest ledger entry {$newest}";
                Logger::warning($message);
                echo $message . PHP_EOL;
            }
        }

        $summary = "credits:reconcile: {$checked} account bucket(s) checked, {$differences} difference(s).";
        Logger::info($summary);
        echo $summary . PHP_EOL;

        return true;
    }
}
