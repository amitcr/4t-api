<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;
use App\Models\AssessmentModel;
use App\Models\CouponModel;
use App\Models\CouponTrackingModel;
use App\Services\Api\SelfAssessmentResultsService;
use App\Services\Api\SelfAssessmentResponsesService;
use App\Services\Api\SelfAssessmentChoicesService;
use App\Services\Api\NeedsAssessmentResponsesService;
use App\Services\Api\NeedsAssessmentChoicesService;
use App\Core\Mail\Mail;
use App\Core\Logger;
use App\Core\Config;
use Carbon\Carbon;
use Spipu\Html2Pdf\Html2Pdf;

class GenerateAssessmentReport implements CommandInterface
{
    public $signature = 'assessments:generate-report';
    public $description = 'Generate Assessment PDF report file for missing assessments';

    protected $selfAssessmentResultsService;
    protected $selfAssessmentResponsesService;
    protected $selfAssessmentChoicesService;
    protected $needsAssessmentResponsesService;
    protected $needsAssessmentChoicesService;

    public function __construct()
    {
        $this->selfAssessmentResultsService  = new SelfAssessmentResultsService();
        $this->selfAssessmentResponsesService = new SelfAssessmentResponsesService();
        $this->selfAssessmentChoicesService   = new SelfAssessmentChoicesService();
        $this->needsAssessmentResponsesService = new NeedsAssessmentResponsesService();
        $this->needsAssessmentChoicesService  = new NeedsAssessmentChoicesService();
    }

    public function handle($arguments)
    {
        $modifiedAt = Carbon::now()->subMinutes(2);

        // Process assessments in small batches
        AssessmentModel::with(['user','payment'])
            ->where('assessment_status', 'finished')
            ->where('pdf_status', 0)
            ->whereNull('pdf_script')
            ->where('modified_at', '<=', $modifiedAt)
            ->orderByDesc('assessment_id')
            ->chunk(50, function ($assessments) {
                foreach ($assessments as $assessment) {
                    $this->processAssessment($assessment);
                }
            });
    }

    protected function processAssessment($assessment)
    {
        if ($assessment->pdf_status == 1) {
            return;
        }

        $participantName   = $assessment->first_name . ' ' . $assessment->last_name;
        $personalReportName = $assessment->assessment_id . "-" . 
            trim(str_replace(" ", "-", $participantName)) . '-' . 
            date("m-d-Y", strtotime($assessment->created_at)) . ".pdf";

        $personalFilePath = PROJECT_ROOT . '/assessments/pdf/' . $personalReportName;

        // Already generated
        if (file_exists($personalFilePath)) {
            Logger::info("Assessment Report already exists for {$assessment->assessment_id}");
            $this->markCompleted($assessment);
            return;
        }

        // Check chart images
        $chartImages = [
            'main'   => get_assessment_chart_image($assessment->assessment_id),
            'single' => get_assessment_chart_image($assessment->assessment_id, 'single')
        ];
        if (!$chartImages['main'] || !$chartImages['single']) {
            $this->notifyMissingCharts($assessment);
            return;
        }

        // Fetch choices
        $selfChoices = $this->fetchSelfChoices($assessment);
        $needsChoices = $this->fetchNeedsChoices($assessment);
        if (!$selfChoices || !$needsChoices) {
            return;
        }

        // Render PDF
        $reportHtml = $this->renderTemplate('template-report.php', compact('assessment','selfChoices','needsChoices'));
        $this->createPDFReportFile($personalFilePath, $reportHtml, ['layout' => [215, 307], 'spacing' => [0, 0, 0, 0]]);

        // Emails + notifications
        $this->handleEmails($assessment, $personalFilePath, $personalReportName);

        $this->markCompleted($assessment);
    }

    protected function fetchSelfChoices($assessment)
    {
        $response = $this->selfAssessmentResponsesService->list(['participantSessionId' => $assessment->session_id]);
        if (empty($response->data)) return null;

        $queryParams = array_map(fn($c) => 'questionId[$in]='.$c->questionId, $response->data);
        $queryParams[] = '$limit=10000000';

        $choices = $this->selfAssessmentChoicesService->listByQueryParams($queryParams);
        if (empty($choices->data)) return null;

        // Build lookup map
        $map = [];
        foreach ($choices->data as $choice) {
            $map[$choice->id] = $choice;
        }

        return ['responses' => $response->data, 'map' => $map];
    }

    protected function fetchNeedsChoices($assessment)
    {
        $response = $this->needsAssessmentResponsesService->list(['participantSessionId' => $assessment->session_id]);
        if (empty($response->data)) return null;

        $queryParams = ["surveyId={$assessment->needs_survey_id}"];
        foreach ($response->data as $choice) {
            $queryParams[] = 'id[$in]=' . $choice->choiceId;
        }

        $choices = $this->needsAssessmentChoicesService->listByQueryParams($queryParams);
        return empty($choices->data) ? null : $choices->data;
    }

    protected function handleEmails($assessment, $personalFilePath, $personalReportName)
    {
        $participantName = $assessment->first_name . ' ' . $assessment->last_name;
        $holdReport = false;
        $managerFilePath = $managerReportName = '';

        $assessmentCoupon = CouponTrackingModel::where([
            'assessment_id' => $assessment->assessment_id,
            'usage_status'  => 'completed'
        ])->orderBy('id','ASC')->first();

        if ($assessmentCoupon) {
            $coupon = CouponModel::with(['user','affiliate','company'])->find($assessmentCoupon->coupon_id);
            if ($coupon) {
                $holdReport = $coupon->hold_report ?? 0;

                // Manager report
                if ($coupon->manager_report == 1) {
                    $managerReportName = $assessment->assessment_id . "-" . 
                        trim(str_replace(" ", "-", $participantName)) . '-' .
                        date("m-d-Y", strtotime($assessment->created_at)) . "-Manager-Report.pdf";

                    $managerFilePath = PROJECT_ROOT . '/assessments/pdf/' . $managerReportName;
                    if (!file_exists($managerFilePath)) {
                        $html = $this->renderTemplate('template-manager-report.php', compact('assessment'));
                        $this->createPDFReportFile($managerFilePath, $html, ['layout'=>'A4','spacing'=>[10,5,10,5]]);
                    }
                }

                $sendTo = $this->getEmail($coupon->user->user_email);
                if ($sendTo) {
                    Mail::send($sendTo, 'New Assessment Profile', 'affiliate-company-assessment-notification', [
                        'assessment' => $assessment,
                        'coupon' => $coupon,
                        'personalFilePath' => $personalFilePath,
                        'personalReportName' => $personalReportName,
                        'managerFilePath' => $managerFilePath,
                        'managerReportName' => $managerReportName
                    ]);
                }

                if (!empty($coupon->other_recipients)) {
                    $sendTo = $this->getEmail($coupon->other_recipients);
                    if ($sendTo) {
                        Mail::send($sendTo, 'New Assessment Profile', 'assessment-notification-recipients', [
                            'assessment' => $assessment,
                            'personalFilePath' => $personalFilePath,
                            'personalReportName' => $personalReportName
                        ]);
                    }
                }
            }
        }

        // Send to participant if not held
        if (!$holdReport) {
            $sendTo = $this->getEmail($assessment->user->user_email);
            if ($sendTo) {
                Mail::send($sendTo, 'Your MyTemperament Assessment Profile', 'participant-assessment-notification', [
                    'assessment' => $assessment,
                    'personalFilePath' => $personalFilePath,
                    'personalReportName' => $personalReportName
                ]);
            }
        }

        // Payment thank you
        if ($assessment->payment->end_price > 0) {
            $sendTo = $this->getEmail($assessment->user->user_email);
            if ($sendTo) {
                $assessmentCoupons = CouponTrackingModel::where([
                    'assessment_id' => $assessment->assessment_id,
                    'usage_status' => 'completed'
                ])->orderBy('id','ASC')->get();

                $promotionalCoupon = null;
                if (get_settings_option('affcp_settings.is_promotional')) {
                    $promotionCouponCode = get_settings_option('affcp_settings.promotional_code');
                    if ($promotionCouponCode) {
                        $promotionalCoupon = CouponModel::where(['coupon_code' => $promotionCouponCode])->first();
                    }
                }

                Mail::send($sendTo, 'Thank you for your payment', 'assessment-payment-notification', [
                    'assessment' => $assessment,
                    'personalFilePath' => $personalFilePath,
                    'personalReportName' => $personalReportName,
                    'assessmentCoupons' => $assessmentCoupons,
                    'promotionalCoupon' => $promotionalCoupon
                ]);
            }
        }
    }

    protected function renderTemplate($file, $vars)
    {
        extract($vars);
        ob_start();
        include PROJECT_ROOT . '/api/resources/views/' . $file;
        return ob_get_clean();
    }

    protected function createPDFReportFile(string $filePath, string $html, array $attributes)
    {
        $start = microtime(true);
        $pdf = new Html2Pdf('P', $attributes['layout'], 'fr', true, 'UTF-8', $attributes['spacing']);
        $pdf->pdf->SetDisplayMode('fullpage');
        $pdf->setTestTdInOnePage(false);
        $pdf->writeHTML($html);
        Logger::info("PDF HTML Parsed: {$filePath} in " . round(microtime(true)-$start,2) . "s");
        $pdf->output($filePath, 'F');
        Logger::info("PDF created: {$filePath} in " . round(microtime(true)-$start,2) . "s");
    }

    protected function markCompleted($assessment)
    {
        $assessment->pdf_status = 1;
        $assessment->save();
    }

    protected function notifyMissingCharts($assessment)
    {
        $sendTo = $this->getEmail(get_settings_option('admin_email'));
        if ($sendTo) {
            Mail::send($sendTo, 'Urgent: Assessment Charts are missing', 'assessment-images-missing', [
                'assessments' => [$assessment]
            ]);
        }
    }

    protected function getEmail($email)
    {
        return Config::get('app.env') === 'local' ? Config::get('app.email') : $email;
    }
}
