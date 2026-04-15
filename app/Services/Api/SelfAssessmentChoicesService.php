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
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlList($query);
        }

        return $this->get($this->endpoint, $query);
    }

    /**
     * REST: appends raw query-string params to the URL.
     * GraphQL: delegates to graphqlList() — parse surveyId from the params array if present.
     */
    public function listByQueryParams(array $query = [])
    {
        if ($this->isGraphQLEnabled()) {
            // Attempt to extract surveyId from raw query-string params (e.g. 'surveyId=abc').
            $parsed = [];
            foreach ($query as $param) {
                parse_str((string) $param, $kv);
                $parsed = array_merge($parsed, $kv);
            }

            return $this->graphqlList($parsed);
        }

        $this->endpoint .= '?' . implode('&', $query);

        return $this->getQueryUrl($this->endpoint);
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
            return $this->graphqlNotImplemented('createSelfAssessmentChoice');
        }

        return $this->post($this->endpoint, $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('updateSelfAssessmentChoice');
        }

        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('patchSelfAssessmentChoice');
        }

        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('deleteSelfAssessmentChoice');
        }

        return $this->delete("{$this->endpoint}/{$id}");
    }

    // ── GraphQL private methods ───────────────────────────────────────────────

    private function graphqlList(array $query): ?object
    {
        $gql = <<<'GQL'
            query ListSelfAssessmentChoices($filter: SelfAssessmentChoiceFilterInput, $sort: SelfAssessmentChoiceSortInput, $paginate: PaginateInput) {
              listSelfAssessmentChoices(filter: $filter, sort: $sort, paginate: $paginate) {
                total
                data { id surveyId questionPath order title description }
              }
            }
            GQL;

        $variables = [
            'sort'     => ['id' => 'ASC'],
            'paginate' => ['limit' => 500, 'offset' => 0],
        ];

        if (!empty($query['surveyId'])) {
            $variables['filter'] = ['surveyId' => ['eq' => $query['surveyId']]];
        }

        return $this->graphqlClient->graphql($gql, $variables);
    }

    private function graphqlGetById(string $id): ?object
    {
        $gql = <<<'GQL'
            query GetSelfAssessmentChoice($id: ID!) {
              getSelfAssessmentChoice(id: $id) {
                id surveyId questionPath order title description
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }
}
