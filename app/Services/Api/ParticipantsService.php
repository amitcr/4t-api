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
        $gql = 'query ListParticipants($filter: ParticipantFilterInput, $sort: ParticipantSortInput, $paginate: PaginateInput) {
            listParticipants(filter: $filter, sort: $sort, paginate: $paginate) {
                total
                data { id applicationId applicationUid firstName lastName }
            }
        }';

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

    public function getById($id, $query = [])
    {
        $gql = 'query GetParticipant($id: ID!) {
            getParticipant(id: $id) {
                id applicationId applicationUid firstName lastName
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    public function create(array $data)
    {
        $gql = 'mutation CreateParticipant($input: CreateParticipantInput!) {
            createParticipant(input: $input) {
                id applicationId applicationUid firstName lastName
            }
        }';

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

    public function updateById($id, array $data)
    {
        $gql = 'mutation UpdateParticipant($id: ID!, $input: UpdateParticipantInput!) {
            updateParticipant(id: $id, input: $input) {
                id applicationId applicationUid firstName lastName
            }
        }';

        $input = [];

        if (isset($data['firstName'])) {
            $input['firstName'] = (string) $data['firstName'];
        }

        if (isset($data['lastName'])) {
            $input['lastName'] = (string) $data['lastName'];
        }

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id, 'input' => $input]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchParticipant');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteParticipant');
    }
}
