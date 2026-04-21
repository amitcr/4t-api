<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * SelfAssessmentResponsesService
 *
 * Handles self-assessment response CRUD via GraphQL.
 *
 * GraphQL mutations:
 *   - createSelfAssessmentResponse
 *   - updateSelfAssessmentResponse
 *   - deleteSelfAssessmentResponse
 *
 * @since 3.0
 */
class SelfAssessmentResponsesService extends BaseHttpService
{
    protected string $endpoint = 'self-assessment-responses';

    // TODO: GraphQL equivalent — listSelfAssessmentResponses
    public function list(array $query = [])
    {
        return $this->graphqlNotImplemented('listSelfAssessmentResponses');
    }

    // TODO: GraphQL equivalent — getSelfAssessmentResponse
    public function getById($id, $query = [])
    {
        return $this->graphqlNotImplemented('getSelfAssessmentResponse');
    }

    /**
     * Creates a self-assessment response.
     *
     * Required keys in $data: participantSessionId, questionPath, mostChoiceId, leastChoiceId
     */
    public function create(array $data)
    {
        $query = 'mutation($participantSessionId: String!, $questionPath: LTree!, $mostChoiceId: String!, $leastChoiceId: String!) {
            createSelfAssessmentResponse(input: {
                participantSessionId: $participantSessionId
                questionPath: $questionPath
                mostChoiceId: $mostChoiceId
                leastChoiceId: $leastChoiceId
            }) { id }
        }';

        $variables = [
            'participantSessionId' => (string) ($data['participantSessionId'] ?? ''),
            'questionPath'         => (string) ($data['questionPath'] ?? $data['questionId'] ?? ''),
            'mostChoiceId'         => (string) ($data['mostChoiceId']         ?? ''),
            'leastChoiceId'        => (string) ($data['leastChoiceId']        ?? ''),
        ];

        return $this->graphqlClient->graphql($query, $variables);
    }

    /**
     * Updates mostChoiceId and leastChoiceId on an existing response.
     *
     * Required keys in $data: mostChoiceId, leastChoiceId
     */
    public function updateById($id, array $data)
    {
        $query = 'mutation($id: ID!, $mostChoiceId: String!, $leastChoiceId: String!) {
            updateSelfAssessmentResponse(id: $id, input: {
                mostChoiceId: $mostChoiceId
                leastChoiceId: $leastChoiceId
            }) { id }
        }';

        $variables = [
            'id'            => (string) $id,
            'mostChoiceId'  => (string) ($data['mostChoiceId']  ?? ''),
            'leastChoiceId' => (string) ($data['leastChoiceId'] ?? ''),
        ];

        return $this->graphqlClient->graphql($query, $variables);
    }

    // TODO: No GraphQL equivalent defined.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchSelfAssessmentResponse');
    }

    /**
     * Deletes a self-assessment response by ID.
     */
    public function deleteById($id)
    {
        $query     = 'mutation($id: String!) { deleteSelfAssessmentResponse(id: $id) }';
        $variables = ['id' => (string) $id];

        return $this->graphqlClient->graphql($query, $variables);
    }
}
