<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;

use App\Models\CouponModel;  
use App\Models\CouponDetailModel;
use App\Models\PaymentMethodModel;
use App\Models\TransactionModel;
use App\Models\UserMetaModel;
use App\Models\CompanyModel;
use App\Models\AffiliateModel;
use App\Core\Logger;
use App\Core\Mail\Mail;
use Carbon\Carbon;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;

class CouponAutoRecharge implements CommandInterface
{
    public $signature = 'coupons:coupon-auto-recharge';
    public $description = 'Notify Affiliate about code auto recharge event, before code usage limit expires.';

    public function handle($arguments)
    {
        
        $stripe_secret_key = get_settings_option('mytemp_settings.stripe_secret_key');
        Stripe::setApiKey($stripe_secret_key);

        // $stripe_publication_key = get_settings_option('mytemp_settings.stripe_publication_key');
        
        // Logger::info('Cron coupons:coupon-auto-recharge called');
        $coupons = CouponModel::with(['user', 'affiliate', 'company', 'coupondetail'])->where(['status' => 'active', 'is_locked' => 0, 'coupon_type' => 'prepaid_coupon_code'])
            ->where(function ($q) {
                $q->whereRaw('((usage_count / usage_limit) * 100) >= 80')
                ->orWhereRaw('(usage_limit < 5 and (usage_limit - usage_count) <= 1)');
            })->whereHas('coupondetail', function ($q) {
                $q->where('auto_recharge', 1);
            })->get();

        if($coupons->isEmpty()){
            return false;
        }
        
        foreach($coupons as $coupon){
            if($coupon->affiliate_share >= 0)
                continue;

            // if(empty($coupon->coupondetail) || ($coupon->coupondetail->auto_recharge != 1))
            //     continue;
            
            $couponPaymentMethod = PaymentMethodModel::find($coupon->coupondetail->payment_method_id);
            if(!$couponPaymentMethod)
                continue;

            if($couponPaymentMethod->customer_id){
                $customer_stripe_id = $couponPaymentMethod->customer_id;
            }else{
                $customer_stripe_id = UserMetaModel::where(['user_id' => $coupon->user_id, 'meta_key' => '_stripe_customer_id'])->value('meta_value');
            }
            
            if(empty($customer_stripe_id))
                continue;

            $paymentMethod = PaymentMethod::retrieve($couponPaymentMethod->payment_method);
            $amount = $coupon->coupondetail->auto_recharge_limit * abs($coupon->affiliate_share);
            try{
                $paymentIntent = PaymentIntent::create([
                    'amount'    =>  $amount,
                    'customer'  =>  $customer_stripe_id,
                    'currency'  =>  'usd',
                    'automatic_payment_methods' =>  [
                        'enabled'   =>  true
                    ],
                    'description'   =>  (!empty($coupon->company) && $coupon->company->user_id == $coupon->user_id) ? "Auto Payment for Credits added to company account." : "Auto Payment for Credits added to affiliate account.",
                    'payment_method'    =>  $couponPaymentMethod->payment_method,
                    'off_session'   =>  true,
                    'confirm'   =>  true
                ]);

                if($paymentIntent->id && $paymentIntent->status == "succeeded"){
                    $transaction_array = [
                        'amount'    =>  $amount,
                        'transaction_type'  =>  'credit',
                        'transaction_object_type'   =>  (!empty($coupon->company) && $coupon->company->user_id == $coupon->user_id) ? "company" : "affiliate",
                        'object_id' =>  (!empty($coupon->company) && $coupon->company->user_id == $coupon->user_id) ? $coupon->company_id : $coupon->affiliate_id,
                        'notes' =>  "Auto Credits added to for auto recharge of ".$coupon->coupon_code,
                        'status'    =>  'success',
                        'created_datetime' => Carbon::now()
                    ];

                    $transaction = TransactionModel::create($transaction_array);

                    if($transaction){                        
                        // use $coupon->user->user_email
                        Mail::send($coupon->user->user_email, 'Successful Auto Recharge Confirmation & Invoice', 'auto-recharge-invoice', ['coupon' => $coupon, 'transaction' => $transaction, 'paymentMethod' => $paymentMethod, 'paymentIntent' => $paymentIntent]);

                        // TODO: Add Charge Transaction for Credits
                        $transaction_array = [
                            'amount'    =>  $amount,
                            'transaction_type'  =>  'charge',
                            'transaction_object_type'   =>  (!empty($coupon->company) && $coupon->company->user_id == $coupon->user_id) ? "company" : "affiliate",
                            'object_id' =>  (!empty($coupon->company) && $coupon->company->user_id == $coupon->user_id) ? $coupon->company_id : $coupon->affiliate_id,
                            'notes' =>  "Code Auto Recharge done for ".$coupon->coupon_code." added at $".number_format($coupon->end_price, 2)." of end price, with ".$coupon->coupondetail->auto_recharge_limit." new usage.",
                            'status'    =>  'success',
                            'created_datetime' => Carbon::now()
                        ];

                        $transaction = TransactionModel::create($transaction_array);
                        if($transaction){
                            CouponModel::where('coupon_id', $coupon->coupon_id)->increment('usage_limit', $coupon->coupondetail->auto_recharge_limit);
                            CouponDetailModel::where('id', $coupon->coupondetail->id)->update(['auto_recharge_email' => 0]);

                            if(!empty($coupon->company) && $coupon->company->user_id == $coupon->user_id){
                                CompanyModel::where('company_id', $coupon->company_id)->decrement('credits', $amount);
                            }else{
                                AffiliateModel::where('affiliate_id', $coupon->affiliate_id)->decrement('unused_credits', $amount);
                            }

                            $coupon = CouponModel::with(['user', 'affiliate', 'company', 'coupondetail'])->find($coupon->coupon_id);
                            // use $coupon->user->user_email
                            Mail::send($coupon->user->user_email, 'Your Prepaid Code at FourTemperaments Has Been Auto-Recharged', 'coupon-auto-recharged', ['coupon' => $coupon, 'transaction' => $transaction, 'paymentMethod' => $paymentMethod, 'paymentIntent' => $paymentIntent]);
                        }
                    }
                }
            }catch (Exception $e) {
				$response = $e->getJsonBody();
                Logger::info("Auto Recharge of ".$coupon->coupon_code." code failed due to: ".$response['error']);
            }
        }
        // Logger::info('Cron coupons:coupon-auto-recharge completed');
    }
}
