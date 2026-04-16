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
        $gql = 'query ListNeedsAssessmentResults($filter: NeedsAssessmentResultFilterInput, $paginate: PaginateInput) {
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
        }';

        return $this->graphqlClient->graphql($gql, []);
    }

    public function getById($id, $query = [])
    {
        $gql = 'query GetNeedsAssessmentResult($id: ID!) {
            getNeedsAssessmentResult(id: $id) {
                id
                rankedTemperaments
                dCount dScore dPriority
                iCount iScore iPriority
                sCount sScore sPriority
                cCount cScore cPriority
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
        return $this->graphqlNotImplemented('createNeedsAssessmentResult');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->graphqlNotImplemented('updateNeedsAssessmentResult');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchNeedsAssessmentResult');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteNeedsAssessmentResult');
    }
}
