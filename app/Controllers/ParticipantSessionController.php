<?php
namespace App\Controllers;

use App\Models\ParticipantSessionModel;
use App\Models\ParticipantModel;
use App\Models\UserModel;
use App\Models\UserMetaModel;

use Faker\Factory as Faker;
class ParticipantSessionController
{
    // Example: GET /api/assessments
    public function index($request) {
        // Extract query params from request
        $orderBy   = $request->get('order_by', 'id');   // default order by id
        $order     = $request->get('order', 'asc');     // default ASC
        $limit     = (int) $request->get('limit', 10);  // default 10 records
        $page      = (int) $request->get('page', 1);    // default first page
        $offset    = ($page - 1) * $limit;


        // Get total rows
        $totalRows = ParticipantSessionModel::count();

        // Get paginated records
        $records = ParticipantSessionModel::orderBy($orderBy, $order)
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
    public function show($request, $id) {
        return ParticipantSessionModel::find($id); // find by PK
    }

    // Example: POST /api/assessments
    public function store($data) {
        return ParticipantSessionModel::create($data);
    }

    // Example: PUT /api/assessments/{id}
    public function update($request, $id) {
        $data = $request->all();
        $assessment = ParticipantSessionModel::find($id);
        if ($assessment) {
            $assessment->update($data);
        }
        return $assessment;
    }

    // Example: DELETE /api/assessments/{id}
    public function destroy($id) {
        $assessment = ParticipantSessionModel::find($id);
        if ($assessment) {
            $assessment->delete();
        }
        return ['deleted' => (bool) $assessment];
    }

    // Create User, Participant and Participant Session for dummy users, manage all within transaction to rollback if anything fails
    public function createDummyParticipantSession($data){
        // Create Dummy User
        $faker = Faker::create();
        $firstName = $faker->firstName;
        $lastName = $faker->lastName;
        $email = $faker->unique()->safeEmail;
        $username = explode('@', $email)[0];

        $userData = [
            'user_login' => $username,
            'user_pass' => password_hash('password123', PASSWORD_BCRYPT),
            'user_nicename' => $firstName . ' ' . $lastName,
            'user_email' => $email,
            'user_url' => '',
            'user_registered' => date('Y-m-d H:i:s'),
            'user_activation_key' => '',
            'user_status' => 0,
            'display_name' => $firstName . ' ' . $lastName,
        ];

        $user = UserModel::create($userData);
        if(!$user){
            return null;
        }
        $userId = $user->ID;
        // Create User Meta
        $userMetaData = [
            [
                'user_id' => $userId,
                'meta_key' => 'first_name',
                'meta_value' => $firstName,
            ],
            [
                'user_id' => $userId,
                'meta_key' => 'last_name',
                'meta_value' => $lastName,
            ]
        ];
        foreach($userMetaData as $meta){
            UserMetaModel::create($meta);
        }
        // Create Participant
        $participantData = [
            'user_id' => $userId,
            'participantId' => 'P' . str_pad($userId, 5, '0', STR_PAD_LEFT),
            'participantIdentifier' => 'PID' . str_pad($userId, 5, '0', STR_PAD_LEFT),
            'status' => 'active',
            'date_registered' => date('Y-m-d H:i:s'),
            'temp' => 0,
        ];
        $participant = ParticipantModel::create($participantData);
        if(!$participant){
            return null;
        }

        $participantId = $participant->participant_id;
        // Create Participant Session
        $sessionData = [
            'user_id' => $userId,
            'participant_id' => $participantId,
            'access_token' => bin2hex(random_bytes(16)),
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour')),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $participantSession = ParticipantSessionModel::create($sessionData);
        return $participantSession;
    }
}
