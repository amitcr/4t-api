<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;

use App\Models\AssessmentModel;
use App\Services\AssessmentReportService;
use App\Core\Logger;
use Carbon\Carbon;

class GenerateAssessmentReport implements CommandInterface
{
    // public $signature = 'assessments:abandoned {days=7}';
    public $signature = 'assessments:generate-report';
    public $description = 'Generate Assessment PDF report file for missing assessments';

    protected $assessmentReportService;
    
    public function __construct(){
        $this->assessmentReportService = new AssessmentReportService();
    }

    public function handle($arguments)
    {
        $modifiedAt = Carbon::now()->subMinutes(2);
        // Logger::info('cron assessments:generate-report started with modifiedAt: '.$modifiedAt);
        $assessments = AssessmentModel::with('user', 'payment')->where('assessment_status', 'finished')
            ->where('pdf_status', 0)
            ->whereNull('pdf_script')
            ->where('modified_at', '<=', $modifiedAt)
            ->orderByDesc('assessment_id')
            ->limit(1)
            ->get();

        // pr($assessments); die;
        if($assessments->isEmpty())
            return;

        $this->assessmentReportService->generateReport($assessments, 'collection');
    }
}
