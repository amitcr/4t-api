<?php
namespace App\Jobs;

use App\Core\JobInterface;

use App\Models\AssessmentModel;
use App\Services\AssessmentReportService;
use App\Core\Logger;

class GenerateReportJob implements JobInterface
{
    protected $assessmentReportService;

    public function __construct(){        
        $this->assessmentReportService = new AssessmentReportService();
    }

    public function handle(array $data)
    {
        Logger::info("GenerateReportJob Called  ", $data);
        if(isset($data['assessment_id']) && !empty($data['assessment_id'])){
            $assessment = AssessmentModel::with('user', 'payment')->find($data['assessment_id']);
            if(!empty($assessment)){
                $this->assessmentReportService->generateReport([$assessment], 'single');
            }
        }
    }
}
