<?php
namespace App\Jobs;

use App\Core\JobInterface;
use App\Core\Logger;
use App\Services\RefundService;
use RuntimeException;

/**
 * Records a refunded assessment payment, queued by WordPress:
 *   - the PayPal Standard IPN (payment_status Refunded / Reversed): charge_id = parent_txn_id
 *   - the admin "Mark as refunded" button: assessment_id + actor_user_id
 *
 * Payload: charge_id or assessment_id; optional refund_id, amount, gateway, source, actor_user_id.
 * Safe to run twice (RefundService is idempotent).
 */
class ProcessRefundJob implements JobInterface
{
    public function handle(array $data)
    {
        $refund = [
            'refund_id'     => (string) ($data['refund_id'] ?? ''),
            'amount'        => $data['amount'] ?? null,
            'gateway'       => (string) ($data['gateway'] ?? ''),
            'source'        => in_array($data['source'] ?? '', ['wp_admin', 'system'], true) ? $data['source'] : 'system',
            'actor_user_id' => (int) ($data['actor_user_id'] ?? 0),
        ];

        $service = new RefundService();

        if (!empty($data['charge_id'])) {
            $result = $service->recordByCharge([(string) $data['charge_id']], $refund);
            if ($result === 'ignored') {
                Logger::warning('ProcessRefundJob: no assessment payment found for charge ' . $data['charge_id'] . '.');
            }
        } elseif (!empty($data['assessment_id'])) {
            $result = $service->recordByAssessment((int) $data['assessment_id'], $refund);
        } else {
            throw new RuntimeException('ProcessRefundJob needs a charge_id or an assessment_id.');
        }

        Logger::info('ProcessRefundJob done: ' . $result, $data);
    }
}
