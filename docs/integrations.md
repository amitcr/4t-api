# Integrations

Every external system the API talks to, documented **once**. Cross-repo counterparts are given by **path only** (docs are not linked across repos).

## Contents
- [Scoring Engine (GraphQL)](#scoring-engine-graphql)
- [The WordPress plugins & shared DB](#the-wordpress-plugins--shared-db)
- [Stripe](#stripe)
- [Email — SES / SMTP / Mailjet](#email--ses--smtp--mailjet)
- [Google Sheets](#google-sheets)
- [Shared crypto with the plugins](#shared-crypto-with-the-plugins)
- [Where the credentials live](#where-the-credentials-live)

---

## Scoring Engine (GraphQL)

The external Scoring Engine holds all answers and computes DISC results. This service brokers two flows:
- **Browser → API proxy → engine:** the participant funnel posts high-frequency writes (self-assessment responses, `questionsCompleted`, needs-complete) to `/api/v1/scoring-engine/*`, which this service proxies to the engine. See [features/scoring-engine-proxy.md](features/scoring-engine-proxy.md).
- **Server-side → engine:** report generation fetches the result snapshot from the engine.

- **Active client:** `Services/Http/BaseGraphQLService.php` — single connection manager, 30s cURL timeout. **Endpoint** URL comes from the WP `mytemp_settings` option (`graphql_endpoint_production` / `_staging`, selected by `staging_mode`); **credentials** (`x-app-id`, `x-api-key`) come from `.env` via `config/graphql.php`. Returns the decoded `data` object or `null` (`getLastError()` for the message).
- **Legacy:** the REST `BaseHttpService.php` — comments state all methods now use GraphQL. Use GraphQL for new work.
- **Resources:** `Services/Api/*Service.php` — one per engine resource (surveys, sections, questions, choices, responses, results, overrides, ratings, graders, patterns, participants, sessions, editions, validation).

---

## The WordPress plugins & shared DB

This service **shares the WordPress MySQL DB** and coordinates with both plugins:
- **Plugin 1** (`wp-content/plugins/wp-temperament-assessment/`) — enqueues report jobs into `{prefix}jobs`; owns `mytemp_settings` (this service reads it, never writes); on the WP side, `mytemp_release_held_report_jobs()` releases a `held` job early when charts appear.
- **Plugin 2** (`wp-content/plugins/wp-affiliates-coupons/`) — owns the `affcp_*` coupon/credit tables the credit crons operate on. **Plugin 2 owns the `usage_count` cache — this service never writes it** (it reads it and calls the resync command). See [features/coupons-and-credits.md](features/coupons-and-credits.md).

The API owns **no schema** — see [reference/data-layer.md](reference/data-layer.md).

---

## Stripe

The Stripe SDK is used within the credit/commission crons and services (transfers/charges tie into the coupon credit flow). The participant-facing payment capture is on the WordPress side; the API's Stripe usage is for the recurring credit operations. Keys via `.env`.

---

## Email — SES / SMTP / Mailjet

- Transactional email is sent through **`Core/Mail`** (`Mail`, `MailManager`, SES/SMTP mailers) configured by `config/mailer.php`; templates in `resources/views/mail/`.
- **AWS SES** (AWS SDK) is the production transport option; SMTP is available.
- **Mailjet** — `MailjetService` + `Services/Mailjet/*` manage contacts/lists.
- `SendEmailJob` sends email asynchronously via the queue. See [features/emails.md](features/emails.md).
- On `APP_ENV=local`/`staging` all outbound mail is redirected to `APP_EMAIL`.

---

## Google Sheets

`GoogleSheetsService` exports assessment stats to Google Sheets (the `assessments:sync-stats` command), authenticated via `credentials.json` (gitignored).

---

## Shared crypto with the plugins

`Services/Crypto/WpCryptoService` must stay **byte-compatible** with the WordPress plugin crypto (`class-crypto.php`) — they exchange encrypted values across the shared DB. `PasswordHashService` mirrors WordPress phpass so tokens/credentials interoperate. Keep both sides in sync if you change either.

---

## Where the credentials live

- **`.env`** — DB, `JWT_SECRET`, `APP_ENV`, `APP_EMAIL`, mail driver, scoring/GraphQL keys.
- **`credentials.json`** — Google service account.
- **`mytemp_settings`** WP option — scoring/GraphQL **endpoints**, `staging_mode` (read-only here).
All are environment-specific; never assume local values apply to production.

---

## Related

- [features/scoring-engine-proxy.md](features/scoring-engine-proxy.md) · [features/report-generation.md](features/report-generation.md) · [features/emails.md](features/emails.md) · [reference/data-layer.md](reference/data-layer.md)
