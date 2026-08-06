# Feature: Emails

How the API sends email — the mailer abstraction (SES / SMTP), the Mailjet contact/list integration, asynchronous sending via the queue, and the scheduled reminder/notification emails.

## Sections
- [The mailer](#the-mailer)
- [Templates](#templates)
- [Asynchronous sending (SendEmailJob)](#asynchronous-sending-sendemailjob)
- [Emails sent during report generation](#emails-sent-during-report-generation)
- [Scheduled reminder emails](#scheduled-reminder-emails)
- [Mailjet contacts/lists](#mailjet-contactslists)
- [Environment behavior](#environment-behavior)
- [Related](#related)

---

## The mailer

`app/Core/Mail/` (`Mail`, `MailManager`, and SES/SMTP mailer implementations), configured by **`config/mailer.php`**. `Mail::init()` runs at boot (`public/index.php`). Send with:

```php
Mail::send($to, $subject, $template, $data);
```

- **AWS SES** (via the AWS SDK) is the production transport option; **SMTP** is available. The driver is chosen in `config/mailer.php` / `.env`.
- `$template` names a view in `resources/views/mail/`; `$data` is passed to it.

---

## Templates

Email templates live in **`resources/views/mail/`** (e.g. `manager-assessment-notification`, `affiliate-company-assessment-notification`, `assessment-images-missing`, `auto-recharge-invoice`, coupon-expiry / mini-usage reminders). They render to HTML for the mailer.

---

## Asynchronous sending (SendEmailJob)

`app/Jobs/SendEmailJob.php` sends email **through the queue** so a slow send never blocks the caller — dispatched like any job (`Queue::dispatch(SendEmailJob::class, [...])`) and processed by `queue:work`. See [background-jobs-and-queue.md](background-jobs-and-queue.md).

---

## Emails sent during report generation

`AssessmentReportService::generateReport()` sends (see [report-generation.md](report-generation.md#emails-on-generation)):
- **Manager report ready** → the coupon's managers (`manager-assessment-notification`).
- **Affiliate/company notification** → `affiliate-company-assessment-notification`.
- **Missing-charts alert** → admin (`assessment-images-missing`).

---

## Scheduled reminder emails

Time-driven emails are their own commands ([scheduled-commands.md](scheduled-commands.md)):

| Command | Cadence | Email |
|---|---|---|
| `emails:coupon-expire-reminder` (`CouponExpiryReminderEmail`) | daily 16:00 UTC | 3-day coupon-expiry reminder |
| `emails:auto-recharge-reminder` (`UpcomingAutoRechargeReminder`) | every minute | 70% upcoming auto-recharge reminder |
| `emails:mini-usage-reminder` (`MiniUsageReminder`) | daily 16:05 UTC | mini-report usage running low |

Plus invoice/confirmation emails sent inline by `coupons:coupon-auto-recharge` (auto-recharge invoice) and `coupons:expire-status`. These replaced the removed WordPress `notify_coupon_usage` / `codes-status-checker` crons.

---

## Mailjet contacts/lists

`MailjetService` + `Services/Mailjet/*` manage Mailjet **contacts and lists** (subscribe/unsubscribe as the platform's lifecycle dictates). The transactional *delivery* of `wp_mail()` on the WordPress side is via the separate `ft-mailjet-pro` plugin (path only); on the API side, transactional mail goes through the `Core/Mail` SES/SMTP path above.

---

## Environment behavior

On **`APP_ENV=local`/`staging`**, all outbound email is **redirected to `APP_EMAIL`** (`Config::get('app.email')`) — the report/notification code checks `Config::get('app.env')` and swaps the recipient. Confirm `APP_ENV` before reasoning about who receives what.

---

## Related

- [report-generation.md](report-generation.md) — generation emails
- [coupons-and-credits.md](coupons-and-credits.md) — invoice / reminder emails
- [scheduled-commands.md](scheduled-commands.md) · [integrations.md](../integrations.md)
