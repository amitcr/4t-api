<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;
use App\Core\Logger;
use App\Services\CommissionService;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Adds held commissions to affiliates' earnings once their hold period ends (Plugin 2 setting
 * "Commission Hold Period"). A commission whose payment was refunded during the hold was already
 * cancelled and is skipped.
 */
class ReleaseCommissions implements CommandInterface
{
    public $signature = 'commissions:release';
    public $description = 'Add held affiliate commissions to earnings when their hold period ends.';

    public function handle($arguments)
    {
        // WordPress adds the columns on the first load after the Plugin 2 1.1.4 update.
        if (!DB::schema()->hasColumn(CommissionService::TABLE, 'commission_release_at')) {
            return true;
        }

        $counts  = (new CommissionService())->releaseDue();
        $summary = "commissions:release: {$counts['released']} released, {$counts['errors']} error(s).";

        if ($counts['released'] || $counts['errors']) {
            Logger::info($summary);
        }
        echo $summary . PHP_EOL;

        return true;
    }
}
