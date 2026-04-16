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
        $gql = 'query ListSelfAssessmentResults($filter: SelfAssessmentResultFilterInput, $paginate: PaginateInput) {
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
        }';

        $variables = [];

        if (!empty($query['graderId'])) {
            $variables['filter'] = ['graderId' => ['eq' => $query['graderId']]];
        }

        return $this->graphqlClient->graphql($gql, $variables);
    }

    public function getById($id, $query = [])
    {
        $gql = 'query GetSelfAssessmentResult($id: ID!) {
            getSelfAssessmentResult(id: $id) {
                id
                socialRankedTemperaments historicalRankedTemperaments preferenceRankedTemperaments
                dMostCount dLeastCount dDiff
                iMostCount iLeastCount iDiff
                sMostCount sLeastCount sDiff
                cMostCount cLeastCount cDiff
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
        return $this->graphqlNotImplemented('createSelfAssessmentResult');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->graphqlNotImplemented('updateSelfAssessmentResult');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchSelfAssessmentResult');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteSelfAssessmentResult');
    }
}
