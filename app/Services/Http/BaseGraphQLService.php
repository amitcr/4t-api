<?php

declare(strict_types=1);

namespace App\Services\Http;

use App\Core\Config;
use App\Core\Logger;
use Exception;

/**
 * BaseGraphQLService
 *
 * Single GraphQL connection manager for the /api application.
 *
 * Configuration priority (highest → lowest):
 *   1. WP settings via get_settings_option() — graphql_enabled, graphql_endpoint_production
 *   2. .env / config/graphql.php — all values including credentials
 *
 * Credentials (graphql_app_id, graphql_api_key) are stored encrypted in WP settings
 * and cannot be decrypted in this application without the WP crypto context.
 * They are read exclusively from .env via config/graphql.php.
 * TODO: read credentials from WP settings once a shared decryption mechanism is available.
 *
 * Usage:
 *   $client = new BaseGraphQLService();
 *   $data   = $client->graphql('query { ... }', ['var' => 'value']);
 *
 * @since 2.0
 */
class BaseGraphQLService
{
    private string $url;

    /** @var array<string, string> */
    private array $headers;

    public function __construct()
    {
        // URL: WP setting takes priority, .env/config is the fallback.
        $wpUrl      = get_settings_option('mytemp_settings.graphql_endpoint_production');
        $this->url  = (!empty($wpUrl)) ? (string) $wpUrl : (string) Config::get('graphql.url');

        // TODO: read app_id and api_key from WP settings once decryption of
        //       mytemp_settings.graphql_app_id / graphql_api_key is available here.
        $this->headers = (array) Config::get('graphql.headers');
    }

    /**
     * Returns true when GraphQL is enabled.
     *
     * Checks the WP setting first; falls back to config/graphql.php (GRAPHQL_ENABLED env var).
     */
    public static function isEnabled(): bool
    {
        $wpSetting = get_settings_option('mytemp_settings.graphql_enabled');

        if ($wpSetting !== null) {
            return (bool) $wpSetting;
        }

        return Config::get('graphql.enabled') === true;
    }

    /**
     * Sends a GraphQL query or mutation to the configured endpoint.
     *
     * @param  string               $query     Full GraphQL query/mutation string.
     * @param  array<string, mixed> $variables Variables map passed alongside the operation.
     * @return object|null                     Decoded `data` object, or null on any failure.
     */
    public function graphql(string $query, array $variables = []): ?object
    {
        if (empty($this->url)) {
            Logger::error('BaseGraphQLService: GraphQL URL is not configured.');
            return null;
        }

        $payload = json_encode([
            'query'     => $query,
            'variables' => empty($variables) ? (object) [] : $variables,
        ]);

        if ($payload === false) {
            Logger::error('BaseGraphQLService: Failed to JSON-encode GraphQL payload.');
            return null;
        }

        $headerLines = array_map(
            fn(string $k, string $v): string => "{$k}: {$v}",
            array_keys($this->headers),
            array_values($this->headers)
        );

        try {
            $ch = curl_init($this->url);

            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $payload,
                CURLOPT_HTTPHEADER     => $headerLines,
                CURLOPT_TIMEOUT        => 30,
            ]);

            $body  = curl_exec($ch);
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            curl_close($ch);

            if ($errno !== 0) {
                Logger::error('BaseGraphQLService: cURL transport error', [
                    'errno' => $errno,
                    'error' => $error,
                    'url'   => $this->url,
                ]);
                return null;
            }

            $decoded = json_decode((string) $body);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Logger::error('BaseGraphQLService: JSON decode failed', ['body' => $body]);
                return null;
            }

            if (isset($decoded->errors) && is_array($decoded->errors)) {
                Logger::error('BaseGraphQLService: GraphQL errors', [
                    'errors' => array_map(fn($e) => $e->message ?? '', $decoded->errors),
                    'query'  => $query,
                ]);
                return null;
            }

            return $decoded->data ?? null;

        } catch (Exception $e) {
            Logger::error('BaseGraphQLService: exception', ['message' => $e->getMessage()]);
            return null;
        }
    }
}
