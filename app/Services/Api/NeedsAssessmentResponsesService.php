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
        return $this->graphqlNotImplemented('listNeedsAssessmentResponses');
    }

    // TODO: GraphQL equivalent — getNeedsAssessmentResponse not documented in detail.
    public function getById($id, $query = [])
    {
        return $this->graphqlNotImplemented('getNeedsAssessmentResponse');
    }

    public function create(array $data)
    {
        $gql = 'mutation CreateNeedsAssessmentResponse($input: CreateNeedsAssessmentResponseInput!) {
            createNeedsAssessmentResponse(input: $input) {
                id
            }
        }';

        $input = [
            'participantSessionId' => (string) ($data['participantSessionId'] ?? ''),
            'choiceId'             => (string) ($data['choiceId']             ?? ''),
        ];

        if (isset($data['priority'])) {
            $input['priority'] = (int) $data['priority'];
        }

        return $this->graphqlClient->graphql($gql, ['input' => $input]);
    }

    public function updateById($id, array $data)
    {
        $gql = 'mutation UpdateNeedsAssessmentResponse($id: ID!, $input: UpdateNeedsAssessmentResponseInput!) {
            updateNeedsAssessmentResponse(id: $id, input: $input) {
                id
            }
        }';

        $input = [];

        if (isset($data['priority'])) {
            $input['priority'] = (int) $data['priority'];
        }

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id, 'input' => $input]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchNeedsAssessmentResponse');
    }

    public function deleteById($id)
    {
        $gql = 'mutation DeleteNeedsAssessmentResponse($id: ID!) {
            deleteNeedsAssessmentResponse(id: $id)
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }
}
