# Reference: Console Commands

Every `artisan` command, from `app/Console/Kernel.php` (`commands()` registers them; `schedule()` sets cadence). Each command class is in `app/Console/Commands/`, implements `Core\CommandInterface`, and has a `$signature`. Run manually with `php artisan <signature>`; run all due scheduled tasks with `php artisan schedule:run`.

---

## Scheduled commands

| Signature | Class | Cadence (UTC) | Purpose |
|---|---|---|---|
| `emails:coupon-expire-reminder` | `CouponExpiryReminderEmail` | daily 16:00 | 3-day coupon-expiry reminder email |
| `emails:auto-recharge-reminder` | `UpcomingAutoRechargeReminder` | every minute | 70% upcoming auto-recharge reminder |
| `coupons:coupon-auto-recharge` | `CouponAutoRecharge` | every minute | Auto-recharge prepaid `usage_limit` (Stripe charge) |
| `coupons:expire-status` | `ValidateCoupons` | daily 06:00 | Expire coupons + reverse unused credits + settle limits |
| `assessments:abandoned-followup` | `AbandonedAssessmentFollowUp` | every 5 min | Abandoned-assessment Mailjet follow-up (timing per `APP_ENV`) |
| `assessments:generate-report` | `GenerateAssessmentReport` | every minute | Enqueue report jobs for finished/`pdf_status=0` assessments |
| `assessments:delete-duplicates` | `DeleteDuplicateAssessments` | daily 06:00 | Remove duplicate assessments |
| `assessments:sync-stats` | `ExportAssessmentStats` | daily 06:05 | Export stats to Google Sheets |
| `coupons:resync-usage-count` | `ResyncCouponUsageCount` | daily 06:10 | Recompute cached `usage_count` from tracking rows |
| `emails:mini-usage-reminder` | `MiniUsageReminder` | daily 16:05 | Mini-report usage running low |

Details: [../features/scheduled-commands.md](../features/scheduled-commands.md), [../features/coupons-and-credits.md](../features/coupons-and-credits.md), [../features/emails.md](../features/emails.md).

---

## Non-scheduled (persistent process)

| Signature | Class | Notes |
|---|---|---|
| `queue:work` | `QueueWorkerCommand` | Registered but **not scheduled** — runs as a persistent process, polling `{prefix}jobs` every ~0.5s. **Required for any PDF/async email.** |

See [../features/background-jobs-and-queue.md](../features/background-jobs-and-queue.md).

---

## Dormant / not registered

- Commented-out in the Kernel: `ClearTempUsers`, `SendReminderEmails`.
- Files named **`opt-*.php`** in `Commands/` are in-progress optimized rewrites — **not registered, do not run.**

---

## Running examples

```bash
php artisan list                         # list registered commands
php artisan schedule:run                 # run all due scheduled tasks once (system cron every minute)
php artisan queue:work                   # start the worker (keep running)
php artisan coupons:expire-status        # run a single command manually
php artisan coupons:resync-usage-count   # post-deploy usage_count backfill
```

---

## Related

- [../features/scheduled-commands.md](../features/scheduled-commands.md) · [../features/background-jobs-and-queue.md](../features/background-jobs-and-queue.md)
- [../deployment.md](../deployment.md#processes-queue-worker--cron)
