<?php
namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * TODO: GraphQL equivalents (developer guide §4.1):
 *   - list()    → listSelfAssessmentSurveys query
 *   - getById() → getSelfAssessmentSurvey query
 */
class SelfAssessmentSurveysService extends BaseHttpService
{
    protected string $endpoint = 'self-assessment-surveys';

    // TODO: GraphQL equivalent — listSelfAssessmentSurveys query
    public function list(array $query = [])
    {
        return $this->get($this->endpoint, $query);
    }

    // TODO: GraphQL equivalent — getSelfAssessmentSurvey query
    public function getById($id, $query = [])
    {
        return $this->get("{$this->endpoint}/{$id}", $query);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
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

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->delete("{$this->endpoint}/{$id}");
    }
}
