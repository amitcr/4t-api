<?php
namespace App\Console\Commands;

use App\Models\CouponModel; 
use App\Models\AffiliateModel; 
use App\Models\CompanyModel; 
use App\Models\UserModel; 
use App\Models\CouponTrackingModel;
use App\Services\CreditLedgerService;
use App\Core\CommandInterface;
use App\Core\Logger;
use Carbon\Carbon;

class ValidateCoupons implements CommandInterface
{
    public $signature = 'coupons:expire-status';
    public $description = 'Manage Prepaid & Mini Code Status.';

    public function handle($arguments)
    {
        Logger::info('Cron coupons:expire-status called');
        $yesterday = Carbon::yesterday()->toDateString();
        $coupons = CouponModel::with(['affiliate', 'company'])->where(['end_date' => $yesterday, 'status' => 'active'])->orderBy('created_datetime', 'asc')->get();
        // Logger::info('Found Coupons ', (array) $coupons);
        if($coupons->isEmpty()){
            return false;
        }
        
        foreach($coupons as $coupon){
            $unused_charges = 0;
            $notes = '';
            $settleUsageLimit = false;
            $settleMiniLimit = false;
            $usage_counter = CouponTrackingModel::where(['coupon_id' => $coupon->coupon_id])->whereIn('usage_status', ['assigned', 'completed'])->count();
            $parent_usage_counter = $usage_counter; // preserved: $usage_counter is reused inside the upgrade-codes loop below
            // print_r($coupon); die;
            if($coupon->affiliate->user_id == $coupon->user_id){
                if ($coupon->mini_report == 1) {
                    $settleMiniLimit = true;
                    $credits_charged = $coupon->mini_usage_limit * abs($coupon->mini_price);
					$credits_used = $usage_counter * abs($coupon->mini_price);
					$unused_charges = ($credits_charged - $credits_used);
                    $notes = 'Credits Reversed to your account after ' . $coupon->coupon_code . ' mini report coupon code has been expired.';
                }else if($coupon->affiliate_share < 0){
                    $settleUsageLimit = true;
                    $credits_charged = $coupon->usage_limit * abs($coupon->affiliate_share);
                    $credits_used = $usage_counter * abs($coupon->affiliate_share);
                    // echo $credits_charged.' and '.$credits_used; die;
                    $unused_charges = $credits_charged - $credits_used;
                }
                $object_type = $coupon->reversed_credits_to == "company" ? "company" : "affiliate";
                $object_id = $coupon->reversed_credits_to == "company" ? $coupon->company_id : $coupon->affiliate_id;
                
            }else if(!empty($coupon->company->user_id == $coupon->user_id)){
                if($coupon->discount_amount > 0){
                    $settleUsageLimit = true;
                    $credits_charged = $coupon->usage_limit * abs($coupon->discount_amount);
                    $credits_used = $usage_counter * abs($coupon->discount_amount);
                    $unused_charges = $credits_charged - $credits_used;
                }
                $object_type = 'company';
                $object_id = $coupon->company_id;
            }

            
            if($unused_charges != 0){
                $notes = !empty($notes) ? $notes : 'Credits Reversed to your account after '.$coupon->coupon_code.' coupon code has been expired.';
                $transaction_array = [
                    'amount'    =>  $unused_charges,
                    'transaction_type'  =>  'reversal',
                    'transaction_object_type'   =>  $object_type,
                    'object_id' =>  $object_id,
                    'notes' =>  $notes,
                    'status'    =>  'success',
                    'created_datetime' => Carbon::now()
                ];

                // Credit ledger (wp-affiliates-coupons 1.1.2): balance + history row in one transaction,
                // keyed on the coupon so a re-run can never reverse the same code twice.
                self::postReversal(
                    $object_type,
                    (int) ($object_type == "company" ? $coupon->company_id : $coupon->affiliate_id),
                    $unused_charges,
                    $coupon->coupon_id,
                    $transaction_array['notes']
                );

                CouponTrackingModel::where(['coupon_id' => $coupon->coupon_id, 'usage_status' => 'pending'])->update(['usage_status' => 'expired']);
            }

            if($coupon->mini_report == 1) {
                $upgradeCodes = CouponModel::where(['parent_code_id' => $coupon->coupon_id, 'coupon_type' => 'prepaid_coupon_code'])->get();
                if($upgradeCodes->isNotEmpty()){
                    foreach($upgradeCodes as $upgradeCoupon){
                        $unused_charges = 0;
                        $notes = '';
                        $usage_counter = CouponTrackingModel::where(['coupon_id' => $upgradeCoupon->coupon_id])->whereIn('usage_status', ['assigned', 'completed'])->count();
                        if($upgradeCoupon->affiliate_share < 0 ){
                            $credits_charged = $upgradeCoupon->usage_limit * abs($upgradeCoupon->affiliate_share);
                            $credits_used = $usage_counter * abs($upgradeCoupon->affiliate_share);
                            $unused_charges = $credits_charged - $credits_used;
                            $transaction_array = [
                                'amount'    =>  $unused_charges,
                                'transaction_type'  =>  'reversal',
                                'transaction_object_type'   =>  'affiliate',
                                'object_id' =>  $upgradeCoupon->affiliate_id,
                                'notes' =>  'Credits Reversed to your account after '.$upgradeCoupon->coupon_code.' upgrade coupon code has been expired, added under '.$coupon->coupon_code.' Mini Report Code.',
                                'status'    =>  'success',
                                'created_datetime' => Carbon::now()
                            ];

                            self::postReversal('affiliate', (int) $upgradeCoupon->affiliate_id, $unused_charges, $upgradeCoupon->coupon_id, $transaction_array['notes']);

                            CouponTrackingModel::where(['coupon_id' => $upgradeCoupon->coupon_id, 'usage_status' => 'pending'])->update(['usage_status' => 'expired']);

                            // Settle this upgrade code's limit to its used count and expire it,
                            // so its refunded portion is removed and it is not picked up by the
                            // auto-recharge cron (which only selects status='active').
                            if ($upgradeCoupon->usage_limit > $usage_counter) {
                                $upgradeCoupon->usage_limit = $usage_counter;
                            }
                            $upgradeCoupon->status = 'expired';
                            $upgradeCoupon->save();
                        }
                    }
                }
            }

            // Settle the credit-charged limit down to what was actually used, so the
            // refunded (reversed) unused portion is removed and the affiliate/company
            // sees the real consumed limit when editing the code later. Reduce-only.
            if ($settleMiniLimit && $coupon->mini_usage_limit > $parent_usage_counter) {
                $coupon->mini_usage_limit = $parent_usage_counter;
            }
            if ($settleUsageLimit && $coupon->usage_limit > $parent_usage_counter) {
                $coupon->usage_limit = $parent_usage_counter;
            }

            $coupon->status = 'expired';
            $coupon->save();
        }
        // Logger::info('Cron coupons:expire-status completed');
    }
    /**
     * Posts an expiry reversal to the credit ledger (code credits; signed, as before).
     * A failure is logged and does not stop the rest of the expiry run.
     */
    private static function postReversal(string $accountType, int $accountId, $amount, $couponId, string $notes): void
    {
        // Nothing to give back (e.g. an upgrade code that was fully used): no entry, as there is no change.
        if (!is_numeric($amount) || round((float) $amount, 2) == 0.0) {
            return;
        }

        try {
            CreditLedgerService::post($accountType, $accountId, [
                'bucket'          => 'code_credits',
                'entry_type'      => 'reversal',
                'amount'          => $amount,
                'reference_type'  => 'coupon',
                'reference_id'    => $couponId,
                'idempotency_key' => 'reversal_coupon_' . $couponId,
                'public_note'     => $notes,
            ]);
        } catch (\Throwable $e) {
            Logger::error("coupons:expire-status: reversal of {$amount} to {$accountType} #{$accountId} for coupon #{$couponId} failed: " . $e->getMessage());
        }
    }
}
