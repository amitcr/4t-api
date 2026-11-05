# Deployment

How the API service reaches production. There is **no CI or deploy script** — deployment is a manual `git pull`, plus keeping two processes alive.

## Sections
- [Environments](#environments)
- [The deploy process](#the-deploy-process)
- [Git & branches](#git--branches)
- [Processes (queue worker + cron)](#processes-queue-worker--cron)
- [No schema management here](#no-schema-management-here)
- [Post-deploy checks](#post-deploy-checks)
- [Related](#related)

---

## Environments

- **Production** runs on **cPanel hosting** (EasyApache) with Apache + MySQL. `.user.ini` is cPanel-generated — don't hand-edit it.
- **Target PHP is 8.5** (`ea-php85`). The PHP 8.5 release moves production straight from `ea-php82`; the locked vendor (`config.platform.php` = 8.5.0) does not run on 8.2, so code, vendor and PHP version always move together. The step-by-step cut-over and rollback are in the PHP 8.5 runbook (https://claude.ai/artifact/YMh6a1ewvHiAqJ4z1bbh2T).
- Four git repos (`api/`, `wp-temperament-assessment`, `wp-affiliates-coupons`, `ft-mailjet-pro`) plus the external Scoring Engine; the WordPress root itself is **not** a git repo.

---

## The deploy process

SSH into the server and `git pull` in each affected repo:

```bash
cd api && git pull
# whenever composer.json / composer.lock changed (always on the PHP 8.5 release):
composer install --no-dev --optimize-autoloader --no-interaction
cp <backup>/proxima_* vendor/tecnickcom/tcpdf/fonts/   # custom PDF fonts; a fresh TCPDF folder lacks them
systemctl restart ft-queue-worker                       # the worker keeps old code in memory
```

- **`composer.lock` is tracked in git** (api, P1 and `ft-mailjet-pro`). Always `install` from it on a server — **never `composer update`**, and never `--ignore-platform-req`. The first pull after the lock became tracked fails on the server's old untracked copy: move it aside (`mv composer.lock composer.lock.pre-php85`) before pulling.
- **P1 and `ft-mailjet-pro` deploy together** and each runs its own `composer install --no-dev`: both ship Mailjet + Guzzle, and the last-registered autoloader wins at runtime, so an old/new mix breaks Mailjet calls.
- The 25 `proxima_*` fonts in `vendor/tecnickcom/tcpdf/fonts/` are not part of the package. Back them up before a vendor rebuild and copy them back after (84 font `.php` files in total).

A change spanning the API and a plugin is **two commits in two repos**.

---

## Git & branches

Each of the three repos follows the same branching model:

- **`main`** — the **production** branch (what the live site pulls).
- **`staging`** — the **integration/testing** branch; validated before production.
- **`feature/<feature-name>`** — every feature/fix gets its own branch, cut from `staging`, merged back for testing, then promoted to `main`.

Workflow: `feature/<name>` → `staging` (test) → `main` (deploy). Commit/push only when asked; never commit directly to `staging`/`main`.

---

## Processes (queue worker + cron)

After deploy, confirm the two long-running pieces are alive (they are what make the service actually *do* things):
- **`php artisan queue:work`** as a persistent process (systemd / Supervisor / cPanel). Restart it after a deploy so it picks up new job code. **Without it, no PDF generates.**
- **System cron** invoking **`php artisan schedule:run` every minute** — the only crontab entry needed (all WP-side crons were migrated here).

---

## No schema management here

There are **no migrations.** Schema changes are made in the plugin that owns the table (with a plugin version bump so `dbDelta` runs); this service just reads the columns. After such a change, update the relevant Eloquent model's `$fillable`/casts.

---

## Post-deploy checks

- **Worker restarted** and processing (`api/logs/`, `{prefix}jobs` draining).
- **Cron running** `schedule:run` (check due commands executed in `api/logs/`).
- **`.env` sane** for the environment (`APP_ENV`, DB, `JWT_SECRET`, scoring keys) — never assume local values. Production must be `APP_ENV=production`: `local` redirects every API email to `APP_EMAIL` and prints PHP errors into responses.
- **Clean JSON:** `curl -s https://<domain>/api/v1/health | head -c 1` prints `{` (no `<br />` / `Deprecated` in front).
- **Credit ledger table:** `affcp_credit_ledger` is created by Plugin 2 on the first **wp-admin** page load after deploy. Load wp-admin before restarting the crons: the credit crons cannot post without it.
- **Ledger check:** `php artisan credits:reconcile` reports 0 differences.
- **`usage_count` backfill:** run `php artisan coupons:resync-usage-count` once after a deploy that touched coupon counting.
- **Smoke:** a completed assessment produces a PDF (`assessments/pdf/`, `pdf_status=1`).

---

## Related

- [setup.md](setup.md) · [features/background-jobs-and-queue.md](features/background-jobs-and-queue.md) · [features/scheduled-commands.md](features/scheduled-commands.md) · [troubleshooting.md](troubleshooting.md)
- Project-root `.claude/change-logs.md`
