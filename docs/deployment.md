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

- **Production** runs on **cPanel hosting** (EasyApache, `ea-php82`) with Apache + MySQL. `.user.ini` is cPanel-generated — don't hand-edit it.
- **Target PHP is 8.2** in production (also must run on 8.3/8.4/8.5).
- Three independent git repos plus the external Scoring Engine; the WordPress root itself is **not** a git repo.

---

## The deploy process

SSH into the server and `git pull` in each affected repo:

```bash
cd api && git pull
# if composer.json changed:
composer install --no-dev
```

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
- **`.env` sane** for the environment (`APP_ENV`, DB, `JWT_SECRET`, scoring keys) — never assume local values.
- **`usage_count` backfill:** run `php artisan coupons:resync-usage-count` once after a deploy that touched coupon counting.
- **Smoke:** a completed assessment produces a PDF (`assessments/pdf/`, `pdf_status=1`).

---

## Related

- [setup.md](setup.md) · [features/background-jobs-and-queue.md](features/background-jobs-and-queue.md) · [features/scheduled-commands.md](features/scheduled-commands.md) · [troubleshooting.md](troubleshooting.md)
- Project-root `.claude/change-logs.md`
