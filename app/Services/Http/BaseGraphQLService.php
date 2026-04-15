<?php

declare(strict_types=1);

namespace App\Services\Http;

use App\Services\Crypto\WpCryptoService;
use App\Core\Logger;

/**
 * BaseGraphQLService
 *
 * Single GraphQL connection manager for the /api application.
 * All configuration is read exclusively from WP settings (wp_options table)
 * via get_settings_option() — no .env or config/graphql.php dependency.
 *
 * WP settings keys (stored under option_name = mytemp_settings):
 *   graphql_enabled              → bool   — master on/off switch
 *   graphql_endpoint_production  → string — GraphQL endpoint URL
 *   graphql_app_id               → string — encrypted X-App-Id credential
 *   graphql_api_key              → string — encrypted X-Api-Key credential
 *
 * Credentials are decrypted at runtime using WpCryptoService, which replicates
 * the AES-256-CBC algorithm used by the WP plugin's MyTemperament_Crypto class.
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

    public function __construct()
    {
        $this->url     = (string) get_settings_option('mytemp_settings.graphql_endpoint_production');
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
    public function graphql(string $query, array $variables = []): ?object
    {
        if (empty($this->url)) {
            Logger::error('BaseGraphQLService: GraphQL endpoint URL is not configured in WP settings (mytemp_settings.graphql_endpoint_production).');
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

        } catch (\Exception $e) {
            Logger::error('BaseGraphQLService: exception', ['message' => $e->getMessage()]);
            return null;
        }
    }

    // ── Private helpers ───────────────────────────────────────────────────────

    /**
     * Builds the headers array, decrypting credentials from WP settings.
     *
     * @return array<string, string>
     */
    private function buildHeaders(): array
    {
        $appId  = WpCryptoService::decrypt(
            (string) get_settings_option('mytemp_settings.graphql_app_id')
        );
        $apiKey = WpCryptoService::decrypt(
            (string) get_settings_option('mytemp_settings.graphql_api_key')
        );

        return [
            'Content-Type' => 'application/json',
            'x-app-id'     => $appId,
            'x-api-key'    => $apiKey,
        ];
    }
}
