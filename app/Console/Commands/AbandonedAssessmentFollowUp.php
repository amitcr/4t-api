<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;

use App\Models\AssessmentModel;
use App\Models\UserModel;
use App\Models\UserMetaModel;
use App\Models\PostModel;
use App\Models\TestingEntryModel;
use App\Services\Mailjet\ContactsService;
use App\Services\Mailjet\ContactDataService;
use App\Services\Mailjet\ContactListService;
use App\Services\Mailjet\ManageContactListService;
use App\Services\Api\SelfAssessmentResultsService;
use App\Core\Logger;
use App\Core\Config;
use Carbon\Carbon;

class AbandonedAssessmentFollowUp implements CommandInterface
{
    // public $signature = 'assessments:abandoned {days=7}';
    public $signature = 'assessments:abandoned-followup';
    public $description = 'Send Abandoned Assessment Follow up emails via Mailjet';

    protected $contactService;
    protected $manageContactListService;
    protected $selfAssessmentResultsService;
    protected $secondaryListId;

    public function __construct(){
        $this->contactService = new ContactsService();
        $this->contactDataService = new ContactDataService();
        $this->manageContactListService = new ManageContactListService();
        $this->selfAssessmentResultsService = new SelfAssessmentResultsService();

        $this->secondaryListId = get_settings_option('mytemp_settings.assessment_abandoned_secondary_list_id');
    }

    public function handle($arguments)
    {
        // $days = (int)($arguments['days'] ?? 7);
        $contactListId = get_settings_option('mytemp_settings.assessment_abandoned_list_id');
        if(empty($contactListId))
            return;

        // echo AssessmentModel::abandoned()->toSql(); die;
        $abandonedAssessments = AssessmentModel::with(['user','payment'])->abandoned()->get();
        // pr($abandonedAssessments); die;
        if($abandonedAssessments->isEmpty())
            return;

        foreach($abandonedAssessments as $assessment){
            // echo $assessment->assessment_id; die;
            // pr($assessment); die;
            

            if(!empty($assessment->details) && isset($assessment->details->subscribed_at))
                continue;

            $contactId = UserMetaModel::where(['user_id' => $assessment->user_id, 'meta_key' => '_mailjet_contact_id'])->value('meta_value');

            $participantName = get_assessment_participant_name($assessment);
            $participantFirstName = get_assessment_participant_name($assessment, 'first');
            $participantLastName = get_assessment_participant_name($assessment, 'last');

            if(empty($contactId)){
                // $user = UserModel::find($assessment->user_id);
                $response = $this->contactService->create(["Name"  => trim($participantName),"Email" =>  $assessment->user->user_email,"IsExcludedFromCampaigns" =>  false]);
                if($response->success()){
                    Logger::info('Contact Creation Response: ', $response->getData());
                    $contact = $response->getData();
                    $contactId = $contact[0]['ID'];
                    UserMetaModel::create(['user_id' => $assessment->user_id, 'meta_key' => '_mailjet_contact_id', 'meta_value' => $contactId]);
                }else{
                    $error = $response->getData();
                    Logger::error('Contact Creation Failed: '.$error['ErrorMessage']);
                }
            }

            if(!empty($contactId)){
                $contactData = [
                    "Data"   =>  [
                        [
                            "Name"  =>  "name",
                            "Value"  =>  trim($participantName),
                        ],
                        [
                            "Name"  =>  "firstname",
                            "Value"  =>  $participantFirstName,
                        ],
                        [
                            "Name"  =>  "lastname",
                            "Value"  =>  $participantLastName,
                        ],
                        [
                            "Name"  =>  "userid",
                            "Value"  =>  md5($assessment->user_id),
                        ],
                        [
                            "Name"  =>  "samplereportlink",
                            "Value"  =>  get_settings_option('home')."view-sample-report/?mjuid=".md5($assessment->user_id).'&ftaid='.md5($assessment->assessment_id),
                        ],
                        [
                            "Name"  =>  "customlink",
                            "Value"  =>  get_settings_option('home')."?mjuid=".md5($assessment->user_id).'&ftaid='.md5($assessment->assessment_id),
                        ],
                        [
                            "Name"  =>  "assessmentid",
                            "Value"  =>  md5($assessment->assessment_id),
                        ],
                        [
                            "Name"  =>  "assessmentprice",
                            "Value"  =>  $assessment->payment->end_price,
                        ],
                        [
                            "Name"  =>  "discount",
                            "Value"  => number_format( ((($assessment->payment->global_price-$assessment->payment->end_price)*100)/$assessment->payment->global_price), 2)
                        ],
                        [
                            "Name"  =>  "purchased",
                            "Value"  => "No"
                        ]
                    ],                 
                    "ContactID"    =>  $contactId
                ];

                $assessmentResults = $this->selfAssessmentResultsService->getById($assessment->assessment_result_id);
                if(!empty($assessmentResults) && isset($assessmentResults->id)){
                    $contactData["Data"][] = ["Name"  =>  "pattern", "Value"  => strtoupper($assessmentResults->details->preferencePatternTitle)];
                    $contactData["Data"][] = ["Name"  =>  "primary", "Value"  => ucwords(strtolower($assessmentResults->details->preferenceRankedTemperaments[0]))];
                    $contactData["Data"][] = ["Name"  =>  "secondary", "Value"  => ucwords(strtolower($assessmentResults->details->preferenceRankedTemperaments[1]))];
                }

                $post = PostModel::find(get_settings_option('mytemp_settings.mytemp_mini_report'));
                if(!empty($post)){
                    $contactData["Data"][] = ["Name"  =>  "minireport", "Value"  => $post->guid."?mjuid=".md5($assessment->user_id).'&ftaid='.md5($assessment->assessment_id)."&sessionId=".md5($assessment->assessment_id)];
                }

                $contactDataResponse = $this->contactDataService->updateById($contactId, $contactData);
                if($contactDataResponse->success()){
                    $response = $contactDataResponse->getData();
                    Logger::info('Contact Data Updated: ', $response);

                    $assessmentVariation = TestingEntryModel::where(['data_id' => $assessment->assessment_id, 'data_type' => 'assessment'])->first();
                    if(!empty($assessmentVariation) && $assessmentVariation->variation != "control"){
                        $contactListId = Config::get('app.mailjet_mini_list_id') ?? $contactListId;
                    }else if(!empty($this->secondaryListId)){
                        $contactListId = $this->validateAssessmentListId($contactListId);
                    }
                    
                    $args = [
                        "ContactsLists"    =>  [
                            [
                                "ListID"    =>  $contactListId,
                                "Action"    =>  "addforce" // unsub, addforce, addnoforce, remove
                            ]
                        ]
                    ];
                    // pr($args); die;
                    $ContactsListResponse = $this->manageContactListService->updateById($contactId, $args);
                    if($ContactsListResponse->success()){
                        $response = $ContactsListResponse->getData();
                        Logger::info('Contact List Subscription: ', $response);

                        // Current details is casted as object (from JsonToObjectCast)
                        $details = (array) ($assessment->details ?? new \stdClass());

                        // Merge existing object with new array
                        $updateArray = ["subscribed_at" => date("Y-m-d H:i:s"), 'listId' => abs($contactListId)];
                        $updatedDetails = array_replace_recursive($details, $updateArray);
                        // Save back (cast will handle encoding to JSON)
                        $assessmentDetails = (object) $updatedDetails;
                        
                        $assessment->details = $assessmentDetails;
                        $response = $assessment->save();
                    }else{
                        $error = $ContactsListResponse->getData();
                        Logger::error('Contact List Subscription Failed: '.$error['ErrorMessage']);
                    }
                }else{
                    $error = $contactDataResponse->getData();
                    Logger::error('Contact Data Update Failed: '.$error['ErrorMessage']);
                }
            }

            // pr($assessment);
            // die("First Row Updated!");
        }
    }

    protected function validateAssessmentListId($contactListId)
    {
        $lastAssessmentDetails = AssessmentModel::where('details', 'LIKE', '%listId%')
            ->where('details', 'NOT LIKE', '%' . Config::get('app.mailjet_mini_list_id') . '%')
            ->orderByDesc('assessment_id')
            ->first(['details']); // only fetch details column

        if (empty($lastAssessmentDetails)) {
            return $contactListId;
        }

        if(!is_object($lastAssessmentDetails->details)){
            $details = json_decode($lastAssessmentDetails->details);
        }else{
            $details = $lastAssessmentDetails->details;
        }

        if (isset($details->listId) && $details->listId == $contactListId) {
            return $this->secondaryListId;
        }

        return $contactListId;
    }
}
