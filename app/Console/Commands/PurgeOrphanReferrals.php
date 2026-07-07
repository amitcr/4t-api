<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;

use Illuminate\Database\Capsule\Manager as DB;
use App\Models\ReferralModel;
use App\Models\AssessmentModel;
use App\Core\Logger;

/**
 * One-time backfill: remove orphan referral rows.
 *
 * Historically the temp-assessment cleanup (assessments:delete-duplicates) deleted
 * assessments but left their referral rows behind, so the Referrals report counted
 * assessments that no longer exist and could never be matched on the assessments
 * listing. The report query now INNER JOINs assessments (and the cleanup cron prunes
 * referral rows going forward), but rows orphaned before that change are still in the
 * table. Run this ONCE after deployment to purge them:
 *
 *     php artisan referrals:purge-orphans
 *
 * It is intentionally NOT registered in Kernel::schedule() — it is a manual, one-off
 * backfill. It is idempotent (a second run simply removes nothing), and the daily
 * assessments:delete-duplicates cron performs the same sweep from then on.
 */
class PurgeOrphanReferrals implements CommandInterface
{
    public $signature = 'referrals:purge-orphans';
    public $description = 'One-time backfill: delete referral rows whose assessment no longer exists.';

    public function handle($arguments)
    {
        $prefix           = DB::connection()->getTablePrefix();
        $referralsTable   = $prefix . (new ReferralModel)->getTable();
        $assessmentsTable = $prefix . (new AssessmentModel)->getTable();

        $deleted = DB::affectingStatement(
            "DELETE r FROM `{$referralsTable}` r
             LEFT JOIN `{$assessmentsTable}` a ON a.assessment_id = r.assessment_id
             WHERE r.assessment_id IS NOT NULL AND a.assessment_id IS NULL"
        );

        $message = "referrals:purge-orphans removed {$deleted} orphan referral row(s).";
        Logger::info($message);
        echo $message . PHP_EOL;
    }

}
