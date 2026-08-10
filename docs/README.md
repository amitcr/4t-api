# 4t-api (API Backend) — Developer Documentation

> **Audience:** developers working on this service's codebase. For platform-wide business workflows and operations, see the separate **`product-manual`** repository.

The backend service for the Four Temperaments platform. It exposes an HTTP JSON API, runs the scheduled jobs/crons, generates PDF reports, and brokers communication with the external Scoring Engine. It is **one of three coordinated repos** (with the two WordPress plugins) and **shares the WordPress MySQL database** (the site's WordPress table prefix, written `{prefix}` throughout these docs — the real value lives in `wp-config.php` / `DB_PREFIX` in `.env`).

| | |
|---|---|
| **Entry (HTTP)** | `public/index.php` (Apache serves `public/` at `/api/`) |
| **Entry (CLI)** | `artisan` → `public/app.php` → `Console\Kernel` |
| **Framework** | hand-rolled, **Laravel-looking but NOT Laravel** (`app/Core/*`) |
| **Real deps** | `illuminate/database` (Eloquent), Guzzle, Stripe, AWS SES, `spipu/html2pdf`, Mailjet, Google API, `phpdotenv` |
| **Owns schema?** | **No** — reads tables the WordPress plugins create; no migrations |
| **Git** | its own repository, deployed to the `api/` subdirectory of the WP docroot |

---

## How this documentation is organized

Docs are organized around **complete features** (end-to-end processes), not individual files. Where logic lives in another repo, this documentation references the **path only** (docs are not linked across repos).

### Getting oriented (read in order)
1. **[architecture.md](architecture.md)** — the custom framework, boot sequence, the Core primitives, and why you must not assume Laravel.
2. **[setup.md](setup.md)** — requirements, Composer, `.env`, and the two long-running processes (queue worker + cron).
3. **[coding-standards.md](coding-standards.md)** — the strict rules (don't assume Laravel, `{prefix}jobs`, GraphQL, read-only WP settings, `APP_ENV`).

### Features → [`features/`](features/)
| Feature | Doc |
|---|---|
| **Report Generation** — the async PDF pipeline (queue → job → PDF), charts, snapshot, manager reports | [features/report-generation.md](features/report-generation.md) |
| **Background Jobs & Queue** — the `{prefix}jobs` table, the worker, `held`/retry mechanics | [features/background-jobs-and-queue.md](features/background-jobs-and-queue.md) |
| **Scheduled Commands (cron)** — the CronKernel + schedule + every command | [features/scheduled-commands.md](features/scheduled-commands.md) |
| **Scoring Engine Proxy** — the GraphQL service layer + the browser-facing proxy controllers | [features/scoring-engine-proxy.md](features/scoring-engine-proxy.md) |
| **Coupons & Credits (crons)** — expiry + credit reversal, auto-recharge, usage-count resync | [features/coupons-and-credits.md](features/coupons-and-credits.md) |
| **Authentication** — JWT, temporary registration, WP-compatible password hashing, middleware | [features/authentication.md](features/authentication.md) |
| **Emails** — the mailer (SES/SMTP), Mailjet, `SendEmailJob`, and the reminder commands | [features/emails.md](features/emails.md) |

### Reference → [`reference/`](reference/)
- **[reference/routes.md](reference/routes.md)** — the full `/api/v1` HTTP route map.
- **[reference/commands.md](reference/commands.md)** — every `artisan` command + signature.
- **[reference/data-layer.md](reference/data-layer.md)** — Eloquent models, prefix mechanics, the `jobs` table, config/env.

### Ops
- **[deployment.md](deployment.md)** · **[troubleshooting.md](troubleshooting.md)** · **[integrations.md](integrations.md)**

---

## The one-paragraph mental model

The WordPress plugins write rows into the shared DB and enqueue jobs into **`{prefix}jobs`**; this service's **`queue:work`** worker renders the report **PDFs** (requiring chart images to already exist on disk), and a system cron runs **`schedule:run`** every minute to drive the coupon/credit/email/assessment maintenance commands. The browser also calls this service directly at **`/api/v1/*`** for auth and the Scoring Engine **proxy** (self-assessment responses, needs-complete). This app **owns no schema** — it reads what the plugins create — and **reads (never writes) the `mytemp_settings` WP option** for scoring endpoints and flags.

---

## Cross-repo context (reference by path — docs are not linked across repos)

- **Plugin 1** (`wp-content/plugins/wp-temperament-assessment/`) — enqueues report jobs, owns `mytemp_settings`, and the funnel.
- **Plugin 2** (`wp-content/plugins/wp-affiliates-coupons/`) — the coupon/credit tables these crons operate on; writes `usage_count` (this service never does).
- Project-root `.claude/RULES_AND_FLAGS.md` (flag/rule map) and `.claude/change-logs.md` (running change log).
