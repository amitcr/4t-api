<?php
namespace App\Services;

/**
 * Builds the customer-facing order price breakdown for an assessment.
 *
 * Mirrors mytemp_get_order_price_breakdown() in the wp-temperament-assessment
 * plugin so the payment page and this receipt always agree. The breakdown is
 * derived from the global price settings plus the reports the order actually
 * delivers - never from the coupon's stored `global_price`/`discount_amount`,
 * which hold the creating affiliate's own retail rather than the platform's and
 * vary between coupons.
 */
class OrderPricingService
{
    /**
     * Build the order price breakdown.
     *
     * Customer-facing keys, rendered top to bottom:
     *  - list_label / list_total    combined list price of every report purchased
     *  - ft_discount                platform's own discount, list -> global price
     *  - discount / discount_codes  coupon discount, global price -> amount payable
     *  - final_price                amount payable
     *
     * list_total - ft_discount - discount always equals final_price.
     *
     * The customer sees one list row covering both the Personal and, when purchased,
     * the Manager Report; `items` carries the per-report detail behind that figure
     * and is for reporting, not display.
     *
     * Accounting keys (never rendered): retail_total, wholesale_total,
     * platform_funded, affiliate_funded. platform_funded + affiliate_funded always
     * equals list_total - final_price.
     *
     * @param object $assessment        Assessment model with its payment relation loaded.
     * @param mixed  $assessmentCoupons Collection of coupon tracking rows, or null.
     * @return array
     */
    public static function breakdown($assessment, $assessmentCoupons = null): array
    {
        $items = [
            [
                'key'    => 'personal_report',
                'label'  => 'Personal Report',
                'retail' => self::personalReportRetailPrice(),
                'list'   => self::personalReportListPrice(),
            ],
        ];

        $hasManagerReport = false;

        // A participant starts under one code and may redeem at most one of its
        // upgrade children - no chaining, no nesting. Coupons arrive in tracking
        // order, so the most recently applied child simply wins.
        $baseCoupon    = null;
        $upgradeCoupon = null;

        if (!empty($assessmentCoupons) && $assessmentCoupons->isNotEmpty()) {
            foreach ($assessmentCoupons as $couponRow) {
                $coupon = $couponRow->coupon ?? null;
                if (empty($coupon)) {
                    continue;
                }

                if (!empty($coupon->upgrade_code)) {
                    $upgradeCoupon = $coupon;
                } elseif ($baseCoupon === null) {
                    $baseCoupon = $coupon;
                }

                if (!$hasManagerReport && !empty($coupon->manager_report)) {
                    $hasManagerReport = true;
                    // No separate list price for the Manager Report: it lists at
                    // its global price.
                    $managerPrice = (float) get_settings_option('affcp_settings.global_mgr_price');
                    $items[] = [
                        'key'    => 'manager_report',
                        'label'  => 'Manager Report',
                        'retail' => $managerPrice,
                        'list'   => $managerPrice,
                    ];
                }

            }
        }

        $retailTotal = 0.0;
        $listTotal   = 0.0;
        foreach ($items as $item) {
            $retailTotal += (float) $item['retail'];
            $listTotal   += (float) ($item['list'] ?? $item['retail']);
        }

        $finalPrice = (float) ($assessment->payment->end_price ?? 0);

        // The platform's own discount: list price down to the current global price.
        $ftDiscount = max(0, $listTotal - $retailTotal);

        // The coupon discount. A final price above the global price means a
        // misconfigured coupon; show no discount rather than a negative one.
        $discount = max(0, $retailTotal - $finalPrice);

        // An upgrade with no base code behaves as the base.
        if ($baseCoupon === null && $upgradeCoupon !== null) {
            $baseCoupon    = $upgradeCoupon;
            $upgradeCoupon = null;
        }

        // When an upgrade was redeemed the child is the operative instrument -
        // its credits are the ones that were charged - so its wholesale wins.
        $wholesaleTotal = null;
        foreach ([$upgradeCoupon, $baseCoupon] as $coupon) {
            if (!empty($coupon) && isset($coupon->merchant_share) && $coupon->merchant_share > 0) {
                $wholesaleTotal = (float) $coupon->merchant_share;
                break;
            }
        }

        // With no affiliate involved the platform funds any discount.
        if ($wholesaleTotal === null) {
            $wholesaleTotal = $retailTotal;
        }
        $wholesaleTotal = min($wholesaleTotal, $retailTotal);

        return [
            'items'             => $items,
            'list_label'        => 'Your MyTemperament Results',
            'list_total'        => $listTotal,
            'ft_discount'       => $ftDiscount,
            'ft_discount_label' => 'FourTemperament Discount',
            'discounts'         => self::discountRows($baseCoupon, $upgradeCoupon, $retailTotal, $finalPrice, $discount),
            'discount'          => $discount,
            'final_price'       => $finalPrice,
            'retail_total'      => $retailTotal,
            'wholesale_total'   => $wholesaleTotal,
            'platform_funded'   => $ftDiscount + max(0, $retailTotal - $wholesaleTotal),
            'affiliate_funded'  => $wholesaleTotal - $finalPrice,
        ];
    }

    /**
     * Build the coupon discount rows.
     *
     * Each row discounts from the previous step's price rather than from retail,
     * so the rows telescope and always sum to (retail - final):
     *
     *   base code : retail - base price
     *   upgrade   : base price - final price
     *
     * The base row is emitted even when it saves nothing, so a participant can
     * see the code their assessment was started under.
     *
     * @return array<int, array{key: string, code: string, amount: float, is_upgrade: bool}>
     */
    protected static function discountRows($baseCoupon, $upgradeCoupon, float $retailTotal, float $finalPrice, float $discount): array
    {
        // With no coupon involved, any reduction is a single unattributed discount.
        if (empty($baseCoupon)) {
            return $discount > 0
                ? [['key' => 'discount', 'code' => '', 'amount' => $discount, 'is_upgrade' => false]]
                : [];
        }

        // Price the participant would have paid before redeeming an upgrade.
        // Without an upgrade the base code accounts for the whole discount.
        $basePrice = !empty($upgradeCoupon) ? (float) $baseCoupon->end_price : $finalPrice;

        // Keep the chain monotonic so neither row can render a negative discount.
        $basePrice = min(max($basePrice, $finalPrice), $retailTotal);

        $rows = [[
            'key'        => 'coupon',
            'code'       => (string) $baseCoupon->coupon_code,
            'amount'     => max(0, $retailTotal - $basePrice),
            'is_upgrade' => false,
        ]];

        if (!empty($upgradeCoupon)) {
            $rows[] = [
                'key'        => 'upgrade',
                'code'       => (string) $upgradeCoupon->coupon_code,
                'amount'     => max(0, $basePrice - $finalPrice),
                'is_upgrade' => true,
            ];
        }

        return $rows;
    }

    /**
     * Personal Report list price: the platform's default price.
     *
     * Never below the current global price - when `global_static_price` is unset
     * or lower there is no platform discount to show.
     */
    protected static function personalReportListPrice(): float
    {
        return max(
            (float) get_settings_option('mytemp_settings.global_static_price'),
            self::personalReportRetailPrice()
        );
    }

    /**
     * Personal Report global retail price: the current global price, the same
     * figure wp-affiliates-coupons uses for all coupon math.
     */
    protected static function personalReportRetailPrice(): float
    {
        return (float) get_settings_option('mytemp_settings.assessment_price');
    }
}
