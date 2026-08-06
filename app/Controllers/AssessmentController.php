<?php
namespace App\Controllers;

use App\Models\AssessmentModel;
use App\Models\AssessmentPaymentModel;
use App\Models\UserMetaModel;
use App\Models\ParticipantModel;
use App\Core\Request;
use App\Core\Response;


use App\Services\JwtService;
use App\Services\PasswordHashService as PasswordHash;
use App\Services\Api\ParticipantSessionsService;
use App\Services\Api\NeedsAssessmentResponsesService;

use Carbon\Carbon;

class AssessmentController
{
    protected $jwt;

    protected $participantSessionService;

    protected $needsAssessmentResponsesService;

    public function __construct()
    {
        $this->jwt = new JwtService();
        $this->participantSessionService = new ParticipantSessionsService();
        $this->needsAssessmentResponsesService = new NeedsAssessmentResponsesService();
    }

    // Example: GET /api/assessments
    public function index(Request $request) {
        // Extract query params from request
        $orderBy   = $request->get('order_by', 'assessment_id');   // default order by id
        $order     = $request->get('order', 'asc');     // default ASC
        $limit     = (int) $request->get('limit', 10);  // default 10 records
        $page      = (int) $request->get('page', 1);    // default first page
        $offset    = ($page - 1) * $limit;


        // Get total rows
        $totalRows = AssessmentModel::count();

        // Get paginated records
        $records = AssessmentModel::orderBy($orderBy, $order)
            ->skip($offset)
            ->take($limit)
            ->get();

        // Prepare response with extra params
        return [
            'total_rows' => $totalRows,
            'page'       => $page,
            'limit'      => $limit,
            'total_pages'=> ceil($totalRows / $limit),
            // 'order_by'   => $orderBy,
            // 'order'      => $order,
            'data' => $records,
        ];
    }

    // Example: GET /api/assessments/{id}
    public function show(Request $request, $id) {
        return AssessmentModel::find($id); // find by PK
    }

    // Example: POST /api/assessments
    public function store(Request $request) {
        
        // Check token exists or not
        $data = $request->all();
        if(!isset($data->first_name)){
            $first_name = UserMetaModel::where(['user_id' => $request->tokendata['user_id'], 'meta_key' => 'first_name'])->value('meta_value');
            if(!$first_name) {
                $first_name = '';
            }
            $last_name = UserMetaModel::where(['user_id' => $request->tokendata['user_id'], 'meta_key' => 'last_name'])->value('meta_value');
            if(!$last_name) {   
                $last_name = '';
            }
        }

        $participant = ParticipantModel::find($request->tokendata['participant_id']);
        if(empty($participant)){
            return Response::json(['Invalid Request'], 400);
        }

        $assessment = AssessmentModel::create([
            'user_id' => $request->tokendata['user_id'],
            'participant_id' => $request->tokendata['participant_id'],
            'assessment_status' => 'active',
            'first_name'    =>  $first_name,
            'last_name'    =>  $last_name,
            'created_at'    =>  Carbon::now()
            // Add other default fields as necessary
        ]);

        if($assessment->assessment_id){
            $hasher = new PasswordHash(8, true);
            // generate encrypted password
            $applicationUniqueIdentifier = $hasher->hashPassword($assessment->assessment_id);
            // start new self assessment session on Scoring Engine
            $participantSession = $this->participantSessionService->create([
                'participantId' => $participant->participantId,
                'applicationUniqueIdentifier'   =>  $applicationUniqueIdentifier,
                // 'action'    =>  'START_SELF_ASSESSMENT'
            ]);

            if($participantSession->id){
                $assessment->session_id = $participantSession->id;
                $session = $this->participantSessionService->updateById($participantSession->id, ['action' => 'START_SELF_ASSESSMENT']);
                if($session->id){
                    // update assessment session_id, started_at, assessment_status = start
                    $assessment->assessment_status = 'start';
                    $assessment->started_at = Carbon::now();
                    $assessment->survey_id = $session->id;
                }
            }
        }
        // print_r($assessment); die;
        $assessment->save();

        // Create Assessment Payment
        $payment = AssessmentPaymentModel::firstOrCreate([
            'assessment_id' =>  $assessment->assessment_id,
            'status' =>  'pending',
            'user_id' =>  $assessment->user_id,
            'participant_id' =>  $assessment->participant_id,
            'global_price' =>  get_personal_report_global_price(),
            'end_price' =>  get_personal_report_global_price(),
        ]);

        if($assessment->assessment_status == 'start'){
            $step = 'self';
            $redirection_link = get_assessment_self_page_link();
        }else if($assessment->assessment_status == 'completed' && $assessment->needs_assessment_status == 'start'){
            $step = 'needs';
            $redirection_link = get_assessment_needs_page_link();
        }else{
            $step = 'payment';
            $redirection_link = get_assessment_payment_page_link();
        }
        return Response::json(['status' => 'active', 'step' => $step, 'redirection_link' => $redirection_link, 'assessment' => $assessment], 200);
    }

    // Example: PUT /api/assessments/{id}
    public function update(Request $request, $id) {
        $data = $request->all();
        $assessment = AssessmentModel::find($id);
        if (empty($assessment))
            return Response::json(['Invalid Request'], 404);

        if(isset($data->action) && $data->action == "save_needs_assessment_choices"){
            if($assessment->assessment_status == "completed"){
                return Response::json(['assessment' => $assessment], 200);        
            }else{
                $response = $this->needsAssessmentResponsesService->create([
                    'participantSessionId'  =>  $assessment->session_id,
                    'choiceIds' =>  $data->choiceIds
                ]);

                if($response->id){
                    $sessionResponse = $this->participantSessionService->updateById($assessment->session_id, ['action' => 'COMPLETE_NEEDS_ASSESSMENT']);
                }
            }
        }
        $assessment->update($data);
        return $assessment;
    }

    // Example: DELETE /api/assessments/{id}
    public function destroy($id) {
        $assessment = AssessmentModel::find($id);
        if ($assessment) {
            $assessment->delete();
        }
        return ['deleted' => (bool) $assessment];
    }

    // validate assessment status
    public function validate(Request $request) {

        $assessment = AssessmentModel::where('user_id', $request->tokendata['user_id'])->where('assessment_status', '!=', 'finished')->first();
        if(!empty($assessment)) {
            if($assessment->assessment_status == 'start'){
                $step = 'self';
                $redirection_link = get_assessment_self_page_link();
            }else if($assessment->assessment_status == 'completed' && $assessment->needs_assessment_status == 'start'){
                $step = 'needs';
                $redirection_link = get_assessment_needs_page_link();
            }else{
                $step = 'payment';
                $redirection_link = get_assessment_payment_page_link();
            }
            return Response::json(['status' => 'active', 'step' => $step, 'redirection_link' => $redirection_link , 'assessment' => $assessment], 200);
        } else {
            // count finished assessments
            $finishedCount = AssessmentModel::where('user_id', $request->tokendata['user_id'])->where('assessment_status', 'finished')->count();
            if($finishedCount > 0){
                return Response::json(['status' => 'finished', 'total_assessments' => $finishedCount], 200);
            }else{
                return Response::json(['status' => 'none'], 200);
            }
        }
    }    
    
}
