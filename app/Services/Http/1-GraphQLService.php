<?php
namespace App\Services\Http;

use App\Core\Config;
class GraphQLService extends BaseHttpService
{
    public function send($query)
    {
        $endpoint = rtrim(Config::get('scoring.graphql_url'), '/');
        $response = $this->post($endpoint, [
            'query' => $query['query'],
            'variables' => $query['variables'] ?? new \stdClass()
        ]);

        return $response;
    }

    // 🔹 Build a GraphQL "query"
    public function buildQuery($resource, $id = null, $params = [])
    {
        $fields = isset($params['fields']) ? implode(' ', $params['fields']) : 'id name';
        $filter = $id ? "(id: \"$id\")" : '';

        return [
            'query' => "
                query {
                    {$resource}{$filter} {
                        $fields
                    }
                }
            "
        ];
    }

    // 🔹 Build a GraphQL "mutation"
    public function buildMutation($action, $resource, $data = [], $id = null)
    {
        $inputFields = $this->formatInput($data);
        $mutationName = "{$action}" . ucfirst($resource);

        if ($action === 'update' || $action === 'delete') {
            $args = "(id: \"$id\" input: {$inputFields})";
        } else {
            $args = "(input: {$inputFields})";
        }

        return [
            'query' => "
                mutation {
                    $mutationName$args {
                        id
                        message
                        success
                    }
                }
            "
        ];
    }

    private function formatInput($data)
    {
        if (empty($data)) {
            return '{}';
        }

        $fields = [];
        foreach ($data as $key => $value) {
            $escapedValue = addslashes($value);
            $fields[] = "$key: \"$escapedValue\"";
        }
        return '{' . implode(', ', $fields) . '}';
    }
}
