# Reference: Data Layer

How the API reads and writes the **shared WordPress database**. This service **owns no schema** — there are no migrations here; it maps Eloquent models onto tables the WordPress plugins create.

## Sections
- [Eloquent on a custom framework](#eloquent-on-a-custom-framework)
- [Prefix mechanics](#prefix-mechanics)
- [The queue table](#the-queue-table)
- [Models](#models)
- [WordPress settings are read-only](#wordpress-settings-are-read-only)
- [Config files](#config-files)
- [Changing a column](#changing-a-column)
- [Related](#related)

---

## Eloquent on a custom framework

- The ORM is **`illuminate/database`** (Eloquent query builder / models) — the one real framework piece besides `illuminate/http`. There is **no** service container, migrations, or relationship magic beyond what's hand-written.
- `Core\DB` (`DB::init()` at boot) configures the Eloquent connection from `config/database.php` (env-backed), including the table **prefix**.
- Models in `app/Models/` extend `BaseModel`.

---

## Prefix mechanics (important)

Models declare `$table` **without** the WordPress prefix; Eloquent's connection `prefix` (`DB_PREFIX=wp_xzg4ax8u64_`) prepends it at query time:
- `AssessmentModel`'s `$table = 'mytemp_assessments'` → `wp_xzg4ax8u64_mytemp_assessments`.
- `JobModel`'s `$table = 'jobs'` → `wp_xzg4ax8u64_jobs`.
- Plugin 2 tables carry their own sub-prefix in `$table` (`affcp_wp_*` / `affcp_*`).

The `// NO prefix here!` comments mean **"don't hardcode the prefix,"** not that the table is unprefixed.

---

## The queue table

`{prefix}jobs` (`wp_xzg4ax8u64_jobs`) — the WP prefix but **no `mytemp_`/`affcp_` sub-prefix**. `JobModel`'s `$table='jobs'`. Columns: `id`, `job_class`, `payload`, `attempts`, `status`, `available_at`, `reserved_at`, `completed_at`, `failed_at`. See [../features/background-jobs-and-queue.md](../features/background-jobs-and-queue.md).

---

## Models (`app/Models/`)

Grouped by owning plugin (columns are defined in that plugin's `docs/`, path only):

**Plugin 1 tables (`mytemp_*`):** `AssessmentModel`, `ParticipantModel`, `AssessmentPaymentModel`, `AssessmentReviewModel`, `TransactionModel`, `PaymentMethodModel`, `TestingReportModel`, `TestingEntryModel`, `VariationModel`.

**Plugin 2 tables (`affcp_*` / `affcp_wp_*`):** `CouponModel`, `CouponTrackingModel`, `CouponDetailModel`, `CouponManagerModel`, `AffiliateModel`, `CompanyModel`, `AssessmentRelationshipModel`.

**WordPress core:** `UserModel`, `UserMetaModel`, `OptionsModel`, `PostModel`.

**Queue / infra:** `JobModel`, `OffloadSESModel`.

Relationships are hand-written on the models (e.g. `AssessmentModel::with('user','payment')`, `CouponModel::with('affiliate','company')`, `CouponManagerModel::with('user')`).

---

## WordPress settings are read-only

`OptionsModel` reads `wp_xzg4ax8u64_options`. Runtime settings — scoring/GraphQL **endpoints**, `staging_mode`, page IDs — live in the **`mytemp_settings`** option, **owned and written by the Plugin 1 admin UI**. The API **reads** them (e.g. `BaseGraphQLService` resolves its endpoint from here) and **must never write them**.

---

## Config files (`config/`)

| File | Reads | Purpose |
|---|---|---|
| `app.php` | `APP_ENV`, `APP_EMAIL`, … | App/env, email redirection flag |
| `database.php` | `DB_*`, `DB_PREFIX` | Eloquent connection + prefix |
| `mailer.php` | mail driver / SES / SMTP | `Core/Mail` transport |
| `scoring.php` | scoring retry/timeout | REST scoring config (legacy) |
| `graphql.php` | `GRAPHQL_*` app-id/api-key | GraphQL credentials (endpoint comes from `mytemp_settings`) |

Most read from env via `getenv()`; `.env` is gitignored and provisioned per environment.

---

## Changing a column

There are **no migrations here.** To use a new column:
1. Add it in the **plugin that owns the table** (edit its `class-*-db.php` + bump that plugin's version so `dbDelta` runs) — see the plugin docs.
2. Add the column to the relevant model's `$fillable` / casts here.
3. Never `ALTER` from the API.

---

## Related

- [../architecture.md](../architecture.md#data-layer) · [../features/background-jobs-and-queue.md](../features/background-jobs-and-queue.md) · [../integrations.md](../integrations.md)
- Column definitions: the plugin `docs/` (`wp-temperament-assessment/docs/`, `wp-affiliates-coupons/docs/`, path only)
