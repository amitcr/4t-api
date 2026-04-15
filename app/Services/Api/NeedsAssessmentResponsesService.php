<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * NeedsAssessmentResponsesService
 *
 * GraphQL equivalents (developer guide §5.3):
 *   create()     → createNeedsAssessmentResponse mutation
 *   updateById() → updateNeedsAssessmentResponse mutation
 *   deleteById() → deleteNeedsAssessmentResponse mutation
 *   list()       → TODO: no detailed query defined in developer guide
 *   getById()    → TODO: no detailed query defined in developer guide
 *   patchById()  → TODO: no equivalent defined in developer guide
 *
 * @since 2.0
 */
class NeedsAssessmentResponsesService extends BaseHttpService
{
    protected string $endpoint = 'needs-assessment-responses';

    // TODO: GraphQL equivalent — listNeedsAssessmentResponses not documented in detail.
    public function list(array $query = [])
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('listNeedsAssessmentResponses');
        }

        return $this->get($this->endpoint, $query);
    }

    // TODO: GraphQL equivalent — getNeedsAssessmentResponse not documented in detail.
    public function getById($id, $query = [])
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('getNeedsAssessmentResponse');
        }

        return $this->get("{$this->endpoint}/{$id}", $query);
    }

    public function create(array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlCreate($data);
        }

        return $this->post($this->endpoint, $data);
    }

    public function updateById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlUpdate((string) $id, $data);
        }

        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('patchNeedsAssessmentResponse');
        }

        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    public function deleteById($id)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlDelete((string) $id);
        }

        return $this->delete("{$this->endpoint}/{$id}");
    }

    // ── GraphQL private methods ───────────────────────────────────────────────

    private function graphqlCreate(array $data): ?object
    {
        $gql = <<<'GQL'
            mutation CreateNeedsAssessmentResponse($input: CreateNeedsAssessmentResponseInput!) {
              createNeedsAssessmentResponse(input: $input) {
                id
              }
            }
            GQL;

        $input = [
            'participantSessionId' => (string) ($data['participantSessionId'] ?? ''),
            'choiceId'             => (string) ($data['choiceId']             ?? ''),
        ];

        if (isset($data['priority'])) {
            $input['priority'] = (int) $data['priority'];
        }

        return $this->graphqlClient->graphql($gql, ['input' => $input]);
    }

    private function graphqlUpdate(string $id, array $data): ?object
    {
        $gql = <<<'GQL'
            mutation UpdateNeedsAssessmentResponse($id: ID!, $input: UpdateNeedsAssessmentResponseInput!) {
              updateNeedsAssessmentResponse(id: $id, input: $input) {
                id
              }
            }
            GQL;

        $input = [];

        if (isset($data['priority'])) {
            $input['priority'] = (int) $data['priority'];
        }

        return $this->graphqlClient->graphql($gql, ['id' => $id, 'input' => $input]);
    }

    private function graphqlDelete(string $id): ?object
    {
        $gql = <<<'GQL'
            mutation DeleteNeedsAssessmentResponse($id: ID!) {
              deleteNeedsAssessmentResponse(id: $id)
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }
}
