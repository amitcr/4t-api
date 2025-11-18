<?php
// app/routes.php
use App\Controllers\HealthController;
use App\Controllers\ProtectedController;
use App\Controllers\GraphQLController;
use App\Middleware\CorsMiddleware;
use App\Middleware\RateLimitMiddleware;
use App\Middleware\JwtMiddleware;

use App\Controllers\AuthController;
use App\Controllers\AssessmentController;
use App\Controllers\JobController;
use App\Controllers\ParticipantController;
use App\Controllers\ParticipantSessionController;

use App\Controllers\ScoringEngine\ParticipantController as ScoringParticipantController;
use App\Controllers\ScoringEngine\ParticipantSessionController as ScoringParticipantSessionController;
use App\Controllers\ScoringEngine\SelfAssessmentResponseController;

/**
 * Global/Shared middlewares can be added in Router via $router->group or by modifying Router::__construct
 * Example: API v1 group
 */
$router->group(['prefix' => '/v1', 'middleware' => [CorsMiddleware::class]], function($r) {
    // GET /api/v1/health
    $r->get('/health', [HealthController::class, 'index'], [RateLimitMiddleware::class]);

    // GraphQL endpoint
    $r->any('/graphql', [GraphQLController::class, 'handle'], [RateLimitMiddleware::class]);

    // Param route: GET /api/v1/users/{id}
    $r->get('/users/{id}', function($request, $params) {
        return ['ok' => true, 'id' => $params['id']];
    });

    // Protected route: GET /api/v1/protected/secret
    $r->get('/protected/secret', [ProtectedController::class, 'secret'], [JwtMiddleware::class]);

    
    // Auth routes
    $r->group(['prefix' => '/auth', 'controller' => [AuthController::class]], function($r) {
        $r->post('/login', 'login');
        $r->post('/temporary-registration', 'registerDummyUser');
        $r->post('/refresh', 'refresh');
        $r->post('/logout', 'logout', [JwtMiddleware::class]);
        $r->get('/me', 'me', [JwtMiddleware::class]);
    });
    
    
    // Assessment routes
    // $r->get('/assessments/validate', [AssessmentController::class, 'validateStatus']);
    $r->group(['prefix' => '/assessments', 'controller' => AssessmentController::class ], function($r) {
        $r->post('/validate', 'validate', [JwtMiddleware::class]);
        
        $r->get('', 'index');
        $r->get('/{id}', 'show');
        $r->post('', 'store');
        $r->put('/{id}', 'update');
        $r->delete('/{id}', 'destroy');
        
    });
    
    // Jobs routes
    $r->group(['prefix' => '/jobs', 'controller' => JobController::class ], function($r) {
        
        $r->get('', 'index');
        $r->get('/{id}', 'show');
        $r->post('', 'store');
        $r->put('/{id}', 'update');
        $r->delete('/{id}', 'destroy');
        
    });

    // Participant routes
    $r->get('/participants', [ParticipantController::class, 'index']);
    $r->get('/participants/{id}', [ParticipantController::class, 'show']);
    $r->post('/participants', [ParticipantController::class, 'store']);
    $r->put('/participants/{id}', [ParticipantController::class, 'update']);
    $r->patch('/participants/{id}', [ParticipantController::class, 'patch']);
    $r->delete('/participants/{id}', [ParticipantController::class, 'destroy']);

    // Participant Session routes
    $r->get('/participant-sessions', [ParticipantSessionController::class, 'index']);
    $r->get('/participant-sessions/{id}', [ParticipantSessionController::class, 'show']);
    $r->post('/participant-sessions', [ParticipantSessionController::class, 'store']);
    $r->put('/participant-sessions/{id}', [ParticipantSessionController::class, 'update']);
    $r->delete('/participant-sessions/{id}', [ParticipantSessionController::class, 'destroy']);


    // Scoring Engine routes group
    $r->group(['prefix' => '/scoring-engine'], function($r) {
        // Participant routes
        $r->get('/participants', [ScoringParticipantController::class, 'index']);
        $r->get('/participants/{id}', [ScoringParticipantController::class, 'show']);
        $r->post('/participants', [ScoringParticipantController::class, 'store']);
        $r->put('/participants/{id}', [ScoringParticipantController::class, 'update']);
        $r->patch('/participants/{id}', [ScoringParticipantController::class, 'patch']);
        $r->delete('/participants/{id}', [ScoringParticipantController::class, 'destroy']);

        // Participant Sessions routes
        $r->get('/participant-sessions', [ScoringParticipantSessionController::class, 'indexSessions']);
        $r->get('/participant-sessions/{id}', [ScoringParticipantSessionController::class, 'showSession']);
        $r->post('/participant-sessions', [ScoringParticipantSessionController::class, 'storeSession']);
        $r->put('/participant-sessions/{id}', [ScoringParticipantSessionController::class, 'updateSession']);
        $r->patch('/participant-sessions/{id}', [ScoringParticipantSessionController::class, 'patchSession']);
        $r->delete('/participant-sessions/{id}', [ScoringParticipantSessionController::class, 'destroySession']);

        // Self Assessment Responses routes
        $r->get('/self-assessment-responses', [SelfAssessmentResponseController::class, 'index']);
        $r->get('/self-assessment-responses/{id}', [SelfAssessmentResponseController::class, 'show']);
        $r->post('/self-assessment-responses', [SelfAssessmentResponseController::class, 'store']);
        $r->put('/self-assessment-responses/{id}', [SelfAssessmentResponseController::class, 'update']);
        $r->patch('/self-assessment-responses/{id}', [SelfAssessmentResponseController::class, 'patch']);
        $r->delete('/self-assessment-responses/{id}', [SelfAssessmentResponseController::class, 'destroy']);
    });
});

/**
 * API v2 group example (future)
 */
$router->group(['prefix' => '/v2', 'middleware' => [CorsMiddleware::class]], function($r){
    $r->get('/health', [HealthController::class, 'index']);
});



