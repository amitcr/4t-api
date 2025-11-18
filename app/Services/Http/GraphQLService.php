<?php
namespace App\Services\Http;

use App\Services\Http\BaseHttpService;

class GraphQLService extends BaseHttpService
{
    public function buildQuery($resource, $id = null, $params = [])
    {
        $fields = isset($params['fields']) ? implode(' ', $params['fields']) : 'id name';
        $filter = $id ? "(id: \"$id\")" : '';

        return [
            'query' => "query { $resource $filter { $fields } }"
        ];
    }

    public function buildMutation($action, $resource, $data = [], $id = null)
    {
        $input = $this->formatInput($data);

        switch ($action) {
            case 'create':
                $mutation = "mutation { create$resource(input: $input) { id } }";
                break;
            case 'update':
                $mutation = "mutation { update$resource(id: \"$id\", input: $input) { id } }";
                break;
            case 'delete':
                $mutation = "mutation { delete$resource(id: \"$id\") { id } }";
                break;
            default:
                $mutation = '';
        }

        return ['query' => $mutation];
    }

    protected function formatInput(array $data): string
    {
        $pairs = [];
        foreach ($data as $key => $value) {
            if (is_numeric($value)) {
                $pairs[] = "$key: $value";
            } else {
                $pairs[] = "$key: \"$value\"";
            }
        }
        return '{ ' . implode(', ', $pairs) . ' }';
    }

    public function send(array $payload)
    {
        // Call the inherited protected GraphQL request method
        return $this->graphql('/graphql', $payload['query']);
    }
}
