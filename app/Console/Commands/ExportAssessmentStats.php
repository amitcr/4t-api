<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;

use Illuminate\Database\Capsule\Manager as DB;
use App\Services\GoogleSheetsService;
use App\Models\AssessmentModel;
use App\Core\Logger;
use App\Core\Config;
use Carbon\Carbon;

class ExportAssessmentStats implements CommandInterface
{
    public $signature = 'assessments:sync-stats';
    public $description = 'Sync Assessment stats with the google sheet.';

    public function handle($arguments)
    {
        // detect if called via cron job (pass `--daily` flag) or manual
        $mode = ($arguments['mode'] ?? "daily");
        $date = ($arguments['date'] ?? "");
        
        $couponIds = explode(",", Config::get('app.direct_codes'));
        // pr($couponIds); die;
        $tablesPrefix = Config::get('database.prefix');

        $statusCountQuery = "";
        foreach($couponIds as $couponId){
            $statusCountQuery .= $statusCountQuery != "" ? ", ": "";
            $statusCountQuery .= "SUM(CASE WHEN {$tablesPrefix}ac.coupon_id = {$couponId} THEN 1 ELSE 0 END) as started_{$couponId},
            SUM(CASE WHEN {$tablesPrefix}ac.coupon_id = {$couponId} AND {$tablesPrefix}mytemp_assessments.assessment_status = 'completed' AND {$tablesPrefix}mytemp_assessments.needs_assessment_status = 'start' THEN 1 ELSE 0 END) as left_needs_{$couponId},
            SUM(CASE WHEN {$tablesPrefix}ac.coupon_id = {$couponId} AND {$tablesPrefix}mytemp_assessments.assessment_status = 'completed' AND {$tablesPrefix}mytemp_assessments.needs_assessment_status = 'completed' THEN 1 ELSE 0 END) as left_payment_{$couponId},
            SUM(CASE WHEN {$tablesPrefix}ac.coupon_id = {$couponId} AND {$tablesPrefix}mytemp_assessments.assessment_status = 'finished' THEN 1 ELSE 0 END) as completed_{$couponId}";
        }

        // echo $statusCountQuery; die;
        $query =  AssessmentModel::query()
            ->join('affcp_coupons_tracking as ac', "mytemp_assessments.assessment_id", '=', 'ac.assessment_id')
            ->selectRaw("
                DATE({$tablesPrefix}mytemp_assessments.modified_at) as stat_date,
                {$statusCountQuery}
            ")
            ->whereIn('ac.coupon_id', $couponIds);

        if(!empty($date)){
            // echo "Defined Date: ".$date; die;
            $query->whereDate("mytemp_assessments.modified_at", $date);
        }else if($mode == 'daily') {
            // Get yesterday’s stats
            $yesterday = Carbon::now()->subDays('2')->toDateString();
            $query->whereDate("mytemp_assessments.modified_at", $yesterday);
        }
        // echo $query->groupBy('stat_date')->orderBy('stat_date')->toSql(); die;
        $stats = $query->groupBy('stat_date')->orderBy('stat_date')->get()->toArray();

        if (empty($stats))
            return;

        // pr($stats); die;
        // Convert associative stats array into row values
        $rows = array_map(function($stat) {
            return array_values($stat); // keeps order, ignores keys
        }, $stats);


        // pr($rows); die;
        // Push to Google Sheets
        $spreadsheetId = Config::get('app.stats_sheet_id'); // replace with actual
        $sheetRange = "Assessment Data";
        // $sheetRange = "Sheet1!A2";

        $sheets = new GoogleSheetsService($spreadsheetId);
        $sheets->appendData($sheetRange, $rows);
    }
}
