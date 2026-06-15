<?php
namespace App\Jobs;

use App\Core\JobInterface;

use App\Models\AssessmentModel;
use App\Models\AssessmentReviewModel;
use App\Services\AssessmentReportService;
use App\Core\Logger;

/**
 * On-demand manager-report generation.
 *
 * Generates EVERY manager-report version for an assessment — the original plus one per
 * committed validated review — so whichever version the admin later makes visible always
 * has a manager PDF. Generation only; the WP side charges credits and sends the email.
 *
 * Payload: { assessment_id }
 */
class GenerateManagerReportJob implements JobInterface
{
    protected $assessmentReportService;

    public function __construct(){
        $this->assessmentReportService = new AssessmentReportService();
    }

    public function handle(array $data)
    {
        Logger::info("GenerateManagerReportJob Called ", $data);

        if(empty($data['assessment_id'])){
            return;
        }

        $assessment = AssessmentModel::with('user', 'payment')->find($data['assessment_id']);
        if(empty($assessment)){
            Logger::info("GenerateManagerReportJob: assessment not found " . $data['assessment_id']);
            return;
        }

        // 1. Original manager report.
        $this->assessmentReportService->generateManagerReport($assessment, false);

        // 2. A manager report for every committed (validated/superseded) review version.
        $reviews = AssessmentReviewModel::where('assessment_id', $assessment->assessment_id)
            ->whereNotNull('coach_override_id')
            ->where('coach_override_id', '!=', '')
            ->orderBy('id')
            ->get();

        foreach ($reviews as $review) {
            $this->assessmentReportService->generateManagerReport($assessment, true, $review);
        }

        Logger::info("GenerateManagerReportJob completed for assessment " . $assessment->assessment_id . " (" . ($reviews->count()) . " validated version(s) + original)");
    }
}
