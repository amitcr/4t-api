# Coding Standards & Strict Rules

Rules you must follow when editing the API. Most exist because this is a **custom framework** that mimics Laravel, shares a DB it doesn't own, and coordinates with two WordPress plugins.

## Sections
- [PHP version](#php-version)
- [Never assume Laravel](#never-assume-laravel)
- [The `{prefix}jobs` table](#the-prefixjobs-table)
- [Prefer GraphQL for Scoring Engine work](#prefer-graphql-for-scoring-engine-work)
- [WP settings are read-only here](#wp-settings-are-read-only-here)
- [PDF generation is async and gated](#pdf-generation-is-async-and-gated)
- [`APP_ENV` semantics](#app_env-semantics)
- [Never commit secrets](#never-commit-secrets)
- [Cron timing/scope are business rules](#cron-timingscope-are-business-rules)
- [This app owns no schema](#this-app-owns-no-schema)
- [Related](#related)

---

## PHP version

- **Target PHP 8.2 → 8.5.** Production runs the minimum, 8.2; code must also run cleanly on 8.3/8.4/8.5. No dynamic (undeclared) object properties; avoid the 8.2–8.5 deprecations.

---

## Never assume Laravel

**It looks like Laravel but is a hand-rolled framework.** No service container, no Facades, no `make:*`, no migrations, no relationship magic beyond what's hand-written. **Read the relevant `app/Core/*` class before using any framework-looking method.** Only `illuminate/database` (Eloquent) and `illuminate/http` are real framework pieces.

---

## The `{prefix}jobs` table

The queue table is **`{prefix}jobs`** — it carries the WP prefix but **no `mytemp_`/`affcp_` sub-prefix**. Models declare `$table='jobs'` and Eloquent prepends `DB_PREFIX`. **Don't hardcode the prefix or add a sub-prefix.** The `// NO prefix here!` comments mean "don't hardcode it."

---

## Prefer GraphQL for Scoring Engine work

`Services/Http/BaseGraphQLService.php` is the **live path**; the REST `BaseHttpService.php` is **legacy**. New Scoring Engine work uses GraphQL. See [features/scoring-engine-proxy.md](features/scoring-engine-proxy.md).

---

## WP settings are read-only here

Endpoints, `staging_mode`, page IDs, and similar live in the **`mytemp_settings`** WordPress option, **owned by the Plugin 1 admin UI**. Read them (via `OptionsModel`); **never write them from the API.**

---

## PDF generation is async and gated

A row in **`{prefix}jobs`** (not a synchronous call) creates the PDF; the **worker must be running**; and **chart images must already exist on disk** or the job is `held` and retried. Don't make report generation synchronous. See [features/report-generation.md](features/report-generation.md).

---

## `APP_ENV` semantics

`APP_ENV=local`/`staging` **changes behavior**: outbound email → `APP_EMAIL`, temp-user emails use a staging host, abandoned-followup window widens to ~365 days vs the production 60–70 minutes. Respect it before reasoning about email recipients or timing.

---

## Never commit secrets

`.env`, `credentials.json`, `vendor/`, `composer.lock`, `*.log` are environment-specific and **gitignored** — provisioned on the server.

---

## Cron timing/scope are business rules

The exact windows and scope conditions in `Commands/` (report min-age gate, abandoned scope, credit-reversal branches, usage-count settle rules) are **intentional business rules** — do not "simplify" them. Coordinate credit-semantics changes with Plugin 2 (`wp-affiliates-coupons`). Note: the API **never writes `usage_count`** — Plugin 2 owns that cache. See [features/coupons-and-credits.md](features/coupons-and-credits.md).

---

## This app owns no schema

There are **no migrations.** To use a new column, add it in the plugin that owns the table (bump that plugin's version), then read it here. Keep the Eloquent model's `$fillable`/casts in sync. See [reference/data-layer.md](reference/data-layer.md).

---

## Related

- [architecture.md](architecture.md) · [features/report-generation.md](features/report-generation.md) · [integrations.md](integrations.md)
- Project-root `.claude/RULES_AND_FLAGS.md`
