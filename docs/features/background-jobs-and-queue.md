# Feature: Background Jobs & Queue

The queue subsystem — a DB-backed job queue in the shared **`{prefix}jobs`** table, driven by a persistent `queue:work` worker. This is how the platform does asynchronous work (report PDFs, async email) without blocking the WordPress request.

## Sections
- [The queue table](#the-queue-table)
- [Dispatching a job](#dispatching-a-job)
- [The worker](#the-worker)
- [Job selection (fetchNext)](#job-selection-fetchnext)
- [Status transitions](#status-transitions)
- [Held / retry](#held--retry)
- [Job classes](#job-classes)
- [Related](#related)

---

## The queue table

Backed by **`{prefix}jobs`** (`wp_xzg4ax8u64_jobs`) — the WP prefix but **no `mytemp_`/`affcp_` sub-prefix**. `JobModel`'s `$table='jobs'`; Eloquent prepends `DB_PREFIX`. Columns: `id`, `job_class`, `payload` (JSON), `attempts`, `status ENUM('pending','processing','completed','failed','held')`, `available_at`, `reserved_at`, `completed_at`, `failed_at`.

Both WordPress plugins and this service write rows here; only this service's worker consumes them.

---

## Dispatching a job

- **From the API:** `Queue::dispatch(JobClass::class, ['assessment_id' => $id])` (`app/Core/Queue.php`) inserts a `pending` row and returns the `JobModel`.
- **From WordPress:** the plugins `INSERT` directly (e.g. Plugin 1's `mytemp_trigger_generate_report_job` writes `job_class='\App\Jobs\GenerateReportJob'`).

The `job_class` is a fully-qualified API class name; the worker instantiates it and calls `handle($payload)`.

---

## The worker

`QueueWorkerCommand` (`app/Console/QueueWorkerCommand.php`, signature **`queue:work`**) is an **infinite loop**:
1. `Queue::fetchNext()`.
2. If a job: decode `payload`, `(new $job->job_class())->handle($payload)`, then `markCompleted()`. Catch `ChartImagesMissingException` → `markHeld()`; catch any other `\Throwable` → `markFailed()`.
3. If no job: `usleep(500000)` (~0.5s) and poll again.

**It must run as a persistent process** (systemd / Supervisor / cPanel). Without it, nothing async happens — most visibly, **no PDF is generated**. Restart it after a deploy so it loads new job code.

---

## Job selection (fetchNext)

`Queue::fetchNext()` selects the next runnable job:
- `status IN ('pending','held')`
- **and** (`available_at IS NULL` **or** `available_at <= now`) — so a `held` job only becomes runnable once its hold window has elapsed.
- Increments `attempts` and sets `reserved_at` when it takes the job.

---

## Status transitions

```
dispatch ─▶ pending ─(fetchNext/run)─▶ (running) ─▶ completed
                                          │
                                          ├─ ChartImagesMissingException ─▶ held ──(available_at due)──▶ pending-like (re-fetched)
                                          └─ other Throwable ─────────────▶ failed
```

`markCompleted()` sets `status='completed'` + `completed_at`; `markFailed()` sets `status='failed'` + `failed_at`; `markHeld()` sets `status='held'`, `available_at = now + N hours`, `reserved_at = null`.

---

## Held / retry

`held` is **not a failure** — it means "not ready yet." The only current use is the report job when **chart images are missing**: the job holds for a retry window (N hours). It is **released early** when the charts appear — Plugin 1's `mytemp_release_held_report_jobs()` sets `available_at = now`, so the next `fetchNext()` picks it up. See [report-generation.md](report-generation.md#the-chart-image-gate--heldretry).

---

## Job classes (`app/Jobs/`)

| Class | Purpose |
|---|---|
| `GenerateReportJob` | Personal (+ inline manager) report PDF — see [report-generation.md](report-generation.md) |
| `GenerateManagerReportJob` | Manager report PDF(s) for an assessment (all versions) |
| `SendEmailJob` | Asynchronous email send — see [emails.md](emails.md) |

Each implements `App\Core\JobInterface` (a `handle(array $data)` method).

---

## Related

- [report-generation.md](report-generation.md) — the main queue consumer
- [scheduled-commands.md](scheduled-commands.md) — `assessments:generate-report` also enqueues jobs
- [reference/commands.md](../reference/commands.md) · [reference/data-layer.md](../reference/data-layer.md)
