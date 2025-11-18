<?php
namespace App\Controllers;

use App\Services\Http\GraphQLService;
use App\Core\Response;

class GraphQLController
{
    protected $graphql;

    public function __construct()
    {
        $this->graphql = new GraphQLService();
    }

    public function handle($request = null)
    {
        // Determine HTTP method safely
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        // Parse request data safely (whether $request is null or not)
        $body = method_exists($request, 'all') ? $request->all() : json_decode(file_get_contents('php://input'), true);
        $body = is_array($body) ? $body : [];

        $resource = $body['resource'] ?? null;
        $id       = $body['id'] ?? null;

        switch ($method) {
            case 'GET':
                $query = $this->graphql->buildQuery($resource, $id, $body);
                break;

            case 'POST':
                $query = $this->graphql->buildMutation('create', $resource, $body);
                break;

            case 'PUT':
                $query = $this->graphql->buildMutation('update', $resource, $body, $id);
                break;

            case 'DELETE':
                $query = $this->graphql->buildMutation('delete', $resource, [], $id);
                break;

            default:
                return Response::json(['error' => 'Invalid request method'], 400);
        }

        $response = $this->graphql->send($query);
        return Response::json($response);
    }
}
