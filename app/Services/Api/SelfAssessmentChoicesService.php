<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * SelfAssessmentChoicesService
 *
 * GraphQL equivalents (developer guide §4.1):
 *   list() / listByQueryParams() → listSelfAssessmentChoices query
 *   getById()                    → getSelfAssessmentChoice query
 *
 * @since 2.0
 */
class SelfAssessmentChoicesService extends BaseHttpService
{
    protected string $endpoint = 'self-assessment-choices';

    public function list(array $query = [])
    {
        $gql = 'query ListSelfAssessmentChoices($filter: SelfAssessmentChoiceFilterInput, $sort: SelfAssessmentChoiceSortInput, $paginate: PaginateInput) {
            listSelfAssessmentChoices(filter: $filter, sort: $sort, paginate: $paginate) {
                total
                data { id surveyId questionPath order title description }
            }
        }';

        $variables = [
            'sort'     => ['id' => 'ASC'],
            'paginate' => ['limit' => 500, 'offset' => 0],
        ];

        if (!empty($query['surveyId'])) {
            $variables['filter'] = ['surveyId' => ['eq' => $query['surveyId']]];
        }

        return $this->graphqlClient->graphql($gql, $variables);
    }

    /**
     * Parses raw query-string params (e.g. ['surveyId=abc']) and delegates to the list query.
     */
    public function listByQueryParams(array $query = [])
    {
        $parsed = [];
        foreach ($query as $param) {
            parse_str((string) $param, $kv);
            $parsed = array_merge($parsed, $kv);
        }

        return $this->list($parsed);
    }

    public function getById($id, $query = [])
    {
        $gql = 'query GetSelfAssessmentChoice($id: ID!) {
            getSelfAssessmentChoice(id: $id) {
                id surveyId questionPath order title description
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
        return $this->graphqlNotImplemented('createSelfAssessmentChoice');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->graphqlNotImplemented('updateSelfAssessmentChoice');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchSelfAssessmentChoice');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteSelfAssessmentChoice');
    }
}
