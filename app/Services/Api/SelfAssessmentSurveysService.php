<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * SelfAssessmentSurveysService
 *
 * GraphQL equivalents (developer guide §4.1):
 *   list()    → listSelfAssessmentSurveys query
 *   getById() → getSelfAssessmentSurvey query (includes inline choices)
 *
 * @since 2.0
 */
class SelfAssessmentSurveysService extends BaseHttpService
{
    protected string $endpoint = 'self-assessment-surveys';

    public function list(array $query = [])
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlList($query);
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
            return $this->graphqlNotImplemented('createSelfAssessmentSurvey');
        }

        return $this->post($this->endpoint, $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('updateSelfAssessmentSurvey');
        }

        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('patchSelfAssessmentSurvey');
        }

        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('deleteSelfAssessmentSurvey');
        }

        return $this->delete("{$this->endpoint}/{$id}");
    }

    // ── GraphQL private methods ───────────────────────────────────────────────

    private function graphqlList(array $query): ?object
    {
        $gql = <<<'GQL'
            query ListSelfAssessmentSurveys($filter: SelfAssessmentSurveyFilterInput, $paginate: PaginateInput) {
              listSelfAssessmentSurveys(filter: $filter, paginate: $paginate) {
                total
                data { id version }
              }
            }
            GQL;

        $variables = [];

        if (!empty($query['editionId'])) {
            $variables['filter'] = ['editionId' => ['eq' => $query['editionId']]];
        }

        return $this->graphqlClient->graphql($gql, $variables);
    }

    private function graphqlGetById(string $id): ?object
    {
        $gql = <<<'GQL'
            query GetSelfAssessmentSurvey($id: ID!) {
              getSelfAssessmentSurvey(id: $id) {
                id version
                choices { id questionPath order title description }
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }
}
