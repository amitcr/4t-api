<?php
namespace App\Console\Commands;

use App\Models\CouponModel; 
use App\Models\AffiliateModel; 
use App\Models\CompanyModel; 
use App\Models\UserModel; 
use App\Models\CouponTrackingModel;
use App\Models\TransactionModel;
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
        Logger::info('Found Coupons ', (array) $coupons);
        if($coupons->isEmpty()){
            return false;
        }
        
        foreach($coupons as $coupon){
            $unused_charges = 0;
            $notes = '';
            $usage_counter = CouponTrackingModel::where(['coupon_id' => $coupon->coupon_id])->whereIn('usage_status', ['assigned', 'completed'])->count();
            // print_r($coupon); die;
            if($coupon->affiliate->user_id == $coupon->user_id){
                if ($coupon->mini_report == 1) {
                    $credits_charged = $coupon->mini_usage_limit * abs($coupon->mini_price);
					$credits_used = $usage_counter * abs($coupon->mini_price);
					$unused_charges = ($credits_charged - $credits_used);
                    $notes = 'Credits Reversed to your account after ' . $coupon->coupon_code . ' mini report coupon code has been expired.';
                }else if($coupon->affiliate_share < 0){
                    $credits_charged = $coupon->usage_limit * abs($coupon->affiliate_share);
                    $credits_used = $usage_counter * abs($coupon->affiliate_share);
                    // echo $credits_charged.' and '.$credits_used; die;
                    $unused_charges = $credits_charged - $credits_used;
                }
                $object_type = $coupon->reversed_credits_to == "company" ? "company" : "affiliate";
                $object_id = $coupon->reversed_credits_to == "company" ? $coupon->company_id : $coupon->affiliate_id;
                
            }else if(!empty($coupon->company->user_id == $coupon->user_id)){
                if($coupon->discount_amount > 0){
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

                $transaction = TransactionModel::create($transaction_array);                

                if($object_type == "company"){
                    CompanyModel::where('company_id', $coupon->company_id)->increment('credits', $unused_charges);
                }else{
                    AffiliateModel::where('affiliate_id', $coupon->affiliate_id)->increment('unused_credits', $unused_charges);
                }

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

                            TransactionModel::create($transaction_array);

                            AffiliateModel::where('affiliate_id', $upgradeCoupon->affiliate_id)->increment('unused_credits', $unused_charges);

                            CouponTrackingModel::where(['coupon_id' => $upgradeCoupon->coupon_id, 'usage_status' => 'pending'])->update(['usage_status' => 'expired']);
                        }
                    }
                }
            }

            $coupon->status = 'expired';
            $coupon->save();            
        }
        // Logger::info('Cron coupons:expire-status completed');
    }
}
