<?php
namespace App\Core;

class Request
{
    public $method;
    public $headers;
    public $query;
    public $body;
    public $raw;

    /** @var array|object|null Decoded JWT payload, attached by JwtMiddleware (read as an array). */
    public $tokendata = null;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->headers = $this->parseHeaders();
        $this->query = $_GET ?? [];
        $this->raw = file_get_contents('php://input');
        $this->body = $this->parseBody();
    }

    private function parseHeaders()
    {
        $headers = [];

        foreach ($_SERVER as $k => $v) {
            if (strpos($k, 'HTTP_') === 0) {
                $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($k, 5)))));
                $headers[$name] = $v;
            }
        }

        // Add content type if available
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $headers['Content-Type'] = $_SERVER['CONTENT_TYPE'];
        }

        // Manually handle Authorization (sometimes not passed to PHP by default)
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers['Authorization'] = $_SERVER['HTTP_AUTHORIZATION'];
        } elseif (function_exists('apache_request_headers')) {
            $apacheHeaders = apache_request_headers();
            if (isset($apacheHeaders['Authorization'])) {
                $headers['Authorization'] = $apacheHeaders['Authorization'];
            }
        }

        return $headers;
    }

    private function parseBody()
    {
        $ct = $this->headers['Content-Type'] ?? '';
        if (stripos($ct, 'application/json') !== false) {
            $d = json_decode($this->raw, true);
            return $d === null ? [] : $d;
        }
        return $_POST ?? [];
    }

    public function input($key, $default = null)
    {
        if (isset($this->body[$key])) return $this->body[$key];
        if (isset($this->query[$key])) return $this->query[$key];
        return $default;
    }

    public function bearerToken()
    {
        $auth = $this->headers['Authorization'] ?? '';
        if (preg_match('/Bearer\s+(\S+)/i', $auth, $m)) return $m[1];
        return null;
    }

    public function all() {
        return $this->body;
    }

    public function get($key, $default = null) {
        return $this->body[$key] ?? $this->query[$key] ?? $default;
    }

    public function only(array $keys) {
        return array_intersect_key($this->body, array_flip($keys));
    }

    public function has($key) {
        return isset($this->body[$key]) || isset($this->query[$key]);
    }
}
