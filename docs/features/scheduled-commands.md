# Feature: Scheduled Commands (Cron)

The API is the **single source** of all scheduled/maintenance work on the platform — every WordPress-side cron was migrated here and removed. A system cron runs `php artisan schedule:run` every minute; the CronKernel decides which commands are due.

## Sections
- [How scheduling works](#how-scheduling-works)
- [The schedule](#the-schedule)
- [What each command does](#what-each-command-does)
- [Adding a command](#adding-a-command)
- [Related](#related)

---

## How scheduling works

- **`app/Console/Kernel.php`** (extends `Core\CronKernel`) defines two methods:
  - `commands()` — `register()`s each command class (each has a `$signature`).
  - `schedule(Schedule $schedule)` — the timetable (`->everyMinute()`, `->everyFiveMinutes()`, `->dailyAt('HH:MM')->timezone('UTC')`).
- **`php artisan schedule:run`** (driven by system cron every minute) evaluates the schedule and runs due tasks. `Core\CronExpression` / `Core\ScheduleTask` implement the timing.
- Commands live in `app/Console/Commands/`, implement `Core\CommandInterface` (a `handle($arguments)` method), and can also be run **manually**: `php artisan <signature>`.

> Files named `opt-*.php` in `Commands/` are in-progress optimized rewrites and are **not registered** — they do not run.

---

## The schedule

From `Kernel::schedule()` (all times UTC):

| Signature | Schedule | Command class |
|---|---|---|
| `emails:coupon-expire-reminder` | daily 16:00 | `CouponExpiryReminderEmail` |
| `emails:auto-recharge-reminder` | every minute | `UpcomingAutoRechargeReminder` |
| `coupons:coupon-auto-recharge` | every minute | `CouponAutoRecharge` |
| `coupons:expire-status` | daily 06:00 | `ValidateCoupons` |
| `assessments:abandoned-followup` | every 5 min | `AbandonedAssessmentFollowUp` |
| `assessments:generate-report` | every minute | `GenerateAssessmentReport` |
| `assessments:delete-duplicates` | daily 06:00 | `DeleteDuplicateAssessments` |
| `assessments:sync-stats` | daily 06:05 | `ExportAssessmentStats` |
| `coupons:resync-usage-count` | daily 06:10 | `ResyncCouponUsageCount` |
| `emails:mini-usage-reminder` | daily 16:05 | `MiniUsageReminder` |

`queue:work` (`QueueWorkerCommand`) is registered too but is **not scheduled** — it runs as a separate persistent process ([background-jobs-and-queue.md](background-jobs-and-queue.md)).

---

## What each command does

- **`assessments:generate-report`** — sweeps `finished` assessments with `pdf_status=0` (past a min-age gate) whose charts exist and enqueues report jobs (safety net for missed triggers). See [report-generation.md](report-generation.md).
- **`assessments:abandoned-followup`** — sends Mailjet follow-ups for abandoned assessments. **Timing depends on `APP_ENV`** (production 60–70 min window; local/staging widened to ~365 days).
- **`assessments:delete-duplicates`** — removes duplicate assessments.
- **`assessments:sync-stats`** — exports assessment stats to Google Sheets (`GoogleSheetsService`).
- **`coupons:expire-status`** (`ValidateCoupons`) — expires coupons past `end_date`; **reverses unused credits**; settles the credit-charged limit down to the used count; expires settled upgrade children. See [coupons-and-credits.md](coupons-and-credits.md).
- **`coupons:coupon-auto-recharge`** — tops up prepaid `usage_limit` for auto-recharge codes (never `mini_usage_limit`).
- **`coupons:resync-usage-count`** — recomputes the cached `usage_count` from tracking rows (daily + post-deploy backfill).
- **`emails:coupon-expire-reminder`** — 3-day coupon-expiry reminder.
- **`emails:auto-recharge-reminder`** — the 70% upcoming auto-recharge reminder.
- **`emails:mini-usage-reminder`** — mini-report "running low" email.

Full signatures: [reference/commands.md](../reference/commands.md).

---

## Adding a command

1. Create `app/Console/Commands/YourCommand.php` implementing `CommandInterface`, with a `$signature`.
2. `register()` it in `Kernel::commands()`.
3. Add it to `Kernel::schedule()` with a cadence (or leave it manual-only).
4. Keep timing/scope conditions as intentional business rules — don't "simplify" them.

---

## Related

- [coupons-and-credits.md](coupons-and-credits.md) — the credit crons in depth
- [emails.md](emails.md) — the reminder emails · [background-jobs-and-queue.md](background-jobs-and-queue.md)
- [reference/commands.md](../reference/commands.md)
