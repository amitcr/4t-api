<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;

use Illuminate\Database\Capsule\Manager as DB;
use App\Models\ParticipantModel;
use App\Models\AssessmentRelationshipModel;
use App\Models\CouponTrackingModel;
use App\Models\AssessmentModel;
use App\Models\AssessmentPaymentModel;
use App\Models\ReferralModel;
use App\Models\UserModel;
use App\Models\UserMetaModel;
use App\Core\Logger;
use App\Core\Config;
use Carbon\Carbon;

class DeleteDuplicateAssessments implements CommandInterface
{
    public $signature = 'assessments:delete-duplicates';
    public $description = 'Sync Assessment stats with the google sheet.';

    public function handle($arguments)
    {
        $daysPeriod = [1,30,180];
        foreach($daysPeriod as $days){
            $registeredDate = Carbon::now()->subDays($days)->toDateString();
            $query = ParticipantModel::where('temp', 1)->whereDate('date_registered', '<=', $registeredDate);
            if($days != 180){
                $questionsCompleted = ($days == 30) ? 4 : 1;
                $query->whereHas('assessments', function ($q) use ($questionsCompleted) {
                    $q->whereIn('assessment_status', ['new', 'start'])
                    ->where('questionsCompleted', '<', $questionsCompleted);
                });
            }

            $duplicateParticipants = $query->get(['participant_id', 'user_id']); // fetch only what we need

            if ($duplicateParticipants->isNotEmpty()) {
                $participantIds = $duplicateParticipants->pluck('participant_id');
                $userIds        = $duplicateParticipants->pluck('user_id');

                DB::transaction(function () use ($participantIds, $userIds, $days) {
                    if($days == 30){
                        UserModel::whereIn('ID', $userIds)->delete();
                        UserMetaModel::whereIn('user_id', $userIds)->delete();
                    }else {
                        // 2. Bulk delete related data
                        AssessmentRelationshipModel::whereIn('participant_id', $participantIds)->delete();
                        CouponTrackingModel::whereIn('participant_id', $participantIds)->delete();
                        // Remove referral rows for the assessments being deleted so
                        // the Referrals report count stays equal to the (now smaller)
                        // filtered assessments listing. Covers rows where the purged
                        // participant is the referred taker or the referring parent.
                        ReferralModel::whereIn('participant_id', $participantIds)
                            ->orWhereIn('referred_by', $participantIds)
                            ->delete();
                        AssessmentModel::whereIn('participant_id', $participantIds)->delete();
                        AssessmentPaymentModel::whereIn('participant_id', $participantIds)->delete();

                        // 3. Delete users
                        UserModel::whereIn('ID', $userIds)->delete();
                        UserMetaModel::whereIn('user_id', $userIds)->delete();

                        // 4. Delete participants last
                        ParticipantModel::whereIn('participant_id', $participantIds)->delete();
                    }
                });
            }
        }

        // Sweep any orphan referral rows whose assessment no longer exists, whatever
        // deletion path removed it (historical purges, manual deletes, etc.). This
        // keeps the Referrals report — which INNER JOINs referrals to assessments —
        // consistent even for orphans created before this cleanup existed.
        $prefix           = DB::connection()->getTablePrefix();
        $referralsTable   = $prefix . (new ReferralModel)->getTable();
        $assessmentsTable = $prefix . (new AssessmentModel)->getTable();
        DB::statement(
            "DELETE r FROM `{$referralsTable}` r
             LEFT JOIN `{$assessmentsTable}` a ON a.assessment_id = r.assessment_id
             WHERE r.assessment_id IS NOT NULL AND a.assessment_id IS NULL"
        );

    }

}