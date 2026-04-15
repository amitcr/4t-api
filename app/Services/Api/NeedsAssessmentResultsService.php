<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * NeedsAssessmentResultsService
 *
 * GraphQL equivalents (developer guide §6.3):
 *   list()    → listNeedsAssessmentResults query
 *   getById() → getNeedsAssessmentResult query
 *
 * @since 2.0
 */
class NeedsAssessmentResultsService extends BaseHttpService
{
    protected string $endpoint = 'needs-assessment-results';

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
            return $this->graphqlNotImplemented('createNeedsAssessmentResult');
        }

        return $this->post($this->endpoint, $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('updateNeedsAssessmentResult');
        }

        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('patchNeedsAssessmentResult');
        }

        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('deleteNeedsAssessmentResult');
        }

        return $this->delete("{$this->endpoint}/{$id}");
    }

    // ── GraphQL private methods ───────────────────────────────────────────────

    private function graphqlList(array $query): ?object
    {
        $gql = <<<'GQL'
            query ListNeedsAssessmentResults($filter: NeedsAssessmentResultFilterInput, $paginate: PaginateInput) {
              listNeedsAssessmentResults(filter: $filter, paginate: $paginate) {
                total
                data {
                  id
                  rankedTemperaments
                  dCount dScore dPriority
                  iCount iScore iPriority
                  sCount sScore sPriority
                  cCount cScore cPriority
                }
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, []);
    }

    private function graphqlGetById(string $id): ?object
    {
        $gql = <<<'GQL'
            query GetNeedsAssessmentResult($id: ID!) {
              getNeedsAssessmentResult(id: $id) {
                id
                rankedTemperaments
                dCount dScore dPriority
                iCount iScore iPriority
                sCount sScore sPriority
                cCount cScore cPriority
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }
}
