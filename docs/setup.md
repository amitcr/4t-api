# Setup

How to install and run the API service, and its runtime requirements. Unlike the plugins, this service needs **two long-running processes** (a queue worker and a system cron).

## Sections
- [Requirements](#requirements)
- [Install](#install)
- [The `.env` file](#the-env-file)
- [Running it](#running-it)
- [The two processes you must keep alive](#the-two-processes-you-must-keep-alive)
- [`APP_ENV` changes behavior](#app_env-changes-behavior)
- [Tests](#tests)
- [Related](#related)

---

## Requirements

A **standard PHP + MySQL host** (production is cPanel/EasyApache, Apache + MySQL), plus a process manager for the worker and a system cron:

| Requirement | Supported |
|---|---|
| **PHP** | **8.2 minimum** (production baseline); must also run on **8.3, 8.4, 8.5**. No dynamic (undeclared) object properties. |
| **Database** | **MySQL 5.7+** or **MariaDB 10.3+** — the **same** DB the WordPress plugins use, with the same WordPress table prefix (`{prefix}` in these docs). |
| **Web server** | **Apache** (production; ships `public/.htaccess` rewriting `/api/*` → `public/index.php`). **Nginx** / **LiteSpeed** need the equivalent rewrite. |
| **Operating system** | Any mainstream **Linux** (Ubuntu, Debian, AlmaLinux, Rocky, CentOS); Windows/macOS for dev. |
| **Composer** | Required. |

**Required PHP extensions:** `pdo_mysql`/`mysqli`, `curl` (Guzzle / Scoring Engine / Stripe / Mailjet / AWS SES / Google), `json`, `mbstring`, `openssl` (JWT + `WpCryptoService`), `gd` + `dom`/`libxml` (html2pdf), `fileinfo`, `zip`. `bcmath` recommended for the payment SDKs.

---

## Install

From the `api/` directory:

```bash
composer install
```

`vendor/`, `composer.lock`, `.env`, `*.log`, and `credentials.json` are **gitignored** — provisioned on the server, not committed. There is **no build step** and **no migrations** (this app owns no schema).

---

## The `.env` file

Loaded via `phpdotenv` (with a simple fallback loader in `bootstrap.php`). Holds:
- **DB creds** (`DB_*`, incl. `DB_PREFIX` — must match the WordPress `$table_prefix` in `wp-config.php`).
- **`JWT_SECRET`** (a default fallback exists if unset — production must set a real one).
- **`APP_ENV`**, **`APP_EMAIL`**, mail driver.
- **Scoring / GraphQL keys** (`GRAPHQL_PROD_APP_ID/_API_KEY`, `GRAPHQL_STAGING_APP_ID/_API_KEY`).
- Google `credentials.json` for the stats export.

Config files (`config/app.php`, `database.php`, `mailer.php`, `scoring.php`, `graphql.php`) read mostly from env via `getenv()`. **The scoring/GraphQL *endpoints* and `staging_mode` come from the WP `mytemp_settings` option, not `.env`** — this app reads them.

---

## Running it

```bash
php artisan list                          # list registered commands
php artisan schedule:run                  # run all due scheduled tasks once
php artisan queue:work                    # start the queue worker (keep running)

php artisan assessments:generate-report   # run a single command manually
php artisan coupons:expire-status
```

The HTTP API is served by Apache from `public/` at the `/api/` path.

---

## The two processes you must keep alive

Unique to this repo (the plugins don't need these):
- **`php artisan queue:work`** as a **persistent process** (systemd / Supervisor / a cPanel long-running task). **Without it, no PDF is ever generated.** It loops, polling the `{prefix}jobs` table every ~500ms.
- **System cron** invoking **`php artisan schedule:run` every minute** — the single entry point for all scheduled work.

---

## `APP_ENV` changes behavior

**`APP_ENV=local`/`staging` changes runtime behavior, not just values:** all outbound email is redirected to `APP_EMAIL`, temp-user emails use a staging host, and the abandoned-followup window widens to ~365 days instead of the production 60–70 minutes. Confirm `APP_ENV` before reasoning about email or timing.

---

## Tests

There is **no automated test suite** in this repo. Verify via the funnel + running the commands manually.

---

## Related

- [architecture.md](architecture.md) · [coding-standards.md](coding-standards.md) · [deployment.md](deployment.md) · [integrations.md](integrations.md)
