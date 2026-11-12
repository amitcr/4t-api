<?php
namespace App\Controllers;


use App\Models\UserModel;
use App\Models\UserMetaModel;
use App\Models\ParticipantModel;
use App\Models\ParticipantSessionModel;
use App\Services\JwtService;
use App\Services\Api\ParticipantsService;
use App\Services\PasswordHashService as PasswordHash;
use Carbon\Carbon;
use Faker\Factory as Faker;

use App\Core\Response;

class AuthController
{
    protected $jwt;
    protected $participantService;
    protected $expire_time;

    public function __construct()
    {
        $this->jwt = new JwtService();
        $this->participantService = new ParticipantsService();
        $this->expire_time = 120;
    }

    /**
     * Create dummy user + participant + auth token
     */
    public function registerDummyUser($request)
    {
        // 1. Generate random dummy user data
        $faker = Faker::create();
        $firstName = $faker->firstName;
        $lastName = $faker->lastName;
        $email = $faker->unique()->safeEmail;
        $username = explode('@', $email)[0];

        // create instance (same as WP: 8 iterations, portable hashes = true)
        $hasher = new PasswordHash(8, true);
        // generate encrypted password
        $hashed_password = $hasher->hashPassword('Admin@123');
        $userData = [
            'user_login' => $username,
            'user_pass' => $hashed_password,
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
            return ['error' => 'User creation failed'];
        }else{
            // Create User Meta
            $userMetaData = [
                [
                    'user_id' => $user->ID,
                    'meta_key' => 'first_name',
                    'meta_value' => $firstName,
                ],
                [
                    'user_id' => $user->ID,
                    'meta_key' => 'last_name',
                    'meta_value' => $lastName,
                ]
            ];
            foreach($userMetaData as $meta){
                UserMetaModel::create($meta);
            }
        }

        // 2. Create participant linked to user
        $participantData = [
            'user_id' => $user->ID,
            'participantIdentifier' => $hasher->hashPassword($email),
            'status' => 'active',
            'date_registered' => Carbon::now(),
            'temp' => 1, // mark as temp dummy user
        ];
        $participant = ParticipantModel::create($participantData);
        
        if(!$participant){
            return ['error' => 'Participant creation failed'];
        }else{
            $participantArray = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'applicationUniqueIdentifier' => $participant->participantIdentifier,
                'details' => [
                    'email' => $email
                ]
            ];

            $response = $this->participantService->create($participantArray);
            if($response && isset($response->id)){
                $participant->participantId = $response->id;
                $participant->save();
            }else{
                return ['error' => 'Participant API creation failed', 'response' => $response];
            }
        }


        // 3. Expire old sessions (safety)
        ParticipantSessionModel::where('user_id', $user->ID)
            ->where('participant_id', $participant->participant_id)
            ->where('expires_at', '>', Carbon::now())
            ->update(['expires_at' => Carbon::now()]);

        // 4. Create JWT token
        $payload = [
            'user_id'   => $user->ID,
            'participant_id'   => $participant->participant_id,
            'email'     => $user->user_email,
            'iat'       => time(),
            'exp'       => time() + $this->expire_time,
        ];
        $access_token = $this->jwt->generateToken($payload);
        $refreshToken = bin2hex(random_bytes(32)); // secure random string

        // 5. Store session
        $session = ParticipantSessionModel::create([
            'user_id'      => $user->ID,
            'participant_id'=> $participant->participant_id,
            'access_token'   => $access_token,
            'refresh_token'   => $refreshToken,
            'ip_address'   => $request->headers['X-Forwarded-For'] ?? $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent'   => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'expires_at'   => Carbon::now()->addMinutes(1),
            'refresh_expires_at'   => Carbon::now()->addDays(7),
            'created_at'   => Carbon::now(),
        ]);

        if(!$session){
            return ['error' => 'Session creation failed'];
        }

        return Response::json([
            'access_token' => $access_token,
            'refresh_token' => $refreshToken,
            'expires_in' => 3600,
            'user' => [
                'id' => $user->ID,
                'email' => $user->user_email,
                'display_name' => $user->display_name,
            ],
            'participant' => [
                'id' => $participant->participant_id,
                'identifier' => $participant->participantIdentifier,
            ],
        ]);
    }

    /**
     * Login registered users
     */
    public function login($request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = UserModel::where('user_email', $email)->first();
        // if (!$user || !password_verify($password, $user->user_pass)) {
        //     return ['error' => 'Password Invalid credentials'];
        // }

        // Unknown email and soft-deleted account (user_status = 2) get the same answer as a
        // wrong password, as on the WordPress login, so the reply doesn't reveal either.
        $wp_hasher = new PasswordHash(8, true); // same params as WP
        if (!$user || (int) $user->user_status === 2 || !$wp_hasher->checkPassword((string) $password, $user->user_pass)) {
            return ['error' => 'Invalid credentials'];
        }

        $participant = ParticipantModel::where('user_id', $user->ID)->first();
        if (!$participant) {
            return ['error' => 'Participant not found'];
        }

        // Expire old sessions
        ParticipantSessionModel::where('user_id', $user->ID)
            ->where('participant_id', $participant->participant_id)
            ->where('expires_at', '>', Carbon::now())
            ->update(['expires_at' => Carbon::now()]);

        // Create token
        $payload = [
            'sub'   => $user->ID,
            'email' => $user->user_email,
            'iat'   => time(),
            'exp'   => time() + $this->expire_time,
        ];
        $access_token = $this->jwt->generateToken($payload);
        $refreshToken = bin2hex(random_bytes(32)); // secure random string

        ParticipantSessionModel::create([
            'user_id'      => $user->ID,
            'participant_id'=> $participant->participant_id,
            'access_token'   => $access_token,
            'refresh_token'   => $refreshToken,
            'ip_address'   => $request->headers['X-Forwarded-For'] ?? $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent'   => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'expires_at'   => Carbon::now()->addMinutes(1),
            'refresh_expires_at'   => Carbon::now()->addDays(7),
            'created_at'   => Carbon::now(),
        ]);

        return [
            'access_token' => $access_token,
            'refresh_token' => $refreshToken,
            'expires_in' => 3600,
            'user' => [
                'id' => $user->ID,
                'email' => $user->user_email,
                'display_name' => $user->display_name,
            ],
            'participant' => [
                'id' => $participant->participant_id,
                'identifier' => $participant->participantIdentifier,
            ],
        ];
    }

    /**
     * Validate token
     */
    public function validateToken($request)
    {
        $access_token = $request->bearerToken();
        if (!$access_token) {
            return Response::json(['error' => 'Token missing'], 401);
        }

        $decoded = $this->jwt->validateToken($access_token);
        if (!$decoded) {
            return Response::json(['error' => 'Invalid token'], 401);
        }

        $session = ParticipantSessionModel::where('access_token', $access_token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$session) {
            return Response::json(['error' => 'Session expired or not found'], 401);
        }

        return Response::json([
            'valid' => true,
            'user_id' => $decoded['sub'],
            'email'   => $decoded['email'] ?? null,
        ]);
    }

    /**
     * Logout
     */
    public function logout($request)
    {
        $access_token = $request->bearerToken();
        if (!$access_token) {
            return Response::json(['error' => 'Token missing'], 401);
        }

        ParticipantSessionModel::where('access_token', $access_token)
            ->where('expires_at', '>', Carbon::now())
            ->update(['expires_at' => Carbon::now()]);

        return Response::json(['message' => 'Logged out successfully']);
    }

    public function refresh($request)
    {
        $refreshToken = $request->input('refresh_token');
        if (!$refreshToken) {
            return Response::json(['error' => 'Refresh token missing'], 401);
        }

        $session = ParticipantSessionModel::where('refresh_token', $refreshToken)
            ->where('refresh_expires_at', '>', Carbon::now())
            ->first();

        if (!$session) {
            return Response::json(['error' => 'Invalid or expired refresh token'], 401);
        }

        // Load user & participant
        $user = UserModel::find($session->user_id);
        $participant = ParticipantModel::find($session->participant_id);

        if (!$user || !$participant) {
            return Response::json(['error' => 'Invalid session user/participant'], 401);
        }

        // Soft-deleted account: end this session instead of issuing a new access token.
        if ((int) $user->user_status === 2) {
            $session->expires_at = Carbon::now();
            $session->refresh_expires_at = Carbon::now();
            $session->save();
            return Response::json(['error' => 'Invalid or expired refresh token'], 401);
        }

        // Generate new access token
        $payload = [
            'user_id'   => $user->ID,
            'participant_id' => $participant->participant_id,
            'email'     => $user->user_email,
            'iat'       => time(),
            'exp'       => time() + $this->expire_time,
        ];
        $access_token = $this->jwt->generateToken($payload);

        // Update session
        $session->access_token = $access_token;
        $session->expires_at = Carbon::now()->addHour();
        $session->save();

        return Response::json([
            'access_token' => $access_token,
            'refresh_token' => $refreshToken, // same refresh token still valid
            'expires_in' => 3600,
        ]);
    }
}
