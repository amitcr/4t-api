<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * ParticipantsService
 *
 * GraphQL equivalents (developer guide §7):
 *   list()       → listParticipants query
 *   getById()    → getParticipant query
 *   create()     → createParticipant mutation
 *   updateById() → updateParticipant mutation
 *   patchById()  → TODO: no equivalent defined in developer guide
 *   deleteById() → TODO: no equivalent defined in developer guide
 *
 * @since 2.0
 */
class ParticipantsService extends BaseHttpService
{
    protected string $endpoint = 'participants';

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
            return $this->graphqlNotImplemented('patchParticipant');
        }

        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        if ($this->isGraphQLEnabled()) {
            return $this->graphqlNotImplemented('deleteParticipant');
        }

        return $this->delete("{$this->endpoint}/{$id}");
    }

    // ── GraphQL private methods ───────────────────────────────────────────────

    private function graphqlList(array $query): ?object
    {
        $gql = <<<'GQL'
            query ListParticipants($filter: ParticipantFilterInput, $sort: ParticipantSortInput, $paginate: PaginateInput) {
              listParticipants(filter: $filter, sort: $sort, paginate: $paginate) {
                total
                data { id applicationId applicationUid firstName lastName }
              }
            }
            GQL;

        $variables = [];

        if (!empty($query['search'])) {
            $variables['filter'] = ['search' => $query['search']];
        } elseif (!empty($query['applicationUid'])) {
            $variables['filter'] = ['applicationUid' => ['eq' => $query['applicationUid']]];
        }

        if (!empty($query['limit']) || !empty($query['offset'])) {
            $variables['paginate'] = [
                'limit'  => (int) ($query['limit']  ?? 25),
                'offset' => (int) ($query['offset'] ?? 0),
            ];
        }

        return $this->graphqlClient->graphql($gql, $variables);
    }

    private function graphqlGetById(string $id): ?object
    {
        $gql = <<<'GQL'
            query GetParticipant($id: ID!) {
              getParticipant(id: $id) {
                id applicationId applicationUid firstName lastName
              }
            }
            GQL;

        return $this->graphqlClient->graphql($gql, ['id' => $id]);
    }

    private function graphqlCreate(array $data): ?object
    {
        $gql = <<<'GQL'
            mutation CreateParticipant($input: CreateParticipantInput!) {
              createParticipant(input: $input) {
                id applicationId applicationUid firstName lastName
              }
            }
            GQL;

        $variables = [
            'input' => [
                'applicationId'  => (string) ($data['applicationId']  ?? ''),
                'applicationUid' => (string) ($data['applicationUid'] ?? ''),
                'firstName'      => (string) ($data['firstName']      ?? ''),
                'lastName'       => (string) ($data['lastName']       ?? ''),
            ],
        ];

        return $this->graphqlClient->graphql($gql, $variables);
    }

    private function graphqlUpdate(string $id, array $data): ?object
    {
        $gql = <<<'GQL'
            mutation UpdateParticipant($id: ID!, $input: UpdateParticipantInput!) {
              updateParticipant(id: $id, input: $input) {
                id applicationId applicationUid firstName lastName
              }
            }
            GQL;

        $input = [];

        if (isset($data['firstName'])) {
            $input['firstName'] = (string) $data['firstName'];
        }

        if (isset($data['lastName'])) {
            $input['lastName'] = (string) $data['lastName'];
        }

        return $this->graphqlClient->graphql($gql, ['id' => $id, 'input' => $input]);
    }
}
