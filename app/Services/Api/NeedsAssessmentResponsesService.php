<?php
namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * TODO: GraphQL equivalents (developer guide §5.3):
 *   - create()     → createNeedsAssessmentResponse mutation
 *   - updateById() → updateNeedsAssessmentResponse mutation
 *   - deleteById() → deleteNeedsAssessmentResponse mutation
 */
class NeedsAssessmentResponsesService extends BaseHttpService
{
    protected string $endpoint = 'needs-assessment-responses';

    // TODO: GraphQL equivalent — listNeedsAssessmentResponses query
    public function list(array $query = [])
    {
        return $this->get($this->endpoint, $query);
    }

    // TODO: GraphQL equivalent — getNeedsAssessmentResponse query
    public function getById($id, $query = [])
    {
        return $this->get("{$this->endpoint}/{$id}", $query);
    }

    // TODO: GraphQL equivalent — createNeedsAssessmentResponse mutation
    public function create(array $data)
    {
        return $this->post($this->endpoint, $data);
    }

    // TODO: GraphQL equivalent — updateNeedsAssessmentResponse mutation
    public function updateById($id, array $data)
    {
        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: GraphQL equivalent — deleteNeedsAssessmentResponse mutation
    public function deleteById($id)
    {
        return $this->delete("{$this->endpoint}/{$id}");
    }
}
