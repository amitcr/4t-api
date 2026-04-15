<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * SelfAssessmentResponsesService
 *
 * Handles create and delete of self-assessment responses.
 * When GraphQL is enabled the service calls the scoring-engine GraphQL API;
 * otherwise it falls through to the legacy REST path.
 *
 * GraphQL mutations (developer guide §5.2):
 *   - createSelfAssessmentResponse  ← implemented in graphqlCreate()
 *   - deleteSelfAssessmentResponse  ← implemented in graphqlDelete()
 *
 * @since 2.0
 */
class SelfAssessmentResponsesService extends BaseHttpService
{
    protected string $endpoint = 'self-assessment-responses';

    // TODO: GraphQL equivalent — listSelfAssessmentResponses / getSelfAssessmentResponse
    public function list(array $query = [])
    {
        return $this->get($this->endpoint, $query);
    }

    // TODO: GraphQL equivalent — getSelfAssessmentResponse
    public function getById($id, $query = [])
    {
        return $this->get("{$this->endpoint}/{$id}", $query);
    }

    /**
     * Creates a self-assessment response.
     *
     * GraphQL mutation: createSelfAssessmentResponse
     * Required keys in $data: participantSessionId, questionPath, mostChoiceId, leastChoiceId
     */
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
        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    /**
     * Deletes a self-assessment response by ID.
     *
     * GraphQL mutation: deleteSelfAssessmentResponse
     */
    public function deleteById($id)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlDelete((string) $id);
        }

        return $this->delete("{$this->endpoint}/{$id}");
    }

    // ── GraphQL private methods ───────────────────────────────────────────────

    /**
     * Calls createSelfAssessmentResponse mutation.
     * Uses GraphQL variables — user data is never interpolated into the query string.
     *
     * @param  array<string, mixed> $data
     * @return object|null
     */
    private function graphqlCreate(array $data): ?object
    {
        $mutation = <<<'GQL'
            mutation CreateSelfAssessmentResponse($input: CreateSelfAssessmentResponseInput!) {
              createSelfAssessmentResponse(input: $input) {
                id
              }
            }
            GQL;

        $variables = [
            'input' => [
                'participantSessionId' => (string) ($data['participantSessionId'] ?? ''),
                'questionPath'         => (string) ($data['questionPath'] ?? ''),
                'mostChoiceId'         => (string) ($data['mostChoiceId'] ?? ''),
                'leastChoiceId'        => (string) ($data['leastChoiceId'] ?? ''),
            ],
        ];

        return $this->graphqlClient->graphql($mutation, $variables);
    }

    /**
     * Calls deleteSelfAssessmentResponse mutation.
     *
     * @param  string      $id Remote response UUID.
     * @return object|null
     */
    private function graphqlDelete(string $id): ?object
    {
        $mutation = <<<'GQL'
            mutation DeleteSelfAssessmentResponse($id: ID!) {
              deleteSelfAssessmentResponse(id: $id)
            }
            GQL;

        return $this->graphqlClient->graphql($mutation, ['id' => $id]);
    }
}
