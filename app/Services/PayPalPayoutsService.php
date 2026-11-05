<?php
namespace App\Services;

use GuzzleHttp\Client;
use RuntimeException;

/**
 * Reads PayPal Payouts results and checks webhook signatures, with the PayPal app saved in Plugin 1's
 * settings (mytemp_settings). The webhook IDs are in Plugin 2's (affcp_settings).
 *
 * Sends no money: payouts are sent from WordPress, by an admin.
 */
class PayPalPayoutsService
{
    private Client $client;
    private ?string $token = null;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client(['timeout' => 20, 'http_errors' => false]);
    }

    /**
     * Credentials and API address for the active mode.
     *
     * @return array{id:string, secret:string, url:string, mode:string}
     */
    private function config(): array
    {
        $settings = get_mytemp_settings();
        $sandbox  = (string) ($settings['paypal_express_staging_mode'] ?? '') === '1';
        $suffix   = $sandbox ? 'sandbox' : 'live';

        return [
            'id'     => trim((string) ($settings['paypal_express_client_id_' . $suffix] ?? '')),
            'secret' => trim((string) ($settings['paypal_express_client_secret_' . $suffix] ?? '')),
            'url'    => $sandbox ? 'https://api-m.sandbox.paypal.com' : 'https://api-m.paypal.com',
            'mode'   => $suffix,
        ];
    }

    public function isConfigured(): bool
    {
        $config = $this->config();

        return $config['id'] !== '' && $config['secret'] !== '';
    }

    /**
     * A batch as PayPal reports it.
     *
     * @throws RuntimeException When PayPal cannot be read.
     */
    public function getBatch(string $batchId): array
    {
        $response = $this->client->request('GET', $this->config()['url'] . '/v1/payments/payouts/' . rawurlencode($batchId), [
            'headers' => ['Authorization' => 'Bearer ' . $this->token(), 'Content-Type' => 'application/json'],
        ]);

        $body = json_decode((string) $response->getBody(), true);

        if ($response->getStatusCode() !== 200 || !is_array($body)) {
            throw new RuntimeException('PayPal answered HTTP ' . $response->getStatusCode() . ' for a batch.');
        }

        return $body;
    }

    /** The webhook ID for the active mode, from Settings > Misc in Plugin 2. */
    public function webhookId(): string
    {
        $key = 'paypal_webhook_id_' . $this->config()['mode'];

        return trim((string) get_settings_option(['affcp_settings' => [$key]]));
    }

    /**
     * Asks PayPal whether a delivery is genuine.
     *
     * The event goes back exactly as it arrived: decoding and encoding it could change the bytes
     * that were signed.
     *
     * @throws RuntimeException When PayPal cannot be reached.
     */
    public function verifyWebhook(array $headers, string $raw): bool
    {
        $fields = [
            'auth_algo'         => (string) ($headers['Paypal-Auth-Algo'] ?? ''),
            'cert_url'          => (string) ($headers['Paypal-Cert-Url'] ?? ''),
            'transmission_id'   => (string) ($headers['Paypal-Transmission-Id'] ?? ''),
            'transmission_sig'  => (string) ($headers['Paypal-Transmission-Sig'] ?? ''),
            'transmission_time' => (string) ($headers['Paypal-Transmission-Time'] ?? ''),
            'webhook_id'        => $this->webhookId(),
        ];

        $payload = rtrim((string) json_encode($fields, JSON_UNESCAPED_SLASHES), '}') . ',"webhook_event":' . $raw . '}';

        $response = $this->client->request('POST', $this->config()['url'] . '/v1/notifications/verify-webhook-signature', [
            'headers' => ['Authorization' => 'Bearer ' . $this->token(), 'Content-Type' => 'application/json'],
            'body'    => $payload,
        ]);

        if ($response->getStatusCode() >= 500) {
            throw new RuntimeException('PayPal answered HTTP ' . $response->getStatusCode() . ' to the signature check.');
        }

        $body = json_decode((string) $response->getBody(), true);

        return ($body['verification_status'] ?? '') === 'SUCCESS';
    }

    /** One token per run: the job finishes well inside its lifetime. */
    private function token(): string
    {
        if ($this->token !== null) {
            return $this->token;
        }

        $config   = $this->config();
        $response = $this->client->request('POST', $config['url'] . '/v1/oauth2/token', [
            'auth'        => [$config['id'], $config['secret']],
            'form_params' => ['grant_type' => 'client_credentials'],
        ]);

        $body = json_decode((string) $response->getBody(), true);

        if (empty($body['access_token'])) {
            throw new RuntimeException('PayPal refused the credentials (HTTP ' . $response->getStatusCode() . ').');
        }

        return $this->token = (string) $body['access_token'];
    }
}
