<?php
namespace App\Services\Http;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use App\Core\Config;
use App\Core\Logger;
use Exception;

class BaseHttpService
{
    protected $http;

    public function __construct(?Factory $factory = null)
    {
        $factory = $factory ?? new Factory();

        $baseUrl = rtrim(Config::get('scoring.base_url'), '/');
        $timeout = (int) Config::get('scoring.timeout');
        $retries = (int) Config::get('scoring.retries');
        $delayMs = (int) Config::get('scoring.retry_delay_ms');

        $request = $factory
            ->baseUrl($baseUrl)
            ->timeout($timeout)
            ->retry($retries, $delayMs)
            ->acceptJson()
            ->asJson()
            ->withHeaders(Config::get('scoring.headers'));

        if (!empty($_ENV['API_TOKEN'])) {
            $request = $request->withToken($_ENV['API_TOKEN']);
        }

        $this->http = $request;
    }

    protected function withHeaders(array $headers)
    {
        return $this->http->withHeaders($headers);
    }

    private function handleRequest(callable $callback, string $method, string $uri, array $options = [])
    {
        try {
            // 🔍 Log request details before sending
            Logger::info("API $method request", [
                'uri'     => $uri,
                'options' => $options,
            ]);
            
            /** @var Response $response */
            $response = $callback();
            
            if ($response->successful()) {
                return $response->object();
            }

            // API returned 4xx/5xx
            Logger::error("API $method request failed", [
                'uri'    => $uri,
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return [
                'error'   => true,
                'status'  => $response->status(),
                'message' => $response->json('message') ?? $response->body(),
                'body'    => $response->json(),
            ];

        } catch (RequestException $e) {
            $response = $e->response;
            // die;
            if ($response) {
                $body = $response->body(); // raw JSON string
                $status = $response->status();

                // Try decoding safely
                $data = json_decode($body, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    // fallback if JSON is invalid
                    $data = ['error' => true, 'status' => $status, 'message' => $body];
                }

                Logger::error("API $method request exception", [
                    'uri'   => $uri,
                    'error' => $data,
                ]);

                return [
                    'error' => true,
                    'status' => $status,
                    'body' => $data,
                ];
            }

            // If no response attached
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'body' => null,
            ];
        } catch (Exception $e) {
            Logger::error("API $method unexpected exception", [
                'uri'   => $uri,
                'error' => $e->getMessage(),
                'data'  => isset($options['data']) ? $options['data'] : null,
            ]);

            return [
                'error'   => true,
                'status'  => 500,
                'message' => $e->getMessage(),
            ];
        }
    }

    protected function get(string $uri, array $query = [], array $headers = [])
    {
        $req = $headers ? $this->withHeaders($headers) : $this->http;
        return $this->handleRequest(fn() => $req->get($uri, $query), 'GET', $uri, ['headers' => $headers, 'query' => $query]);
    }
    
    protected function getQueryUrl(string $uri, array $headers = [])
    {
        $req = $headers ? $this->withHeaders($headers) : $this->http;
        return $this->handleRequest(fn() => $req->get($uri), 'GET', $uri, ['headers' => $headers]);
    }

    protected function post(string $uri, array $data = [], array $headers = [])
    {
        $req = $headers ? $this->withHeaders($headers) : $this->http;
        return $this->handleRequest(fn() => $req->post($uri, $data), 'POST', $uri, ['headers' => $headers, 'data' => $data]);
    }

    protected function put(string $uri, array $data = [], array $headers = [])
    {
        $req = $headers ? $this->withHeaders($headers) : $this->http;
        return $this->handleRequest(fn() => $req->put($uri, $data), 'PUT', $uri, ['headers' => $headers, 'data' => $data]);
    }

    protected function patch(string $uri, array $data = [], array $headers = [])
    {
        $req = $headers ? $this->withHeaders($headers) : $this->http;
        return $this->handleRequest(fn() => $req->patch($uri, $data), 'PATCH', $uri, ['headers' => $headers, 'data' => $data]);
    }

    protected function delete(string $uri, array $headers = [])
    {
        $req = $headers ? $this->withHeaders($headers) : $this->http;
        return $this->handleRequest(fn() => $req->delete($uri), 'DELETE', $uri, ['headers' => $data, 'query' => $data]);
    }

    protected function graphql(string $endpoint, string $query, array $variables = [], array $headers = [])
    {
        $payload = ['query' => $query, 'variables' => $variables];
        $req = $headers ? $this->withHeaders($headers) : $this->http;
        return $this->handleRequest(fn() => $req->post($endpoint, $payload), 'GRAPHQL', $endpoint, ['headers' => $headers, 'query' => $query]);
    }
}
