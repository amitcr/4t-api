<?php
namespace App\Console\Commands;

use App\Models\CouponModel;
use App\Models\CouponTrackingModel;
use App\Core\CommandInterface;
use App\Core\Logger;

/**
 * Recompute every coupon's cached usage_count from the source of truth:
 * tracking rows with usage_status IN (assigned, completed).
 *
 * The WordPress plugin keeps usage_count in sync on every tracking change, but
 * cross-repo deletes (e.g. assessments:delete-duplicates) and historical drift
 * can leave the cached column wrong. This command is a self-healing safety net
 * and also serves as the one-time backfill (first run corrects all drift).
 */
class ResyncCouponUsageCount implements CommandInterface
{
    public $signature = 'coupons:resync-usage-count';
    public $description = 'Recompute coupons.usage_count from assigned/completed tracking rows.';

    public function handle($arguments)
    {
        Logger::info('Cron coupons:resync-usage-count called');

        $corrected = 0;

        CouponModel::query()->orderBy('coupon_id')->chunkById(500, function ($coupons) use (&$corrected) {
            foreach ($coupons as $coupon) {
                $authoritative = CouponTrackingModel::where('coupon_id', $coupon->coupon_id)
                    ->whereIn('usage_status', ['assigned', 'completed'])
                    ->count();

                if ((int) $coupon->usage_count !== (int) $authoritative) {
                    CouponModel::where('coupon_id', $coupon->coupon_id)
                        ->update(['usage_count' => $authoritative]);
                    $corrected++;
                }
            }
        }, 'coupon_id');

        Logger::info('Cron coupons:resync-usage-count corrected ' . $corrected . ' coupon(s).');

        return true;
    }
}
