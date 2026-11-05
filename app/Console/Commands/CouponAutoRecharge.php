<?php
namespace App\Console\Commands;

use App\Core\CommandInterface;

use App\Models\CouponModel;  
use App\Models\CouponDetailModel;
use App\Models\PaymentMethodModel;
use App\Services\CreditLedgerService;
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
                    'amount'    =>  ($amount*100),
                    'customer'  =>  $customer_stripe_id,
                    'currency'  =>  'usd',
                    'automatic_payment_methods' =>  [
                        'enabled'   =>  true
                    ],
                    'description'   =>  (!empty($coupon->company) && $coupon->company->user_id == $coupon->user_id) ? "Auto Payment for Credits added to company account." : "Auto Payment for Credits added to affiliate account.",
                    'payment_method'    =>  $couponPaymentMethod->payment_method,
                    'off_session'   =>  true,
                    'confirm'   =>  true
                ], [
                    // One card charge per recharge: an overlapping or retried run gets Stripe's stored
                    // result instead of a second charge. usage_limit grows after each successful
                    // recharge, so the next real recharge uses a new key. (Stripe keeps keys 24h, so a
                    // declined card is retried after that, not every minute.)
                    'idempotency_key' => 'auto_recharge_'.$coupon->coupon_id.'_'.$coupon->usage_limit,
                ]);

                if($paymentIntent->id && $paymentIntent->status == "succeeded"){
                    $isCompany   = !empty($coupon->company) && $coupon->company->user_id == $coupon->user_id;
                    $accountType = $isCompany ? 'company' : 'affiliate';
                    $accountId   = (int) ($isCompany ? $coupon->company_id : $coupon->affiliate_id);
                    $newUsage    = $coupon->coupondetail->auto_recharge_limit;
                    $chargeNote  = "Code Auto Recharge done for ".$coupon->coupon_code." added at $".number_format($coupon->end_price, 2)." of end price, with ".$newUsage." new usage.";

                    /*
                     * Credit ledger (wp-affiliates-coupons 1.1.2): balance change, history rows and the
                     * coupon's new usage limit commit together; keyed on the PaymentIntent so a retried
                     * or overlapping run can never apply the same recharge twice.
                     *
                     * The card pays $amount, which is added to the account as credits (+$amount), and
                     * those same credits pay for the new usage (-$amount): the balance nets to zero.
                     * (Before 1.1.2 only the -$amount was applied, so the account paid twice: by card
                     * and from its credits. Decided 2026-11-04.)
                     */
                    $legs = [];
                    $legs[] = [
                        'bucket'          => 'code_credits',
                        'entry_type'      => 'auto_recharge',
                        'amount'          => $amount,
                        'reference_type'  => 'stripe_pi',
                        'reference_id'    => $paymentIntent->id,
                        'idempotency_key' => 'stripe_pi_'.$paymentIntent->id,
                        'public_note'     => "Auto Credits added for auto recharge of ".$coupon->coupon_code,
                    ];
                    $legs[] = [
                        'bucket'          => 'code_credits',
                        'entry_type'      => 'charge',
                        'amount'          => -$amount,
                        'reference_type'  => 'stripe_pi',
                        'reference_id'    => $paymentIntent->id,
                        'idempotency_key' => 'stripe_pi_'.$paymentIntent->id.':charge',
                        'public_note'     => $chargeNote,
                        'admin_note'      => 'Auto recharge of coupon #'.$coupon->coupon_id.' paid by card ('.$paymentIntent->id.', $'.number_format($amount, 2).').',
                    ];

                    $result = null;
                    try {
                        $first  = array_shift($legs);
                        $result = CreditLedgerService::post($accountType, $accountId, $first, [
                            'inside' => function ($posted) use ($legs, $accountType, $accountId, $coupon, $newUsage) {
                                foreach ($legs as $leg) {
                                    CreditLedgerService::post($accountType, $accountId, $leg);
                                }
                                if (!$posted['duplicate']) {
                                    CouponModel::where('coupon_id', $coupon->coupon_id)->increment('usage_limit', $newUsage);
                                    CouponDetailModel::where('id', $coupon->coupondetail->id)->update(['auto_recharge_email' => 0]);
                                }
                            },
                        ]);
                    } catch (\Throwable $ledgerError) {
                        // The card WAS charged: log everything needed to settle it by hand.
                        Logger::error("Auto Recharge of ".$coupon->coupon_code.": card charged (".$paymentIntent->id.", $".$amount.") but the ledger / usage update failed: ".$ledgerError->getMessage());
                    }

                    if ($result && !$result['duplicate']) {
                        // The invoice number shows "-L<ledger entry id>", as on the WordPress side.
                        $transaction = (object) ['transaction_id' => 'L'.$result['entry_id'], 'amount' => $amount];

                        // use $coupon->user->user_email
                        Mail::send($coupon->user->user_email, 'Successful Auto Recharge Confirmation & Invoice', 'auto-recharge-invoice', ['coupon' => $coupon, 'transaction' => $transaction, 'paymentMethod' => $paymentMethod, 'paymentIntent' => $paymentIntent]);

                        $coupon = CouponModel::with(['user', 'affiliate', 'company', 'coupondetail'])->find($coupon->coupon_id);
                        // use $coupon->user->user_email
                        Mail::send($coupon->user->user_email, 'Your Prepaid Code at FourTemperaments Has Been Auto-Recharged', 'coupon-auto-recharged', ['coupon' => $coupon, 'transaction' => $transaction, 'paymentMethod' => $paymentMethod, 'paymentIntent' => $paymentIntent]);
                    }
                }
            }catch (\Exception $e) {
				// Stripe exceptions carry a JSON body; anything else only has a message.
				$response = method_exists($e, 'getJsonBody') ? $e->getJsonBody() : null;
				$reason   = isset($response['error']) ? json_encode($response['error']) : $e->getMessage();
                Logger::info("Auto Recharge of ".$coupon->coupon_code." code failed due to: ".$reason);
            }
        }
        // Logger::info('Cron coupons:coupon-auto-recharge completed');
    }
}
