<?php
namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * TODO: GraphQL equivalents (developer guide §5):
 *   - create()      → createParticipantSession mutation
 *   - patchById()   → startSelfAssessment / completeSelfAssessment /
 *                     startNeedsAssessment / completeNeedsAssessment /
 *                     startConfirmation mutations (action-based PATCH → dedicated mutations)
 */
class ParticipantSessionsService extends BaseHttpService
{
    protected string $endpoint = 'participant-sessions';

    // TODO: GraphQL equivalent — listParticipantSessions query
    public function list(array $query = [])
    {
        return $this->get($this->endpoint, $query);
    }

    // TODO: GraphQL equivalent — getParticipantSession query
    public function getById($id, $query = [])
    {
        return $this->get("{$this->endpoint}/{$id}", $query);
    }

    // TODO: GraphQL equivalent — createParticipantSession mutation
    public function create(array $data)
    {
        return $this->post($this->endpoint, $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    /**
     * TODO: GraphQL equivalents — action-based PATCH maps to dedicated mutations:
     *   START_SELF_ASSESSMENT     → startSelfAssessment(id)
     *   COMPLETE_SELF_ASSESSMENT  → completeSelfAssessment(id)
     *   START_NEEDS_ASSESSMENT    → startNeedsAssessment(id)
     *   COMPLETE_NEEDS_ASSESSMENT → completeNeedsAssessment(id)
     *   START_VALIDATION_ASSESSMENT → startConfirmation(id)
     */
    public function patchById($id, array $data)
    {
        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->delete("{$this->endpoint}/{$id}");
    }
}
