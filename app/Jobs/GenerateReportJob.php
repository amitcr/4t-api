<?php
namespace App\Jobs;

use App\Core\JobInterface;

use App\Models\AssessmentModel;
use App\Services\AssessmentReportService;
use App\Core\Logger;
use App\Core\ChartImagesMissingException;

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
                $missing = $this->assessmentReportService->generateReport([$assessment], $data, 'single');

                // Chart images weren't ready — signal the worker to HOLD this job and retry later
                // (the missing-charts alert email was already sent by generateReport).
                if (is_array($missing) && in_array($assessment->assessment_id, $missing)) {
                    throw new ChartImagesMissingException(
                        "Chart images missing for assessment {$assessment->assessment_id}; holding report job."
                    );
                }
            }
        }
    }
}
