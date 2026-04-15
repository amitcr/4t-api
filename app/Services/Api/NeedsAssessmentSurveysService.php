<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * NeedsAssessmentSurveysService
 *
 * GraphQL equivalents (developer guide §4.2):
 *   getById() → getNeedsAssessmentSurvey query (includes choicesRequired + inline choices)
 *   list()    → TODO: no detailed query defined in developer guide
 *
 * @since 2.0
 */
class NeedsAssessmentSurveysService extends BaseHttpService
{
    protected string $endpoint = 'needs-assessment-surveys';

    // TODO: GraphQL equivalent not fully documented in developer guide.
    public function list(array $query = [])
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('listNeedsAssessmentSurveys');
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

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('createNeedsAssessmentSurvey');
        }

        return $this->post($this->endpoint, $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('updateNeedsAssessmentSurvey');
        }

        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('patchNeedsAssessmentSurvey');
        }

        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('deleteNeedsAssessmentSurvey');
        }

        return $this->delete("{$this->endpoint}/{$id}");
    }

    // ── GraphQL private methods ───────────────────────────────────────────────

    private function graphqlGetById(string $id): ?object
    {
        $gql = <<<'GQL'
            query GetNeedsAssessmentSurvey($id: ID!) {
              getNeedsAssessmentSurvey(id: $id) {
                id version choicesRequired
                choices { id title description order }
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }
}
