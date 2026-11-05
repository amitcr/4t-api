<?php
namespace App\Controllers;

use App\Core\Response;
use App\Services\PayoutResultService;

/**
 * POST /api/v1/webhooks/paypal. No login: PayPal is the caller, and its signature is checked.
 */
class PayPalWebhookController
{
    public function handle($request)
    {
        [$status, $body] = (new PayoutResultService())->handleWebhook((string) $request->raw, (array) $request->headers);

        Response::json($body, $status);
    }
}
