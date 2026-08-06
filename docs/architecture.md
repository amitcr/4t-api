# Architecture

How the API service is structured and boots. **The most important thing to understand: it looks like Laravel but is a hand-rolled framework.** Read the relevant `app/Core/*` class before assuming any method exists.

## Sections
- [What this is (and isn't)](#what-this-is-and-isnt)
- [Directory layout](#directory-layout)
- [HTTP request lifecycle](#http-request-lifecycle)
- [CLI lifecycle](#cli-lifecycle)
- [Core primitives](#core-primitives)
- [Data layer](#data-layer)
- [Services](#services)
- [Owns no schema](#owns-no-schema)
- [Related](#related)

---

## What this is (and isn't)

- It **looks like Laravel but is a custom framework.** There is **no service container, no Facades, no `php artisan make:*`, no migrations, no Eloquent relationship magic beyond what's hand-written.**
- The only real third-party framework pieces are **`illuminate/database`** (Eloquent query builder / models) and **`illuminate/http`** (HTTP client), plus libraries: Guzzle, Stripe SDK, AWS SDK (SES), `spipu/html2pdf`, Mailjet SDK, Google API client, `phpdotenv`. See `composer.json`.
- **Always read the relevant `app/Core/*` class before assuming a method exists.** Do not assume Laravel behavior.
- **Autoload:** PSR-4 `App\` → `app/`, via `bootstrap.php` (falls back to a manual loader if `vendor/` is absent). Global helpers in `app/Helpers/helpers.php`.

---

## Directory layout

```
api/
├── artisan                 # CLI entry (~20 lines) → public/app.php → Console\Kernel
├── bootstrap.php           # PSR-4 autoload (App\ → app/) + simple .env fallback loader
├── composer.json           # deps + PSR-4 autoload + helpers.php files-autoload
├── public/
│   ├── index.php           # HTTP entry: bootstrap → DB::init → Mail::init → routes → dispatch
│   ├── app.php             # shared CLI bootstrap (used by artisan)
│   └── .htaccess           # Apache rewrite → index.php
├── config/                 # app.php, database.php, mailer.php, scoring.php, graphql.php
├── app/
│   ├── Core/               # THE FRAMEWORK: Router, Request, Response, DB, Queue, Config, Logger,
│   │                       #   CronKernel, Schedule, ScheduleTask, CronExpression, Controller,
│   │                       #   Mail/, JobInterface, CommandInterface, ChartImagesMissingException
│   ├── Controllers/        # HTTP controllers (+ ScoringEngine/ subgroup = proxy controllers)
│   ├── Models/             # Eloquent models (map to wp_xzg4ax8u64_* tables)
│   ├── Middleware/         # Cors, Jwt, RateLimit (+ MiddlewareInterface)
│   ├── Services/           # business logic + outbound integrations
│   ├── Jobs/               # queue job classes (GenerateReportJob, GenerateManagerReportJob, SendEmailJob)
│   ├── Console/            # Kernel.php (schedule), QueueWorkerCommand, Commands/
│   ├── Helpers/helpers.php # global helpers (auto-loaded)
│   ├── Support/            # FileCache, ApcuCache, CacheInterface, Helpers
│   ├── Traits/             # JsonResponseTrait, SingletonTrait
│   └── routes.php          # ALL routes (/v1 group)
└── resources/views/        # PDF report templates + mail/ email templates
```

---

## HTTP request lifecycle

1. Apache rewrites `/api/*` → `public/index.php`.
2. `index.php` requires `bootstrap.php` (autoload + env), loads `.env` via `phpdotenv`, calls `DB::init()` and `Mail::init()`.
3. Builds a `Core\Request`, instantiates `Core\Router`, then `require app/routes.php`.
4. `$router->dispatch()` matches the route, runs its middleware chain, calls the controller, emits a JSON response.

All routes live in **`app/routes.php`** under a `/v1` group (full base `/api/v1`). Route groups accept `prefix`, `controller`, and `middleware` keys. A stub `/v2` group exists. Full map: [reference/routes.md](reference/routes.md).

---

## CLI lifecycle

`artisan` (~20 lines) → `public/app.php` (shared bootstrap) → **`Console\Kernel`** (extends `Core\CronKernel`). The Kernel's `commands()` registers command classes (each with a `$signature`); `schedule()` defines the cron timetable. Entry points:
- `php artisan schedule:run` — run all due scheduled tasks once (driven by system cron every minute).
- `php artisan queue:work` — the persistent queue worker.
- `php artisan list` — list registered commands.

See [features/scheduled-commands.md](features/scheduled-commands.md) and [features/background-jobs-and-queue.md](features/background-jobs-and-queue.md).

---

## Core primitives (`app/Core/`)

| Class | Role |
|---|---|
| `Router` / `Request` / `Response` | HTTP routing + request/response objects |
| `DB` | Boots Eloquent (`illuminate/database`) with the shared connection + `DB_PREFIX` |
| `Queue` | The `{prefix}jobs` queue: `dispatch`, `fetchNext`, `markCompleted/Failed/Held` |
| `CronKernel` / `Schedule` / `ScheduleTask` / `CronExpression` | The cron system |
| `Mail/` (`Mail`, `MailManager`, SES/SMTP mailers) | Outbound email |
| `Config` | `config/*` accessor (env-backed) |
| `Logger` | Writes to `api/logs/` |
| `JobInterface` / `CommandInterface` / `MiddlewareInterface` | Contracts |
| `ChartImagesMissingException` | Signals a report job to **hold** (charts not ready) |

---

## Data layer

- Eloquent models in `app/Models/` extend `BaseModel`. Table names map to `wp_xzg4ax8u64_*`; the prefix is applied via the connection (`DB_PREFIX`), so a model's `$table` may look unprefixed.
- **The queue table is `{prefix}jobs`** (`wp_xzg4ax8u64_jobs`): `JobModel`'s `$table='jobs'` + the connection prefix — it just lacks the `mytemp_`/`affcp_` sub-prefix. The `// NO prefix here!` comments mean "don't hardcode the prefix," **not** that the table is unprefixed.
- `OptionsModel` reads WordPress `wp_xzg4ax8u64_options`; runtime settings (scoring/GraphQL endpoints, `staging_mode`) live in the `mytemp_settings` option, **written by the WP plugin admin UI — the API only reads them.**

Full detail: [reference/data-layer.md](reference/data-layer.md).

---

## Services (`app/Services/`)

Business logic and outbound clients:
- **Scoring Engine** — `Services/Http/BaseGraphQLService.php` (the active path) + `Services/Api/*Service.php` (one per resource). The REST `BaseHttpService.php` is legacy. See [features/scoring-engine-proxy.md](features/scoring-engine-proxy.md).
- **Reports** — `AssessmentReportService`, `ChartService`. See [features/report-generation.md](features/report-generation.md).
- **Email** — `MailjetService` + `Services/Mailjet/*`, plus SMTP/SES via `Core/Mail`.
- **Auth/crypto** — `JwtService`, `PasswordHashService` (WP phpass-compatible), `Services/Crypto/WpCryptoService` (matches the plugin crypto).
- **Other** — `GoogleSheetsService` (stats export).

---

## Owns no schema

There are **no migrations here.** The API only reads/writes tables the WordPress plugins create. See [reference/data-layer.md](reference/data-layer.md) and the plugin `docs/` for column definitions (path reference only).

---

## Related

- [setup.md](setup.md) · [coding-standards.md](coding-standards.md) · [reference/data-layer.md](reference/data-layer.md) · [integrations.md](integrations.md)
