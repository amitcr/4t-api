# 4t-api — Codebase Guide

The backend service for the Four Temperaments assessment platform. It exposes an HTTP JSON API, runs the scheduled jobs/crons, generates PDF reports, and brokers all communication with the external Scoring Engine.

This is its own git repository, deployed to the `api/` subdirectory of the WordPress docroot. It **shares the WordPress MySQL database** (table prefix `wp_xzg4ax8u64_`) with the two WordPress plugins.

---

## 1. What this is (and isn't)

- It **looks like Laravel but is a hand-rolled framework.** There is **no service container, no Facades, no `php artisan make:*`, no migrations, no Eloquent relationships magic beyond what's hand-written.**
- The only real third-party framework pieces are `illuminate/database` (Eloquent query builder / models) and `illuminate/http` (HTTP client), plus libraries: Guzzle, Stripe SDK, AWS SDK (SES), `spipu/html2pdf`, Mailjet SDK, Google API client, `phpdotenv`. See `composer.json`.
- **Always read the relevant `app/Core/*` class before assuming a method exists.** Do not assume Laravel behavior.

---

## 2. Directory layout

```
api/
├── artisan                 # CLI entrypoint (~20 lines) → public/app.php → Console\Kernel
├── bootstrap.php           # autoload (PSR-4 App\ → app/) + simple .env fallback loader
├── composer.json           # deps + PSR-4 autoload + helpers.php files-autoload
├── public/
│   ├── index.php           # HTTP entrypoint: bootstrap → DB::init → Mail::init → routes → dispatch
│   ├── app.php             # shared CLI bootstrap (used by artisan)
│   └── .htaccess           # Apache rewrite → index.php
├── config/                 # app.php, database.php, mailer.php, scoring.php, graphql.php
├── app/
│   ├── Core/               # the framework: Router, Request, Response, DB, Queue, Config,
│   │                       #   Logger, CronKernel, Schedule, ScheduleTask, CronExpression,
│   │                       #   Controller, Mail/, JobInterface, CommandInterface, JsonToObjectCast
│   ├── Controllers/        # HTTP controllers (+ ScoringEngine/ subgroup = proxy controllers)
│   ├── Models/             # Eloquent models (map to wp_xzg4ax8u64_* tables)
│   ├── Middleware/         # Cors, Jwt, RateLimit (+ MiddlewareInterface)
│   ├── Services/           # business logic + outbound integrations (see §6)
│   ├── Jobs/               # queue job classes
│   ├── Console/            # Kernel.php (schedule), QueueWorkerCommand, Commands/
│   ├── Helpers/helpers.php # global helper functions (auto-loaded)
│   ├── Support/            # FileCache, ApcuCache, CacheInterface, Helpers
│   └── Traits/             # JsonResponseTrait, SingletonTrait
└── resources/views/        # PDF report templates + mail/ email templates
```

---

## 3. Request lifecycle (HTTP)

1. Apache rewrites `/api/*` to `public/index.php`.
2. `index.php` requires `bootstrap.php` (autoload + env), loads `.env` via `phpdotenv`, calls `DB::init()` and `Mail::init()`.
3. Builds a `Core\Request`, instantiates `Core\Router`, then `require app/routes.php`.
4. `$router->dispatch()` matches the route, runs its middleware chain, calls the controller, and emits a JSON response.

**All routes live in `app/routes.php`.** They are grouped under `/v1` (full base path `/api/v1`). Route groups accept `prefix`, `controller`, and `middleware` keys. A stub `/v2` group exists for the future.

### Route map (v1)

| Area | Routes | Notes |
|---|---|---|
| Health | `GET /health` | Only route with `RateLimitMiddleware` |
| Auth | `POST /auth/login`, `/auth/temporary-registration`, `/auth/refresh`; `POST /auth/logout`, `GET /auth/me` (JWT) | JWT issued here |
| Assessments | `POST /assessments/validate` (JWT); `GET/POST /assessments`, `GET/PUT/DELETE /assessments/{id}` | |
| Jobs | `GET/POST /jobs`, `GET/PUT/DELETE /jobs/{id}` | Queue table CRUD |
| Participants | `GET/POST/PUT/PATCH/DELETE /participants[/{id}]` | |
| Participant sessions | `GET/POST/PUT/DELETE /participant-sessions[/{id}]` | |
| Scoring Engine proxy | `/scoring-engine/*` | Proxies participants, sessions, self-assessment responses, `POST /needs-assessment-complete` |

---

## 4. Middleware

- **`JwtMiddleware`** — validates `Authorization: Bearer` (HS256), attaches decoded payload to `$request->tokendata`. Returns 401 on failure.
- **`CorsMiddleware`** — applied to the whole v1 group. Currently `Access-Control-Allow-Origin: *`.
- **`RateLimitMiddleware`** — 120 req/min/IP, file-cache backed. Currently wired to `/health` only.

---

## 5. Data layer

- Eloquent models in `app/Models/` extend `BaseModel`. Table names map to `wp_xzg4ax8u64_*`; the prefix is applied via config, so a model's `$table` may look unprefixed.
- **The queue table is `{prefix}jobs`** (`wp_xzg4ax8u64_jobs`): `JobModel`'s `$table='jobs'` + the connection prefix. It just lacks the `mytemp_` sub-prefix the other tables carry — see Appendix B. (The `// NO prefix here!` comment means "don't hardcode the prefix," not that the table is unprefixed.)
- Key models: `ParticipantModel`, `AssessmentModel`, `AssessmentPaymentModel`, `AssessmentRelationshipModel`, `AssessmentReviewModel`, `CouponModel`, `CouponTrackingModel`, `CouponDetailModel`, `CouponManagerModel`, `AffiliateModel`, `CompanyModel`, `TransactionModel`, `TestingReportModel`, `TestingEntryModel`, `VariationModel`, `UserModel`, `UserMetaModel`, `OptionsModel`, `PostModel`, `PaymentMethodModel`, `OffloadSESModel`.
- `OptionsModel` reads WordPress `wp_xzg4ax8u64_options`; many runtime settings (including scoring/GraphQL endpoints and `staging_mode`) live in the `mytemp_settings` option, **written by the WP plugin admin UI** — the API reads them, it does not own them.

---

## 6. Services & external integrations

`app/Services/` holds business logic and outbound clients.

- **Scoring Engine — migrating from REST to GraphQL.**
  - `Services/Http/BaseHttpService.php` — the old REST client (Illuminate HTTP, retries/timeout from `config/scoring.php`). Its own comments now state *"all service methods use GraphQL exclusively."*
  - `Services/Http/BaseGraphQLService.php` — **the current path.** Single GraphQL connection manager. Endpoint URL comes from WP settings (`mytemp_settings.graphql_endpoint_production` / `_staging`, selected by `mytemp_settings.staging_mode`); credentials (`x-app-id`, `x-api-key`) come from `.env` via `config/graphql.php`. 30s cURL timeout. Returns the decoded `data` object or `null`; call `getLastError()` for a human-readable message.
  - `Services/Api/*Service.php` — one service per Scoring Engine resource (self/needs assessment surveys, sections, questions, choices, responses, results, overrides, ratings, graders, patterns, participants, sessions, editions, validation surveys/sections).
- **Reports:** `AssessmentReportService` (orchestrates report generation), `ChartService` (chart images).
- **Email:** `MailjetService` + `Services/Mailjet/*` (contacts, lists), plus SMTP/SES via `Core/Mail` and `config/mailer.php`.
- **Other:** `GoogleSheetsService` (stats export), `JwtService`, `PasswordHashService` (WP phpass-compatible), `Services/Crypto/WpCryptoService` (matches the WP plugin's crypto for shared secrets).

---

## 7. Background jobs (queue)

- Backed by the `{prefix}jobs` DB table (`wp_xzg4ax8u64_jobs`). Statuses: `pending → processing → completed / failed / held`.
- Dispatch: `Queue::dispatch(JobClass::class, ['assessment_id' => $id])`.
- Job classes in `app/Jobs/`: `GenerateReportJob`, `GenerateManagerReportJob`, `SendEmailJob`.
- Worker: **`php artisan queue:work`** — infinite loop, polls every ~500ms. **Must be running for any PDF to be produced.** In production it runs as a persistent process; locally you start it by hand.

### `GenerateReportJob` (high level)
Loads assessment + participant + payment → fetches results from Scoring Engine → **requires chart images to already exist** (`assessments/images/chart_{id}.png` and `single_chart_{id}.png`) → renders `resources/views/template-report.php` to PDF via html2pdf → saves under `assessments/pdf/` → conditionally generates manager report and sends emails → sets `pdf_status = 1`.

---

## 8. Scheduled commands (cron)

Defined in **`app/Console/Kernel.php`** (`schedule()` + `commands()`). Each command in `app/Console/Commands/` has a `$signature`. The server runs `php artisan schedule:run` from system cron every minute.

| Signature | Schedule | Purpose |
|---|---|---|
| `emails:coupon-expire-reminder` | daily 16:00 UTC | Coupon expiry reminder emails |
| `emails:auto-recharge-reminder` | every minute | Upcoming auto-charge reminders |
| `coupons:coupon-auto-recharge` | every minute | Auto-recharge prepaid coupons |
| `coupons:expire-status` | daily 06:00 UTC | Validate/expire coupons + reverse unused credits; settle the credit-charged limit (`usage_limit`/`mini_usage_limit`) down to the used count |
| `assessments:abandoned-followup` | every 5 min | Abandoned-assessment Mailjet follow-up |
| `assessments:generate-report` | every minute | Enqueue PDF jobs for finished assessments |
| `assessments:delete-duplicates` | daily 06:00 UTC | Remove duplicate assessments |
| `assessments:sync-stats` | daily 06:05 UTC | Export stats to Google Sheets |
| `coupons:resync-usage-count` | daily 06:10 UTC | Recompute cached `usage_count` from assigned/completed tracking rows (self-healing backfill) |
| `emails:mini-usage-reminder` | daily 16:05 UTC | "Mini report usage running low" email for mini codes near their `mini_usage_views` limit (email only — mini codes are not auto-recharged) |

All WordPress-side cron scripts have been migrated here and removed; the API is the single source for scheduled work. `queue:work` (above) is separate and must also run.

> Files named `opt-*.php` in `Commands/` are in-progress optimized rewrites and are **not registered** in the Kernel — they do not run.

---

## 9. Config & environment

- `config/` reads mostly from env via `getenv()`: `app.php`, `database.php`, `mailer.php`, `scoring.php`, `graphql.php`.
- `.env` holds DB credentials, `JWT_SECRET`, `APP_ENV`, `APP_EMAIL`, mail driver, scoring + GraphQL keys (`GRAPHQL_PROD_APP_ID/_API_KEY`, `GRAPHQL_STAGING_APP_ID/_API_KEY`).
- **`.env`, `vendor/`, `composer.lock`, `*.log`, `credentials.json` are gitignored.** They are provisioned on the server, not committed.
- **`APP_ENV` changes runtime behavior, not just values:** on `local`/`staging` all outbound email is redirected to `APP_EMAIL`, temp-user emails use a staging host, and the abandoned-followup window widens to ~365 days instead of the production 60–70 minutes.

---

## 10. Usage / commands

There is **no automated test suite** and **no build step** in this repo. Run from the `api/` directory:

```bash
composer install                       # install dependencies

php artisan list                       # list registered commands
php artisan schedule:run               # run all due scheduled tasks once
php artisan queue:work                 # start the queue worker (keep running)

php artisan assessments:generate-report   # run a single command manually
php artisan coupons:expire-status
```

The HTTP API is served by Apache from `public/` at the `/api/` path.

---

## 11. Strict rules (do not break)

1. **Never assume Laravel.** Read `app/Core/*` before using any framework-looking method.
2. **The `jobs` table is `{prefix}jobs`** (no `mytemp_` sub-prefix). Models write `$table='jobs'`; don't hardcode the prefix or add a sub-prefix.
3. **Prefer GraphQL for new Scoring Engine work.** `BaseGraphQLService` is the live path; the REST `BaseHttpService` is legacy.
4. **WP settings are read-only here.** Endpoints, `staging_mode`, and similar live in the `mytemp_settings` WP option, owned by the plugin admin UI. Don't write them from the API.
5. **PDF generation is asynchronous and gated.** A row in `jobs` (not a synchronous call) creates the PDF, the worker must be running, and chart images must already exist on disk.
6. **Respect `APP_ENV` semantics** before reasoning about email recipients or abandoned-followup timing.
7. **Never commit secrets.** `.env` / `credentials.json` are environment-specific and gitignored.
8. **Cron timing/scope conditions are business rules.** The exact windows in the `Commands/` (e.g. report min-age gate, abandoned scope) are intentional — do not "simplify" them.

---

## 12. Notes & gotchas

- `display_errors` is currently `1` in `public/index.php` / `public/app.php` — intended to be `0` in production. Verify before relying on it.
- A default `JWT_SECRET` exists as a fallback if the env var is unset — production must set a real one.
- The Scoring Engine retry/timeout config lives in `config/scoring.php`; the GraphQL client uses its own fixed 30s cURL timeout instead.
- Temporary-user auth and password hashing intentionally mirror WordPress (phpass / `WpCryptoService`) so tokens and credentials interoperate with the plugins — keep them in sync if you change either side.
- This service is one of three coordinated repos. The two WordPress plugins (`wp-temperament-assessment`, `wp-affiliates-coupons`) own the user-facing flow and write much of the shared data; cross-check their `docs/` when changing shared tables or hooks.
- **Cross-repo memory (read before new feature work):** the project-root `.claude/change-logs.md` (running log of completed changes) and `.claude/RULES_AND_FLAGS.md` (the consolidated flag/rule/validation map).

---

## Appendix A — File structure

Condensed, annotated (`vendor/`, `logs/` omitted).

```
api/
├── artisan                         # CLI entry (~20 lines) → public/app.php → Console\Kernel
├── bootstrap.php                   # PSR-4 autoload (App\ → app/) + simple .env fallback
├── composer.json / composer.lock   # illuminate/database+http, Guzzle, Stripe, AWS SES, html2pdf, Mailjet, Google
├── .env / credentials.json         # gitignored; provisioned on the server
├── public/
│   ├── index.php                   # HTTP entry → bootstrap → DB/Mail init → routes → dispatch
│   ├── app.php                     # shared CLI bootstrap
│   └── .htaccess                   # Apache rewrite → index.php
├── config/                         # app.php, database.php, mailer.php, scoring.php, graphql.php
├── app/
│   ├── Core/                       # framework: Router, Request, Response, DB, Queue, Config, Logger,
│   │                               #   CronKernel, Schedule, ScheduleTask, CronExpression, Controller,
│   │                               #   Mail/ (Mail, MailManager, SES/SMTP mailers), ChartImagesMissingException
│   ├── Controllers/                # HTTP controllers + ScoringEngine/ (proxy controllers)
│   ├── Models/                     # Eloquent models → wp_xzg4ax8u64_* tables (see Database note)
│   ├── Middleware/                 # Cors, Jwt, RateLimit (+ MiddlewareInterface)
│   ├── Services/
│   │   ├── Api/                    # one service per Scoring Engine resource (self/needs surveys, choices, …)
│   │   ├── Http/                   # BaseGraphQLService (active), BaseHttpService (legacy REST)
│   │   ├── Mailjet/  Crypto/       # Mailjet contacts/lists; WpCryptoService (matches the plugin crypto)
│   │   └── AssessmentReportService, ChartService, GoogleSheetsService, JwtService, PasswordHashService
│   ├── Jobs/                       # GenerateReportJob, GenerateManagerReportJob, SendEmailJob
│   ├── Console/                    # Kernel.php (schedule), QueueWorkerCommand, Commands/
│   ├── Helpers/helpers.php         # global helpers (auto-loaded)
│   ├── Support/                    # FileCache, ApcuCache, CacheInterface, Helpers
│   ├── Traits/                     # JsonResponseTrait, SingletonTrait
│   └── routes.php                  # ALL routes (/v1 group)
└── resources/
    ├── views/                      # template-report.php, template-manager-report.php + mail/ templates
    └── images/                     # report logo + graph base images
```

## Appendix B — Database note (this app owns no schema)

The API only **reads** tables that the two WordPress plugins create. There are no migrations here. **Full column definitions live in the plugin docs:** `wp-temperament-assessment/docs/README.md` (Appendix B) and `wp-affiliates-coupons/docs/README.md` (Appendix B).

**Prefix mechanics (important):** models declare `$table` **without** the WP prefix, and Eloquent's connection `prefix` (`DB_PREFIX=wp_xzg4ax8u64_`) prepends it at query time. So `JobModel`'s `$table='jobs'` resolves to `wp_xzg4ax8u64_jobs`, and `AssessmentModel`'s `$table='mytemp_assessments'` resolves to `wp_xzg4ax8u64_mytemp_assessments`. The `// NO prefix here!` comments in the models mean "don't hardcode the prefix," **not** that the table is unprefixed. The queue table is `{prefix}jobs` — it simply lacks the `mytemp_`/`affcp_` sub-prefix the other tables carry.
