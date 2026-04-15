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

    /**
     * Updates mostChoiceId and leastChoiceId on an existing response.
     *
     * GraphQL mutation: updateSelfAssessmentResponse
     * Required keys in $data: mostChoiceId, leastChoiceId
     */
    public function updateById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlUpdate((string) $id, $data);
        }

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

    private function graphqlCreate(array $data): ?object
    {
        $sessionId = json_encode((string) ($data['participantSessionId'] ?? ''));
        $path      = json_encode((string) ($data['questionId']           ?? '')); // REST sends 'questionId'; GraphQL field is 'questionPath'
        $mostId    = json_encode((string) ($data['mostChoiceId']         ?? ''));
        $leastId   = json_encode((string) ($data['leastChoiceId']        ?? ''));

        $mutation = "mutation { createSelfAssessmentResponse(input: { participantSessionId: {$sessionId} questionPath: {$path} mostChoiceId: {$mostId} leastChoiceId: {$leastId} }) { id } }";

        $result = $this->graphqlClient->graphql($mutation);

        // Normalise to REST shape: { id: "..." }
        // GraphQL returns: { createSelfAssessmentResponse: { id: "..." } }
        $id = $result->createSelfAssessmentResponse->id ?? null;

        if ($id) {
            return (object) ['id' => $id];
        }

        // Surface the human-readable error so the controller can return it to the frontend.
        $message = $this->graphqlClient->getLastError() ?? 'Your response could not be saved. Please try again.';
        return (object) ['error' => true, 'message' => $message];
    }

    private function graphqlUpdate(string $id, array $data): object
    {
        $idStr   = json_encode($id);
        $mostId  = json_encode((string) ($data['mostChoiceId']  ?? ''));
        $leastId = json_encode((string) ($data['leastChoiceId'] ?? ''));

        $mutation = "mutation { updateSelfAssessmentResponse(id: {$idStr}, input: { mostChoiceId: {$mostId} leastChoiceId: {$leastId} }) { id } }";

        $result = $this->graphqlClient->graphql($mutation);

        $returnedId = $result->updateSelfAssessmentResponse->id ?? null;

        if ($returnedId) {
            return (object) ['id' => $returnedId];
        }

        $message = $this->graphqlClient->getLastError() ?? 'Your response could not be updated. Please try again.';
        return (object) ['error' => true, 'message' => $message];
    }

    private function graphqlDelete(string $id): ?object
    {
        $idStr    = json_encode($id);
        $mutation = "mutation { deleteSelfAssessmentResponse(id: {$idStr}) }";

        return $this->graphqlClient->graphql($mutation);
    }
}
