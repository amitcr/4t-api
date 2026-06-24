<?php
namespace App\Console\Commands;

use App\Models\CouponModel;
use App\Core\CommandInterface;
use App\Core\Config;
use App\Core\Logger;
use App\Core\Mail\Mail;
use Carbon\Carbon;

/**
 * Notify affiliate/company users when a mini-report code is running low on its
 * mini-report usage (mini_usage_limit - mini_usage_views <= 3). Email only —
 * mini codes are NOT auto-recharged (auto-recharge only ever tops up usage_limit).
 *
 * Replaces the mini path of the removed WP cron crons/codes-usage-actions.php.
 * Per-day dedup is stored in the coupon `details.notifications` JSON array,
 * matching the shape WordPress reads/writes so other details keys are preserved.
 */
class MiniUsageReminder implements CommandInterface
{
    public $signature = 'emails:mini-usage-reminder';
    public $description = 'Notify users when a mini-report code is running low on mini usage.';

    public function handle($arguments)
    {
        Logger::info('Cron emails:mini-usage-reminder called');

        $coupons = CouponModel::with(['user', 'affiliate', 'company'])
            ->where(['status' => 'active', 'is_locked' => 0, 'mini_report' => 1])
            ->whereRaw('mini_usage_limit >= 1 AND (mini_usage_limit - mini_usage_views) <= 3')
            ->get();

        if ($coupons->isEmpty()) {
            return false;
        }

        $today = Carbon::now()->toDateString();

        foreach ($coupons as $coupon) {
            if (empty($coupon->user) || empty($coupon->user->user_email)) {
                continue;
            }

            $details = json_decode($coupon->details ?: '{}');
            if (!is_object($details)) {
                $details = new \stdClass();
            }
            $notifications = (!empty($details->notifications)) ? (array) $details->notifications : [];

            // Skip if a mini-usage (or auto-recharge) notification was already recorded today.
            $alreadySentToday = false;
            foreach ($notifications as $notification) {
                if (
                    isset($notification->type, $notification->created_at) &&
                    in_array($notification->type, ['mini_usage_expiration', 'code_auto_recharged']) &&
                    date('Y-m-d', strtotime($notification->created_at)) === $today
                ) {
                    $alreadySentToday = true;
                    break;
                }
            }
            if ($alreadySentToday) {
                continue;
            }

            $to = in_array(Config::get('app.env'), ['local', 'staging'])
                ? Config::get('app.email')
                : $coupon->user->user_email;

            Mail::send(
                $to,
                'Your Mini Report Usage at FourTemperaments Is Running Low',
                'mini-usage-reminder',
                ['coupon' => $coupon]
            );

            // Record the notification (matches WP shape) so we don't resend today.
            $notifications[] = ['type' => 'mini_usage_expiration', 'created_at' => Carbon::now()->toDateTimeString()];
            $details->notifications = array_values($notifications);
            CouponModel::where('coupon_id', $coupon->coupon_id)->update(['details' => json_encode($details)]);

            Logger::info('Cron emails:mini-usage-reminder sent for coupon ' . $coupon->coupon_id);
        }

        Logger::info('Cron emails:mini-usage-reminder completed');
        return true;
    }
}
