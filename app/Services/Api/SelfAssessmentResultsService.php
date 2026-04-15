<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * SelfAssessmentResultsService
 *
 * GraphQL equivalents (developer guide §6.1, §6.2):
 *   list()    → listSelfAssessmentResults query
 *   getById() → getSelfAssessmentResult query
 *
 * @since 2.0
 */
class SelfAssessmentResultsService extends BaseHttpService
{
    protected string $endpoint = 'self-assessment-results';

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
            return $this->graphqlNotImplemented('createSelfAssessmentResult');
        }

        return $this->post($this->endpoint, $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('updateSelfAssessmentResult');
        }

        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('patchSelfAssessmentResult');
        }

        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('deleteSelfAssessmentResult');
        }

        return $this->delete("{$this->endpoint}/{$id}");
    }

    // ── GraphQL private methods ───────────────────────────────────────────────

    private function graphqlList(array $query): ?object
    {
        $gql = <<<'GQL'
            query ListSelfAssessmentResults($filter: SelfAssessmentResultFilterInput, $paginate: PaginateInput) {
              listSelfAssessmentResults(filter: $filter, paginate: $paginate) {
                total
                data {
                  id
                  socialRankedTemperaments historicalRankedTemperaments preferenceRankedTemperaments
                  dMostCount dLeastCount dDiff
                  iMostCount iLeastCount iDiff
                  sMostCount sLeastCount sDiff
                  cMostCount cLeastCount cDiff
                }
              }
            }
            GQL;

        $variables = [];

        if (!empty($query['graderId'])) {
            $variables['filter'] = ['graderId' => ['eq' => $query['graderId']]];
        }

        return $this->graphqlClient->graphql($gql, $variables);
    }

    private function graphqlGetById(string $id): ?object
    {
        $gql = <<<'GQL'
            query GetSelfAssessmentResult($id: ID!) {
              getSelfAssessmentResult(id: $id) {
                id
                socialRankedTemperaments historicalRankedTemperaments preferenceRankedTemperaments
                dMostCount dLeastCount dDiff
                iMostCount iLeastCount iDiff
                sMostCount sLeastCount sDiff
                cMostCount cLeastCount cDiff
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }
}
