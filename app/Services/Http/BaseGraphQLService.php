<?php

declare(strict_types=1);

namespace App\Services\Http;

use App\Core\Config;
use App\Core\Logger;

/**
 * BaseGraphQLService
 *
 * Single GraphQL connection manager for the /api application.
 *
 * WP settings keys (stored under option_name = mytemp_settings):
 *   graphql_enabled              → bool   — master on/off switch
 *   staging_mode                 → bool   — when true, use staging endpoint
 *   graphql_endpoint_production  → string — production GraphQL endpoint URL
 *   graphql_endpoint_staging     → string — staging GraphQL endpoint URL
 *
 * Credentials are read from .env via config/graphql.php:
 *   GRAPHQL_PROD_APP_ID / GRAPHQL_PROD_API_KEY
 *   GRAPHQL_STAGING_APP_ID / GRAPHQL_STAGING_API_KEY
 *
 * Usage:
 *   if (BaseGraphQLService::isEnabled()) {
 *       $client = new BaseGraphQLService();
 *       $data   = $client->graphql('mutation { ... }', ['var' => 'value']);
 *   }
 *
 * @since 2.0
 */
class BaseGraphQLService
{
    private string $url;

    /** @var array<string, string> */
    private array $headers;

    /** Human-readable message from the last failed graphql() call. Null on success. */
    private ?string $lastError = null;

    public function __construct()
    {
        $this->url     = $this->resolveEndpointUrl();
        $this->headers = $this->buildHeaders();
    }

    /**
     * Returns true when GraphQL is enabled in WP settings.
     */
    public static function isEnabled(): bool
    {
        return (bool) get_settings_option('mytemp_settings.graphql_enabled');
    }

    /**
     * Sends a GraphQL query or mutation to the configured endpoint.
     *
     * @param  string               $query     Full GraphQL query/mutation string.
     * @param  array<string, mixed> $variables Variables map passed alongside the operation.
     * @return object|null                     Decoded `data` object, or null on any failure.
     */
    /**
     * Returns the human-readable error message from the last failed graphql() call,
     * or null if the last call succeeded.
     */
    public function getLastError(): ?string
    {
        return $this->lastError;
    }

    public function graphql(string $query, array $variables = []): ?object
    {
        $this->lastError = null;

        if (empty($this->url)) {
            $envKey = (bool) get_settings_option('mytemp_settings.staging_mode')
                ? 'graphql_endpoint_staging'
                : 'graphql_endpoint_production';
            Logger::error("BaseGraphQLService: GraphQL endpoint URL is not configured in WP settings (mytemp_settings.{$envKey}).");
            $this->lastError = 'The scoring service is not configured. Please contact support.';
            return null;
        }

        $payload = json_encode([
            'query'     => $query,
            'variables' => empty($variables) ? (object) [] : $variables,
        ]);

        if ($payload === false) {
            Logger::error('BaseGraphQLService: Failed to JSON-encode GraphQL payload.');
            $this->lastError = 'Unable to process your request. Please try again.';
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
                $this->lastError = 'Unable to reach the scoring service. Please try again.';
                return null;
            }

            $decoded = json_decode((string) $body);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Logger::error('BaseGraphQLService: JSON decode failed', ['body' => $body]);
                $this->lastError = 'Received an invalid response from the scoring service. Please try again.';
                return null;
            }

            if (isset($decoded->errors) && is_array($decoded->errors)) {
                // Use the first GraphQL error message — these are human-readable by design.
                $firstMessage = $decoded->errors[0]->message ?? null;
                Logger::error('BaseGraphQLService: GraphQL errors', [
                    'errors' => array_map(fn($e) => $e->message ?? '', $decoded->errors),
                    'query'  => $query,
                ]);
                $this->lastError = $firstMessage ?? 'Your response could not be saved. Please try again.';
                return null;
            }

            return $decoded->data ?? null;

        } catch (\Exception $e) {
            Logger::error('BaseGraphQLService: exception', ['message' => $e->getMessage()]);
            $this->lastError = 'An unexpected error occurred. Please try again.';
            return null;
        }
    }

    // ── Private helpers ───────────────────────────────────────────────────────

    /**
     * Resolves the active GraphQL endpoint URL.
     * Uses staging URL when staging_mode is enabled in WP settings,
     * otherwise falls back to the production URL.
     */
    private function resolveEndpointUrl(): string
    {
        $isStaging = (bool) get_settings_option('mytemp_settings.staging_mode');

        if ($isStaging) {
            return (string) get_settings_option('mytemp_settings.graphql_endpoint_staging');
        }

        return (string) get_settings_option('mytemp_settings.graphql_endpoint_production');
    }

    /**
     * Builds the headers array, decrypting credentials from WP settings.
     *
     * @return array<string, string>
     */
    private function buildHeaders(): array
    {
        $isStaging = (bool) get_settings_option('mytemp_settings.staging_mode');

        $appId  = $isStaging
            ? (string) Config::get('graphql.staging_app_id')
            : (string) Config::get('graphql.prod_app_id');

        $apiKey = $isStaging
            ? (string) Config::get('graphql.staging_api_key')
            : (string) Config::get('graphql.prod_api_key');

        return [
            'Content-Type' => 'application/json',
            'x-app-id'     => $appId,
            'x-api-key'    => $apiKey,
        ];
    }
}
