<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * AssessmentEditionsService
 *
 * GraphQL equivalents (developer guide §9):
 *   list()    → listAssessmentEditions query
 *   getById() → getAssessmentEdition query
 *
 * @since 2.0
 */
class AssessmentEditionsService extends BaseHttpService
{
    protected string $endpoint = 'assessment-editions';

    public function list(array $query = [])
    {
        $gql = 'query ListAssessmentEditions($filter: AssessmentEditionFilterInput, $paginate: PaginateInput) {
            listAssessmentEditions(filter: $filter, paginate: $paginate) {
                total
                data { id title }
            }
        }';

        return $this->graphqlClient->graphql($gql, []);
    }

    public function getById($id, $query = [])
    {
        $gql = 'query GetAssessmentEdition($id: ID!) {
            getAssessmentEdition(id: $id) {
                id title
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
        return $this->graphqlNotImplemented('createAssessmentEdition');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->graphqlNotImplemented('updateAssessmentEdition');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchAssessmentEdition');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteAssessmentEdition');
    }
}
