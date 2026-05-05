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

use Spipu\Html2Pdf\Html2Pdf;

class AssessmentReportService
{
    protected $selfAssessmentPatternsService;
    protected $participantSessionsService;

    public function __construct(){
        $this->selfAssessmentPatternsService  = new SelfAssessmentPatternsService();
        $this->participantSessionsService     = new ParticipantSessionsService();
    }

    public function generateReport($assessments, $type = 'collection'){
        Logger::info("generateReport Request came from " . $type . " source", (array) $assessments);
        $chartImageMissingAssessments = [];
        foreach($assessments as $assessment){
            $participantName = ucfirst(get_assessment_participant_name($assessment));
            $participantFirstName = ucfirst(get_assessment_participant_name($assessment, 'first'));
           
            $personalReportName = $assessment->assessment_id."-".trim(str_replace(" ", "-", $participantName)).'-'. date("m-d-Y", strtotime($assessment->created_at)).".pdf";

            $personalFilePath = PROJECT_ROOT.'/assessments/pdf/'.$personalReportName;

            if($assessment->pdf_status == 1 && file_exists($personalFilePath))
                continue;

            
            // Validate if PDF file already created or not
            if(file_exists($personalFilePath)){
                Logger::info('Assessment Report already exists for '.$assessment->assessment_id);
                $assessment->pdf_status = 1;   
                $assessment->save();
                continue;
            }

            if(get_assessment_chart_image($assessment->assessment_id) && get_assessment_chart_image($assessment->assessment_id, 'single')){
                Logger::info('Generating Assessment Report for '.$assessment->assessment_id);
                
                // Single GraphQL snapshot replaces all previous multi-step fetches.
                $snapshot = $this->participantSessionsService->getPDFReportSnapshot($assessment->session_id);
                if (empty($snapshot)) {
                    Logger::info('Failed to fetch PDF report snapshot for assessment ' . $assessment->assessment_id);
                    continue;
                }

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
                
                $holdReport = false;
                // Valdiate If Manager Report Required
                $assessmentCoupon = CouponTrackingModel::where(['assessment_id' => $assessment->assessment_id, 'usage_status' => 'completed'])->orderBy('id', 'ASC')->first();
                // Logger::info("Assessment Coupons ", (array) $assessmentCoupon);
                if(!empty($assessmentCoupon)){
                    $coupon = CouponModel::with('user','affiliate','company')->find($assessmentCoupon->coupon_id);
                    if(!empty($coupon)){                        
                        $holdReport = $coupon->hold_report ??0;
                        $managerReportName = $managerFilePath = '';
                        if($coupon->manager_report == 1){
                            Logger::info("Genrating Assessment Manager Report ");
                            $managerReportName = $assessment->assessment_id."-".trim(str_replace(" ", "-", $participantName)).'-'. date("m-d-Y", strtotime($assessment->created_at))."-Manager-Report.pdf";
                            $managerFilePath = PROJECT_ROOT.'/assessments/pdf/'.$managerReportName;
                            if(!file_exists($managerFilePath)){
                                
                                // Render the template with PHP variables
                                ob_start();
                                include PROJECT_ROOT . '/api/resources/views/template-manager-report.php';
                                $managerReportHtml = ob_get_clean();

                                $this->createPDFReportFile($managerFilePath, $managerReportHtml, ['layout' => 'A4', 'spacing' => array(10, 5, 10, 5)]);

                                $managerEmails = CouponManagerModel::with('user')->where('coupon_id', $coupon->coupon_id)->get()->pluck('user.user_email')->toArray();
                                if(!empty($managerEmails)){
                                    $sendTo = Config::get('app.env') == "local" ? Config::get('app.email') : implode(",",$managerEmails);
                                    if(!empty($sendTo)){
                                        Mail::send($sendTo, 'New Assessment Profile', 'manager-assessment-notification', ['assessment' => $assessment, 'coupon' => $coupon, 'personalFilePath' => $personalFilePath, 'personalReportName' => $personalReportName , 'managerFilePath' => $managerFilePath, 'managerReportName' => $managerReportName, "participantName" => $participantName]);
                                    }            
                                }
                            }
                        }

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

                // Mark as generated
                $assessment->pdf_status = 1;
                $assessment->save();
            }else{
                // TODO: 
                $chartImageMissingAssessments[] = $assessment;
            }
        }

        if(!empty($chartImageMissingAssessments)){
            $sendEmail = false;
            if($type == "single"){
                $sendEmail = true;
            }else if(date("i") == '00'){
                $sendEmail = true;
            }
            if($sendEmail == false)
                return;

            $sendTo = Config::get('app.env') == "local" ? Config::get('app.email') : get_settings_option('admin_email');
            if(!empty($sendTo)){
                Mail::send($sendTo, 'Urgent: Assessment Charts are missing', 'assessment-images-missing', ['assessments' => $chartImageMissingAssessments]);
            }
        }
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