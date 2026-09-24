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
        return $this->graphqlNotImplemented('listNeedsAssessmentSurveys');
    }

    public function getById($id, $query = [])
    {
        $gql = 'query GetNeedsAssessmentSurvey($id: ID!) {
            getNeedsAssessmentSurvey(id: $id) {
                id version choicesRequired
                choices { id title description order }
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
        return $this->graphqlNotImplemented('createNeedsAssessmentSurvey');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->graphqlNotImplemented('updateNeedsAssessmentSurvey');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchNeedsAssessmentSurvey');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteNeedsAssessmentSurvey');
    }
}
