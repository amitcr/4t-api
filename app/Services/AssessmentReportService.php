<?php
namespace App\Services;

use App\Models\AssessmentModel;
use App\Models\CouponModel;
use App\Models\UserMetaModel;
use App\Models\CouponTrackingModel;
use App\Models\AssessmentRelationshipModel;
use App\Services\Api\SelfAssessmentPatternsService;
use App\Services\Api\ParticipantSessionsService;
use App\Core\Mail\Mail;
use App\Core\Logger;
use App\Core\Config;
use Carbon\Carbon;
use App\Models\CouponManagerModel;

use Spipu\Html2Pdf\Html2Pdf;

class AssessmentReportService
{
    protected $selfAssessmentPatternsService;
    protected $participantSessionsService;

    public function __construct(){
        $this->selfAssessmentPatternsService  = new SelfAssessmentPatternsService();
        $this->participantSessionsService     = new ParticipantSessionsService();
    }

    public function generateReport($assessments, $attr = [], $type = 'collection'){
        Logger::info("generateReport Request came from " . $type . " source", (array) $assessments);
        $chartImageMissingAssessments = [];
        foreach($assessments as $assessment){
            Logger::info('Assessment loop started');
            $participantName = ucfirst(get_assessment_participant_name($assessment));
            $participantFirstName = ucfirst(get_assessment_participant_name($assessment, 'first'));
            
            $override = false;;
            if(!empty($attr)){
                if(isset($attr['override']) && !empty($attr['override'])){
                    $override = true;
                }
            }
            Logger::info('Assessment override Status '. $assessment->assessment_id .' ' .$override);

            // review_id identifies the review ROW; its per-assessment `version` drives the
            // PDF/chart "-v{n}" naming and the coach override entry.
            $reviewId = (isset($attr['review_id']) && !empty($attr['review_id'])) ? (int) $attr['review_id'] : null;
            $coach_override_id = '';
            $reviewVersion = null;
            if ($override && !empty($reviewId)) {
                $reviewRow = \App\Models\AssessmentReviewModel::find($reviewId);
                $coach_override_id = ($reviewRow && !empty($reviewRow->coach_override_id)) ? $reviewRow->coach_override_id : '';
                $reviewVersion     = ($reviewRow && !empty($reviewRow->version)) ? (int) $reviewRow->version : null;
            }

            $versionSuffix = ($override && !empty($reviewVersion)) ? '-v'.$reviewVersion : '';
            $personalReportName = $assessment->assessment_id."-".trim(str_replace(" ", "-", $participantName)).'-'. date("m-d-Y", strtotime($assessment->created_at)).$versionSuffix.".pdf";

            $personalFilePath = ($override == true) ? PROJECT_ROOT.'/assessments/override/pdf/'.$personalReportName : PROJECT_ROOT.'/assessments/pdf/'.$personalReportName;

            if( ($override == false) && ($assessment->pdf_status == 1 && file_exists($personalFilePath)) )
                continue;
            
            if( ($override == true) && (file_exists($personalFilePath)) )
                continue;

            
            // Validate if PDF file already created or not
            if(file_exists($personalFilePath)){
                Logger::info('Assessment Report already exists for '.$assessment->assessment_id);
                $assessment->pdf_status = 1;   
                $assessment->save();
                continue;
            }

            if(get_assessment_chart_image($assessment->assessment_id, '', '', $override, $reviewVersion) && get_assessment_chart_image($assessment->assessment_id, 'single', '', $override, $reviewVersion)){
                Logger::info('Generating Assessment Report for '.$assessment->assessment_id);
                
                // Single GraphQL snapshot replaces all previous multi-step fetches.
                $snapshot = $this->participantSessionsService->getPDFReportSnapshot($assessment->session_id);
                if (empty($snapshot)) {
                    Logger::info('Failed to fetch PDF report snapshot for assessment ' . $assessment->assessment_id);
                    continue;
                }

                // Logger::info("snapshot selfAssessmentResults ", (array) $snapshot);
                $assessmentResults = $snapshot->selfAssessmentResults->data[0] ?? null;

                // --- Page 28: Self Assessment Choices ---
                $dMostChoices  = $iMostChoices  = $sMostChoices  = $cMostChoices  = [];
                $dLeastChoices = $iLeastChoices = $sLeastChoices = $cLeastChoices = [];
                
                $selfResponses = $snapshot->selfAssessmentResponses->data ?? [];
                foreach ($selfResponses as $selfResponse) {
                    if (!empty($selfResponse->mostChoice)) {
                        $temperament = strtoupper($selfResponse->leastChoice->temperament ?? '');
                        switch ($temperament) {
                            case 'D': $dMostChoices[] = $selfResponse->mostChoice; break;
                            case 'I': $iMostChoices[] = $selfResponse->mostChoice; break;
                            case 'S': $sMostChoices[] = $selfResponse->mostChoice; break;
                            case 'C': $cMostChoices[] = $selfResponse->mostChoice; break;
                        }
                    }
                    if (!empty($selfResponse->leastChoice)) {
                        $temperament = strtoupper($selfResponse->leastChoice->temperament ?? '');
                        switch ($temperament) {
                            case 'D': $dLeastChoices[] = $selfResponse->leastChoice; break;
                            case 'I': $iLeastChoices[] = $selfResponse->leastChoice; break;
                            case 'S': $sLeastChoices[] = $selfResponse->leastChoice; break;
                            case 'C': $cLeastChoices[] = $selfResponse->leastChoice; break;
                        }
                    }
                }

                // --- Page 29: Needs Assessment Choices (sorted by priority ascending) ---
                $needsResponses = $snapshot->needsAssessmentResponses->data ?? [];
                usort($needsResponses, function ($a, $b) {
                    return (int) ($a->priority ?? 0) - (int) ($b->priority ?? 0);
                });
                $needsAssessmentChoices       = new \stdClass();
                $needsAssessmentChoices->data = array_values(array_filter(array_map(
                    function ($r) { return $r->choice ?? null; },
                    $needsResponses
                )));

                $promotionalCoupon = null;
                $isPromotional = get_settings_option('affcp_settings.is_promotional');
                if($isPromotional == true){
                    $promotionCouponCode = get_settings_option('affcp_settings.promotional_code');
                    if(!empty($promotionCouponCode)){
                        $promotionalCoupon = CouponModel::where(['coupon_code' => $promotionCouponCode])->first();
                    }
                }
                
                
                
                // pr($needsAssessmentChoices); die;
                // Render the template with PHP variables
                ob_start();
                include PROJECT_ROOT . "/api/resources/views/template-report.php";
                $personalReportHtml = ob_get_clean();

                $this->createPDFReportFile($personalFilePath, $personalReportHtml, ['layout' => array(215,307), 'spacing' => array(0,0,0,0)]);

                // Mark this validation's report as generated on the review row.
                if ($override && !empty($reviewId)) {
                    \App\Models\AssessmentReviewModel::where('id', $reviewId)->update([
                        'pdf_generated' => 1,
                        'pdf_filename'  => $personalReportName,
                        'updated_at'    => date('Y-m-d H:i:s'),
                    ]);
                }

                $holdReport = false;
                // Valdiate If Manager Report Required
                $assessmentCoupon = CouponTrackingModel::where(['assessment_id' => $assessment->assessment_id, 'usage_status' => 'completed'])->orderBy('id', 'ASC')->first();
                // Logger::info("Assessment Coupons ", (array) $assessmentCoupon);
                if(!empty($assessmentCoupon)){
                    $coupon = CouponModel::with('user','affiliate','company')->find($assessmentCoupon->coupon_id);
                    if(!empty($coupon)){                        
                        $holdReport = $coupon->hold_report ??0;
                        $managerReportName = $managerFilePath = '';

                        // Manager report applies when the coupon enables it OR the assessment was marked
                        // manager-enabled by an on-demand "Create Manager Report" request (so future
                        // validations keep generating their manager version too).
                        $managerReportEnabled = ($coupon->manager_report == 1)
                            || ( ! empty($assessment->details) && ! empty($assessment->details->manager_report_enabled) );

                        if($managerReportEnabled){
                            Logger::info("Genrating Assessment Manager Report ");

                            // Single source of manager-report generation (also used by GenerateManagerReportJob).
                            $managerResult = $this->generateManagerReport($assessment, $override, ($reviewRow ?? null), $snapshot);
                            if (is_array($managerResult)) {
                                $managerReportName = $managerResult['name'];
                                $managerFilePath   = $managerResult['path'];

                                // Manager email only on the original run, and only when just generated.
                                if (!$override && !empty($managerResult['generated'])) {
                                    $managerEmails = CouponManagerModel::with('user')->where('coupon_id', $coupon->coupon_id)->get()->pluck('user.user_email')->toArray();
                                    if(!empty($managerEmails)){
                                        $sendTo = Config::get('app.env') == "local" ? Config::get('app.email') : implode(",",$managerEmails);
                                        if(!empty($sendTo)){
                                            Mail::send($sendTo, 'New Assessment Profile', 'manager-assessment-notification', ['assessment' => $assessment, 'coupon' => $coupon, 'personalFilePath' => $personalFilePath, 'personalReportName' => $personalReportName , 'managerFilePath' => $managerFilePath, 'managerReportName' => $managerReportName, "participantName" => $participantName]);
                                        }
                                    }
                                }
                            }
                        }

                        if(!$override){
                            $sendTo = Config::get('app.env') == "local" ? Config::get('app.email') : $coupon->user->user_email;
                            if(!empty($sendTo)){
                                Mail::send($sendTo, 'New Assessment Profile', 'affiliate-company-assessment-notification', ['assessment' => $assessment, 'coupon' => $coupon, 'personalFilePath' => $personalFilePath, 'personalReportName' => $personalReportName , 'managerFilePath' => $managerFilePath, 'managerReportName' => $managerReportName, "participantName" => $participantName]);
                            }

                            if(!empty($coupon->other_recipients)){
                                $sendTo = Config::get('app.env') == "local" ? Config::get('app.email') : $coupon->other_recipients;
                                if(!empty($sendTo)){
                                    Mail::send($sendTo, 'New Assessment Profile', 'assessment-notification-recipients', ['assessment' => $assessment, 'personalFilePath' => $personalFilePath, 'personalReportName' => $personalReportName, "participantName" => $participantName]);
                                }   
                            }
                        }
                    }
                }

                if(!$override){
                    if($holdReport == false){
                        $sendTo = Config::get('app.env') == "local" ? Config::get('app.email') : $assessment->user->user_email;
                        if(!empty($sendTo)){
                            Mail::send($sendTo, 'Your MyTemperament Assessment Profile', 'participant-assessment-notification', ['assessment' => $assessment, 'personalFilePath' => $personalFilePath, 'personalReportName' => $personalReportName, "participantName" => $participantName]);
                        }
                    }

                    if($assessment->payment->end_price > 0){
                        $sendTo = Config::get('app.env') == "local" ? Config::get('app.email') : $assessment->user->user_email;
                        if(!empty($sendTo)){
                            $assessmentCoupons = CouponTrackingModel::where(['assessment_id' => $assessment->assessment_id, 'usage_status' => 'completed'])->orderBy('id', 'ASC')->get();
                            Mail::send($sendTo, 'Thank you for your payment', 'assessment-payment-notification', ['assessment' => $assessment, 'personalFilePath' => $personalFilePath, 'personalReportName' => $personalReportName, 'assessmentCoupons' => $assessmentCoupons, 'promotionalCoupon' => $promotionalCoupon, "participantName" => $participantName, "holdReport" => $holdReport]);
                        }
                    }
                }

                // Mark as generated
                $assessment->pdf_status = 1;
                $assessment->save();
            }else{
                // Capture the version context so the alert email links to the correct (original/validated) chart.
                $chartImageMissingAssessments[] = [
                    'assessment' => $assessment,
                    'override'   => $override,
                    'review_id'  => $reviewId,
                ];
            }
        }

        // Ids of assessments whose charts were missing — used by the job worker to HOLD + retry.
        $missingAssessmentIds = array_map(function ($item) {
            return $item['assessment']->assessment_id;
        }, $chartImageMissingAssessments);

        if(!empty($chartImageMissingAssessments)){
            $sendEmail = false;
            if($type == "single"){
                $sendEmail = true;
            }else if(date("i") == '00'){
                $sendEmail = true;
            }
            if($sendEmail == false)
                return $missingAssessmentIds;

            $sendTo = Config::get('app.env') == "local" ? Config::get('app.email') : get_settings_option('admin_email');
            if(!empty($sendTo)){
                Mail::send($sendTo, 'Urgent: Assessment Charts are missing', 'assessment-images-missing', ['assessments' => $chartImageMissingAssessments]);
            }
        }

        return $missingAssessmentIds;
    }

    /**
     * Generate a single manager-report PDF (original or a specific validated review version).
     *
     * Single source of manager-report generation — called inline by generateReport() and by
     * GenerateManagerReportJob() for the on-demand all-versions flow.
     *
     * @param object      $assessment Assessment model.
     * @param bool        $override   True for a validated (override) version.
     * @param object|null $review     Review row (for version + coach_override_id) when $override.
     * @param object|null $snapshot   Optional pre-fetched PDF snapshot (avoids a second GraphQL call).
     * @return array{name:string,path:string,generated:bool}|false
     */
    public function generateManagerReport($assessment, $override = false, $review = null, $snapshot = null)
    {
        $participantName      = ucfirst(get_assessment_participant_name($assessment));
        $participantFirstName = ucfirst(get_assessment_participant_name($assessment, 'first'));

        // Version + override entry come from the review (only for validated versions).
        $reviewId          = ($override && $review && !empty($review->id)) ? (int) $review->id : null;
        $reviewVersion     = ($override && $review && !empty($review->version)) ? (int) $review->version : null;
        $coach_override_id = ($override && $review && !empty($review->coach_override_id)) ? $review->coach_override_id : '';

        $managerVersionSuffix = ($override && !empty($reviewVersion)) ? '-v'.$reviewVersion : '';
        $managerReportName    = $assessment->assessment_id."-".trim(str_replace(" ", "-", $participantName)).'-'. date("m-d-Y", strtotime($assessment->created_at))."-Manager-Report".$managerVersionSuffix.".pdf";
        $managerFilePath      = ($override == true) ? PROJECT_ROOT.'/assessments/override/pdf/'.$managerReportName : PROJECT_ROOT.'/assessments/pdf/'.$managerReportName;

        // Idempotent — skip if this version's manager report already exists.
        if (file_exists($managerFilePath)) {
            return ['name' => $managerReportName, 'path' => $managerFilePath, 'generated' => false];
        }

        // Fetch the snapshot if the caller didn't pass one (e.g. the on-demand job).
        if (empty($snapshot)) {
            $snapshot = $this->participantSessionsService->getPDFReportSnapshot($assessment->session_id);
        }
        if (empty($snapshot)) {
            Logger::info('Manager report generation: failed to fetch snapshot for assessment ' . $assessment->assessment_id);
            return false;
        }

        $assessmentResults = $snapshot->selfAssessmentResults->data[0] ?? null;

        // Needs Assessment Choices (sorted by priority ascending) — consumed by the template.
        $needsResponses = $snapshot->needsAssessmentResponses->data ?? [];
        usort($needsResponses, function ($a, $b) {
            return (int) ($a->priority ?? 0) - (int) ($b->priority ?? 0);
        });
        $needsAssessmentChoices       = new \stdClass();
        $needsAssessmentChoices->data = array_values(array_filter(array_map(
            function ($r) { return $r->choice ?? null; },
            $needsResponses
        )));

        // Render the template ($override + $coach_override_id + the result/choices are in scope).
        ob_start();
        include PROJECT_ROOT . '/api/resources/views/template-manager-report.php';
        $managerReportHtml = ob_get_clean();

        $this->createPDFReportFile($managerFilePath, $managerReportHtml, ['layout' => 'A4', 'spacing' => array(10, 5, 10, 5)]);

        // Stamp the review row for validated (override) manager reports.
        if ($override && !empty($reviewId)) {
            \App\Models\AssessmentReviewModel::where('id', $reviewId)->update([
                'manager_pdf_generated' => 1,
                'manager_pdf_filename'  => $managerReportName,
                'updated_at'            => date('Y-m-d H:i:s'),
            ]);
        }

        return ['name' => $managerReportName, 'path' => $managerFilePath, 'generated' => true];
    }

    protected function createPDFReportFile(string $filePath = '', string $html = '', array $attributes = []){
        if(empty($filePath) || empty($html) || empty($attributes))
            return false;

        // Generate PDF
        $start = microtime(true);
        $html2pdf = new Html2Pdf('P', $attributes['layout'], 'fr', true, 'UTF-8', $attributes['spacing']);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->setTestTdInOnePage(false);
        $html2pdf->writeHTML($html);
        Logger::info("HTML parsing took " . (microtime(true) - $start) . " sec");
        // Save PDF file
        $html2pdf->output($filePath, 'F'); // 'F' = Save to file
        Logger::info("Output writing took " . (microtime(true) - $start) . " sec (total)");
        return true;
    }

}