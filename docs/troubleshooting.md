# Troubleshooting

Common failure modes and where to look. The service is mostly invisible until something it produces (a PDF, a credit reversal, an email) is missing — so start from the symptom.

## Sections
- [Where the logs are](#where-the-logs-are)
- [No PDF is generated](#no-pdf-is-generated)
- [Jobs stuck or failing](#jobs-stuck-or-failing)
- [Scheduled commands not running](#scheduled-commands-not-running)
- [Scoring Engine errors](#scoring-engine-errors)
- [Auth / JWT](#auth--jwt)
- [Emails](#emails)
- [Credits / coupons](#credits--coupons)
- [Related](#related)

---

## Where the logs are

- **API logs:** `api/logs/` (jobs, commands, GraphQL, mail). `Logger::info/error` writes here.
- `display_errors` is currently `1` in `public/index.php` / `public/app.php` — intended to be `0` in production; verify before relying on it.
- Root-level `logs/` and `error-logs/` also collect output.

---

## No PDF is generated

| Symptom | Likely cause |
|---|---|
| Nothing renders, ever | **`queue:work` isn't running.** It must be a persistent process. |
| Job goes `held` repeatedly | **Chart images missing** (`assessments/images/chart_{id}.png` / `single_chart_{id}.png`) — the job throws `ChartImagesMissingException` and is held for a retry window ([features/report-generation.md](features/report-generation.md)). The WP side releases it early when charts appear. |
| Held forever | Charts were never produced browser-side; check the WP funnel's chart step and the "missing charts" alert email. |
| Wrong version served | Original vs validated: `pdf_status`/review version mismatch — see [features/report-generation.md](features/report-generation.md#versioned-validated--manager-pdfs). |

---

## Jobs stuck or failing

| Symptom | Likely cause |
|---|---|
| `status='processing'` stuck | Worker died mid-job; restart `queue:work` (a fresh fetch re-reserves). |
| `status='failed'` | The job threw — read `api/logs/` and `jobs.failed_at`. |
| Job never picked up | `available_at` in the future (a held job waiting out its window), or worker not running. See [features/background-jobs-and-queue.md](features/background-jobs-and-queue.md). |

---

## Scheduled commands not running

| Symptom | Likely cause |
|---|---|
| No crons execute | System cron isn't invoking `php artisan schedule:run` every minute. |
| A command errors | Run it manually (`php artisan <signature>`) and read the output/log. |
| Wrong timing/scope | The windows are intentional business rules — don't "simplify"; verify `APP_ENV` (timing differs). |

---

## Scoring Engine errors

| Symptom | Likely cause |
|---|---|
| GraphQL returns null | `BaseGraphQLService::getLastError()` has the message; check endpoint (`mytemp_settings`) + keys (`.env`). |
| Endpoint unreachable | `staging_mode` pointing at the wrong endpoint, or the engine is down. |
| Auth rejected | `x-app-id`/`x-api-key` wrong for the environment. |

---

## Auth / JWT

| Symptom | Likely cause |
|---|---|
| 401 on protected routes | Missing/expired `Authorization: Bearer`; `JwtMiddleware` rejected it. |
| Login fails for a valid WP user | Password-hash mismatch — `PasswordHashService` must mirror WP phpass params ([features/authentication.md](features/authentication.md)). |
| Default secret warning | `JWT_SECRET` unset → the fallback is in use; set a real one in production. |

---

## Emails

| Symptom | Likely cause |
|---|---|
| No emails in dev | `APP_ENV=local`/`staging` redirects all mail to `APP_EMAIL`. |
| Nothing sends in prod | SES/SMTP/Mailjet misconfigured in `config/mailer.php` / `.env`. |
| Async email never sent | `SendEmailJob` needs the worker running. |

---

## Credits / coupons

| Symptom | Likely cause |
|---|---|
| Credits not reversed on expiry | `coupons:expire-status` didn't run — check cron + `api/logs/`. |
| Prepaid didn't auto-recharge | `coupons:coupon-auto-recharge`; requires config + a saved payment method. Mini codes never recharge. |
| `usage_count` drift | Run `coupons:resync-usage-count`; **the API never writes `usage_count`** directly ([features/coupons-and-credits.md](features/coupons-and-credits.md)). |

---

## Related

- [features/report-generation.md](features/report-generation.md) · [features/background-jobs-and-queue.md](features/background-jobs-and-queue.md) · [features/scheduled-commands.md](features/scheduled-commands.md) · [integrations.md](integrations.md)
