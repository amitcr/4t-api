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
        $gql = 'query ListSelfAssessmentSurveys($filter: SelfAssessmentSurveyFilterInput, $paginate: PaginateInput) {
            listSelfAssessmentSurveys(filter: $filter, paginate: $paginate) {
                total
                data { id version }
            }
        }';

        $variables = [];

        if (!empty($query['editionId'])) {
            $variables['filter'] = ['editionId' => ['eq' => $query['editionId']]];
        }

        return $this->graphqlClient->graphql($gql, $variables);
    }

    public function getById($id, $query = [])
    {
        $gql = 'query GetSelfAssessmentSurvey($id: ID!) {
            getSelfAssessmentSurvey(id: $id) {
                id version
                choices { id questionPath order title description }
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
        return $this->graphqlNotImplemented('createSelfAssessmentSurvey');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->graphqlNotImplemented('updateSelfAssessmentSurvey');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchSelfAssessmentSurvey');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteSelfAssessmentSurvey');
    }
}
