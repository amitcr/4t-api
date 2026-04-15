<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * ParticipantSessionsService
 *
 * GraphQL equivalents (developer guide §5):
 *   list()       → listParticipantSessions query       (TODO — guide shows getParticipantSession only)
 *   getById()    → getParticipantSession query
 *   create()     → createParticipantSession mutation
 *   updateById() → TODO: no equivalent defined in developer guide
 *   patchById()  → action-based dispatch:
 *                    START_SELF_ASSESSMENT     → startSelfAssessment mutation
 *                    COMPLETE_SELF_ASSESSMENT  → completeSelfAssessment mutation
 *                    START_NEEDS_ASSESSMENT    → startNeedsAssessment mutation
 *                    COMPLETE_NEEDS_ASSESSMENT → completeNeedsAssessment mutation
 *                    START_VALIDATION_ASSESSMENT → startConfirmation mutation
 *   deleteById() → TODO: no equivalent defined in developer guide
 *
 * @since 2.0
 */
class ParticipantSessionsService extends BaseHttpService
{
    protected string $endpoint = 'participant-sessions';

    // TODO: GraphQL equivalent — listParticipantSessions not documented in developer guide.
    public function list(array $query = [])
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('listParticipantSessions');
        }

        return $this->get($this->endpoint, $query);
    }

    public function getById($id, $query = [])
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlGetById((string) $id);
        }

        return $this->get("{$this->endpoint}/{$id}", $query);
    }

    public function create(array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlCreate($data);
        }

        return $this->post($this->endpoint, $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('updateParticipantSession');
        }

        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    /**
     * Routes to the correct GraphQL mutation based on the 'action' key in $data.
     * REST action values map to dedicated GraphQL mutations per developer guide §9.
     */
    public function patchById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlPatch((string) $id, $data);
        }

        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('deleteParticipantSession');
        }

        return $this->delete("{$this->endpoint}/{$id}");
    }

    // ── GraphQL private methods ───────────────────────────────────────────────

    private function graphqlGetById(string $id): ?object
    {
        $gql = <<<'GQL'
            query GetParticipantSession($id: ID!) {
              getParticipantSession(id: $id) {
                id applicationUid
                selfAssessmentSurveyId selfAssessmentStartedAt selfAssessmentCompletedAt
                needsAssessmentSurveyId needsAssessmentStartedAt needsAssessmentCompletedAt
                confirmationSurveyId confirmationAssessmentStartedAt confirmationAssessmentCompletedAt
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }

    private function graphqlCreate(array $data): ?object
    {
        $gql = <<<'GQL'
            mutation CreateParticipantSession($input: CreateParticipantSessionInput!) {
              createParticipantSession(input: $input) {
                id editionId
                selfAssessmentSurveyId
              }
            }
            GQL;

        $input = [
            'participantId'  => (string) ($data['participantId']  ?? ''),
            'applicationUid' => (string) ($data['applicationUid'] ?? ''),
        ];

        if (!empty($data['editionId'])) {
            $input['editionId'] = (string) $data['editionId'];
        }

        return $this->graphqlClient->graphql($gql, ['input' => $input]);
    }

    /**
     * Dispatches action-based PATCH requests to dedicated GraphQL mutations.
     *
     * @param  string  $id   Session UUID.
     * @param  array   $data Must contain 'action' key matching one of the REST action constants.
     * @return object|null
     */
    private function graphqlPatch(string $id, array $data): ?object
    {
        $action = strtoupper((string) ($data['action'] ?? ''));

        switch ($action) {
            case 'START_SELF_ASSESSMENT':
                return $this->graphqlStartSelfAssessment($id);

            case 'COMPLETE_SELF_ASSESSMENT':
                return $this->graphqlCompleteSelfAssessment($id);

            case 'START_NEEDS_ASSESSMENT':
                return $this->graphqlStartNeedsAssessment($id);

            case 'COMPLETE_NEEDS_ASSESSMENT':
                return $this->graphqlCompleteNeedsAssessment($id);

            case 'START_VALIDATION_ASSESSMENT':
                return $this->graphqlStartConfirmation($id);

            default:
                return $this->graphqlNotImplemented("patchParticipantSession[{$action}]");
        }
    }

    private function graphqlStartSelfAssessment(string $id): ?object
    {
        $gql = <<<'GQL'
            mutation StartSelfAssessment($id: ID!) {
              startSelfAssessment(id: $id) {
                id selfAssessmentSurveyId selfAssessmentStartedAt
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }

    private function graphqlCompleteSelfAssessment(string $id): ?object
    {
        $gql = <<<'GQL'
            mutation CompleteSelfAssessment($id: ID!) {
              completeSelfAssessment(id: $id) {
                id selfAssessmentCompletedAt selfAssessmentGraderId
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }

    private function graphqlStartNeedsAssessment(string $id): ?object
    {
        $gql = <<<'GQL'
            mutation StartNeedsAssessment($id: ID!) {
              startNeedsAssessment(id: $id) {
                id needsAssessmentSurveyId needsAssessmentStartedAt
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }

    private function graphqlCompleteNeedsAssessment(string $id): ?object
    {
        $gql = <<<'GQL'
            mutation CompleteNeedsAssessment($id: ID!) {
              completeNeedsAssessment(id: $id) {
                id needsAssessmentCompletedAt
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }

    private function graphqlStartConfirmation(string $id): ?object
    {
        $gql = <<<'GQL'
            mutation StartConfirmation($id: ID!) {
              startConfirmation(id: $id) {
                id confirmationSurveyId confirmationAssessmentStartedAt
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }
}
