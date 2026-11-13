<?php
namespace App\Controllers;

use App\Core\Response;
use App\Services\RefundService;

/**
 * POST /api/v1/webhooks/stripe. No login: Stripe is the caller, and its signature is checked
 * (STRIPE_WEBHOOK_SECRET). Handles refunded and disputed assessment payments.
 */
class StripeWebhookController
{
    public function handle($request)
    {
        [$status, $body] = (new RefundService())->handleStripeWebhook((string) $request->raw, (array) $request->headers);

        Response::json($body, $status);
    }
}
