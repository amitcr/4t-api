<?php

namespace App\Controllers\ScoringEngine;

use App\Core\Response;
use App\Services\Api\ParticipantSessionsService;

/**
 * NeedsAssessmentCompleteController
 *
 * Handles POST /v1/scoring-engine/needs-assessment-complete
 *
 * Saves all needs assessment choice responses and completes the session
 * via a single completeNeedsAssessment mutation. Chart generation is
 * handled client-side by the WordPress canvas/html2canvas pipeline.
 *
 * @since 2.0
 */
class NeedsAssessmentCompleteController
{
    protected ParticipantSessionsService $sessions;

    public function __construct()
    {
        $this->sessions = new ParticipantSessionsService();
    }

    /**
     * POST /v1/scoring-engine/needs-assessment-complete
     *
     * Expected body:
     * {
     *   "participantSessionId": "<uuid>",
     *   "assessment_id":        "<wp-local-id>",
     *   "choices": [
     *     { "choiceId": "<uuid>", "priority": 1 },
     *     { "choiceId": "<uuid>", "priority": 2 },
     *     ...
     *   ]
     * }
     */
    public function complete($request)
    {
        $data = $request->all();

        $sessionId    = trim((string) ($data['participantSessionId'] ?? ''));
        $assessmentId = trim((string) ($data['assessment_id']        ?? ''));
        $choices      = $data['choices'] ?? [];

        // --- Validate ---
        if ($sessionId === '') {
            return Response::json(['status' => 400, 'message' => 'participantSessionId is required'], 400);
        }
        if ($assessmentId === '') {
            return Response::json(['status' => 400, 'message' => 'assessment_id is required'], 400);
        }
        if (empty($choices) || !is_array($choices)) {
            return Response::json(['status' => 400, 'message' => 'choices array is required'], 400);
        }

        $responses = array_map(function ($choice) {
            return [
                'choiceId' => (string) ($choice['choiceId'] ?? ''),
                'priority' => (int)   ($choice['priority']  ?? 0),
            ];
        }, array_values($choices));

        $completed   = $this->sessions->completeNeedsAssessmentWithChoices($sessionId, $responses);
        $alreadyDone = false;

        if ($completed === null) {
            $lastError   = $this->sessions->getLastError() ?? '';
            $alreadyDone = stripos($lastError, 'already been completed') !== false;

            if (!$alreadyDone) {
                return Response::json([
                    'status'  => 500,
                    'message' => 'Failed to complete needs assessment: ' . $lastError,
                ], 500);
            }
        }

        return Response::json([
            'status'            => 200,
            'already_completed' => $alreadyDone,
        ], 200);
    }
}
