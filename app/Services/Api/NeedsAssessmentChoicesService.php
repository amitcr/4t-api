<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * NeedsAssessmentChoicesService
 *
 * GraphQL equivalents (developer guide §4.2):
 *   list() / listByQueryParams() → listNeedsAssessmentChoices query
 *   getById()                    → getNeedsAssessmentChoice query
 *
 * @since 2.0
 */
class NeedsAssessmentChoicesService extends BaseHttpService
{
    protected string $endpoint = 'needs-assessment-choices';

    public function list(array $query = [])
    {
        $gql = 'query ListNeedsAssessmentChoices($filter: NeedsAssessmentChoiceFilterInput, $sort: NeedsAssessmentChoiceSortInput, $paginate: PaginateInput) {
            listNeedsAssessmentChoices(filter: $filter, sort: $sort, paginate: $paginate) {
                total
                data { id surveyId title description order }
            }
        }';

        $variables = [
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
        $gql = 'query GetNeedsAssessmentChoice($id: ID!) {
            getNeedsAssessmentChoice(id: $id) {
                id surveyId title description order
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
        return $this->graphqlNotImplemented('createNeedsAssessmentChoice');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->graphqlNotImplemented('updateNeedsAssessmentChoice');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchNeedsAssessmentChoice');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteNeedsAssessmentChoice');
    }
}
