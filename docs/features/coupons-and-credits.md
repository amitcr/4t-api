# Feature: Coupons & Credits (Crons)

The **credit reversal, auto-recharge, and usage-count reconciliation** math for Plugin 2's coupon/credit system lives here, in scheduled commands. Plugin 2 owns the tables and the `usage_count` cache; this service performs the recurring money/limit operations on them. **Coordinate any credit-semantics change with the `wp-affiliates-coupons` repo** (path reference only).

## Sections
- [Ownership split](#ownership-split)
- [coupons:expire-status — expiry & credit reversal](#couponsexpire-status--expiry--credit-reversal)
- [coupons:coupon-auto-recharge](#couponscoupon-auto-recharge)
- [coupons:resync-usage-count](#couponsresync-usage-count)
- [The reminder emails](#the-reminder-emails)
- [Tables touched](#tables-touched)
- [Related](#related)

---

## Ownership split

- **Plugin 2 (WordPress)** owns the coupon/credit tables and **writes `usage_count`** (via `affcp_resync_coupon_usage_count()`) whenever tracking rows change.
- **This service (API)** runs the **time-driven** operations: expiry + reversal, auto-recharge, and a daily usage-count reconciliation. **The API never writes `usage_count` as a running counter** — it recomputes it only for reconciliation, and its reversal counter is computed independently.

---

## coupons:expire-status — expiry & credit reversal

`ValidateCoupons` (daily 06:00 UTC). For each coupon with **`end_date = yesterday` and `status='active'`**:

1. **Count real uses:** `usage_counter` = tracking rows (`CouponTrackingModel`) in `assigned` or `completed` (`pending` rows don't count).
2. **Compute the credit reversal** per branch (`credits_charged − credits_used`), where:
   - **Mini** codes: `charged = mini_usage_limit × |mini_price|`, `used = usage_counter × |mini_price|`.
   - **Affiliate credits-based** (`affiliate_share < 0`): `charged = usage_limit × |affiliate_share|`.
   - **Company** (`discount_amount > 0`): `charged = usage_limit × |discount_amount|`.
   - The reversal is credited back to the **`affiliate`** or **`company`** per the coupon's `reversed_credits_to`, recorded as a `transaction_type='reversal'` ledger row.
   - **Commission codes with `affiliate_share >= 0` are untouched** (no reversal).
3. **Expire only `pending` tracking rows** (`usage_status: pending → expired`). **`assigned`/`completed` stay counted** — past real uses must remain counted when a code expires.
4. **Upgrade children:** for each `parent_code_id = this coupon` prepaid child — same reversal, expire its `pending` rows, then **settle its `usage_limit` down to its used count** and set `status='expired'`.
5. **Settle the parent limit down to the used count** (reduce-only): `usage_limit` (affiliate/company/upgrade branches) and `mini_usage_limit` (mini) are reduced to `usage_counter` **after** the reversal — so the stored limit equals what was actually paid-for. Only where a reversal was applied.

> This keeps the stored limit equal to what was paid-for so the WP edit "Current Limit" matches the used baseline for expired codes. Don't reduce limits where `status='active'` (auto-recharge divides by `usage_limit`).

---

## coupons:coupon-auto-recharge

`CouponAutoRecharge` (every minute). For each **active** coupon with `coupondetail.auto_recharge = 1` that is near its limit — **`(usage_count / usage_limit) × 100 >= 80`**, or `usage_limit < 5 and (usage_limit − usage_count) <= 1`:

1. Resolve the coupon's saved `PaymentMethodModel` (`coupondetail.payment_method_id`).
2. Charge a Stripe **PaymentIntent** for `auto_recharge_limit × |affiliate_share|` (i.e. `auto_recharge_limit` new uses at the code's end-price economics).
3. On success: record a `transaction_type='charge'` ledger row, **`increment('usage_limit', auto_recharge_limit)`**, reset `auto_recharge_email`, and send the **auto-recharge invoice** email.

**Auto-recharge only ever tops up `usage_limit` — never `mini_usage_limit` (mini codes are not auto-recharged).**

---

## coupons:resync-usage-count

`ResyncCouponUsageCount` (daily 06:10 UTC + run once post-deploy as the backfill). Recomputes each coupon's cached `usage_count` from its `assigned`/`completed` tracking rows — the cross-repo reconciliation for drift (e.g. from `assessments:delete-duplicates` deletes or historical inconsistency). This is the **only** place the API touches `usage_count`, and it recomputes rather than increments.

---

## The reminder emails

Time-driven reminders (separate commands, [emails.md](emails.md)):
- **`emails:auto-recharge-reminder`** (`UpcomingAutoRechargeReminder`, every minute) — the 70% "upcoming auto-charge" reminder (before the 80% auto-recharge fires).
- **`emails:coupon-expire-reminder`** (`CouponExpiryReminderEmail`, daily 16:00) — 3-day expiry reminder.
- **`emails:mini-usage-reminder`** (`MiniUsageReminder`, daily 16:05) — mini-report usage running low.

---

## Tables touched

| Table (Plugin 2) | Use |
|---|---|
| `affcp_wp_coupons` | `end_date`, `status`, `usage_limit`, `mini_usage_limit`, `usage_count`, `affiliate_share`, `reversed_credits_to`, `parent_code_id` |
| `affcp_coupons_tracking` | count `assigned`/`completed`; expire `pending` |
| `affcp_coupon_details` | auto-recharge config |
| `affcp_wp_affiliates` / `affcp_wp_companies` | credit balances |
| `mytemp_transactions` | `reversal` / `charge` ledger rows |

Column definitions live in the Plugin 2 docs (`wp-affiliates-coupons/docs/`, path only).

---

## Related

- [scheduled-commands.md](scheduled-commands.md) — the schedule · [emails.md](emails.md) — the reminders
- [reference/commands.md](../reference/commands.md) · [integrations.md](../integrations.md)
