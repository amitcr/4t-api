# Feature: Report Generation

The end-to-end implementation of turning a finished assessment into a **PDF report**. This is the service's flagship responsibility. It is **asynchronous, queue-driven, and gated on chart images** existing on disk.

## The components that cooperate

| Component | Where | Role |
|---|---|---|
| **WordPress (Plugin 1)** | `wp-content/plugins/wp-temperament-assessment/` (path only) | Enqueues the job row into `{prefix}jobs`; produces the chart PNGs browser-side; releases `held` jobs when charts appear. |
| **API queue worker** | `app/Console/QueueWorkerCommand.php` | The persistent `queue:work` loop that runs the job. |
| **The job** | `app/Jobs/GenerateReportJob.php` (+ `GenerateManagerReportJob.php`) | Loads the assessment and calls the report service. |
| **The report service** | `app/Services/AssessmentReportService.php` (+ `ChartService`) | Builds the PDF(s) from the Scoring Engine snapshot + chart images. |
| **Scoring Engine** | external GraphQL | Supplies the scored result snapshot the report renders. |

## Sections
- [Trigger & enqueue](#trigger--enqueue)
- [The worker picks the job](#the-worker-picks-the-job)
- [GenerateReportJob](#generatereportjob)
- [AssessmentReportService.generateReport()](#assessmentreportservicegeneratereport)
- [The chart-image gate & held/retry](#the-chart-image-gate--heldretry)
- [Manager reports](#manager-reports)
- [Versioned validated / manager PDFs](#versioned-validated--manager-pdfs)
- [Emails on generation](#emails-on-generation)
- [Outputs & state](#outputs--state)
- [Complete sequence](#complete-sequence)
- [Related](#related)

---

## Trigger & enqueue

Report generation starts **outside** this service: on payment/finish, Plugin 1 inserts a row into the shared **`{prefix}jobs`** table (`job_class = '\App\Jobs\GenerateReportJob'`, `status='pending'`, payload `{assessment_id, [override, review_id]}`). A validated/override run carries `override:true` + `review_id`; manager reports use `\App\Jobs\GenerateManagerReportJob`.

Additionally, the scheduled command **`assessments:generate-report`** (`GenerateAssessmentReport`, every minute) sweeps for `finished` assessments with `pdf_status=0` (older than a min-age gate) whose charts exist and enqueues jobs for them — a safety net for missed triggers.

---

## The worker picks the job

`QueueWorkerCommand` (`queue:work`) loops forever, `usleep(500000)` (~0.5s) between polls:
1. `Queue::fetchNext()` — selects the next runnable job: `status IN ('pending','held')` whose `available_at` is NULL or in the past; increments `attempts`, sets `reserved_at`.
2. `(new $jobClass())->handle($payload)`.
3. On success → `Queue::markCompleted()`. On **`ChartImagesMissingException`** → `Queue::markHeld()` (not a failure — retry later). On any other `\Throwable` → `Queue::markFailed()`.

See [background-jobs-and-queue.md](background-jobs-and-queue.md) for the queue mechanics.

---

## GenerateReportJob

`GenerateReportJob::handle($data)` (`app/Jobs/`):
1. Logs the call.
2. `AssessmentModel::with('user','payment')->find($data['assessment_id'])`.
3. Calls `AssessmentReportService::generateReport([$assessment], $data, 'single')`, which returns a list of **assessment ids whose charts were missing**.
4. If this assessment is in that missing list → **throws `ChartImagesMissingException`** so the worker holds the job for a later retry (the missing-charts alert email was already sent by the service).

---

## AssessmentReportService.generateReport()

`generateReport($assessments, $attr, $type)` (`app/Services/AssessmentReportService.php`) — per assessment:

1. Resolve the version context: `override` flag and the validated `review` version (for `-v{n}` naming and the coach-override entry).
2. **Idempotency:** if not an override and `pdf_status == 1` and the personal PDF file already exists, skip.
3. **Chart-image gate:** require both `get_assessment_chart_image($id, …)` (the 3-chart) **and** the `single` chart to exist (version-aware). If either is missing, record the assessment in `chartImageMissingAssessments` and skip rendering it.
4. Fetch the **Scoring Engine snapshot** (self result + responses + needs responses) — the same consolidated data the WP PDF template consumes.
5. Render the **personal** report PDF (html2pdf) to `assessments/pdf/` (or `assessments/override/pdf/` for overrides), set `pdf_status = 1`.
6. If the coupon enables it, generate the **manager** report (below) and send notification emails.
7. After the loop, for every missing-chart assessment, send the **"Urgent: Assessment Charts are missing"** alert email (`assessment-images-missing` template), and **return the list of missing-chart assessment ids**.

---

## The chart-image gate & held/retry

**The report cannot render without chart images already on disk** — this is the central gate. Charts are produced browser-side in the WP funnel (canvas → PNG). If they aren't there yet when the job runs:
- The service records the assessment as missing and returns its id.
- `GenerateReportJob` throws `ChartImagesMissingException`.
- The worker calls `Queue::markHeld()` → `status='held'`, `available_at = now + N hours`, `reserved_at = null`.
- The job is **released early** when the charts appear: the WP side's `mytemp_release_held_report_jobs()` sets `available_at = now`, so `fetchNext()` picks it on the next poll.

This is why a report can lag: it waits for its charts, then renders on the next worker tick.

---

## Manager reports

Within `generateReport()`, the manager variant is generated when **`$coupon->manager_report == 1`** OR the assessment's `details->manager_report_enabled` is set (an on-demand "Create Manager Report" request, so future validations keep generating their manager version):
- `generateManagerReport($assessment, $override, $review, $snapshot)` is the **single source** of manager-report generation (also used by `GenerateManagerReportJob`).
- Output: `{assessment_id}-{Name}-{date}-Manager-Report[-v{n}].pdf` under `assessments/pdf/` (or `override/pdf/`).
- On first (non-override) generation, manager emails go to the coupon's managers (`CouponManagerModel` → `user.user_email`).

---

## Versioned validated / manager PDFs

Override (validated) runs carry `override:true` + `review_id`. The service uses the review's **version** for the `-v{n}` filename suffix and selects the matching coach-override entry from the snapshot, writing to `assessments/override/pdf/`. This mirrors the plugin's `mytemp_get_released_report_url()` version resolution (path reference).

---

## Emails on generation

Sent from `generateReport()` (recipients redirected to `APP_EMAIL` when `APP_ENV` is `local`/`staging`):
- **Manager report ready** → coupon managers (`manager-assessment-notification`).
- **Affiliate/company notification** → `affiliate-company-assessment-notification`.
- **Missing-charts alert** → admin (`assessment-images-missing`).

Report-ready participant emails and the affiliate/manager report emails coordinate with Plugin 2's email suite (path reference). See [emails.md](emails.md).

---

## Outputs & state

| Output | Location |
|---|---|
| Personal PDF | `assessments/pdf/{id}-{Name}-{date}.pdf` |
| Validated personal PDF | `assessments/override/pdf/{id}-{Name}-{date}-v{n}.pdf` |
| Manager PDF | `assessments/pdf/{id}-{Name}-{date}-Manager-Report[-v{n}].pdf` |
| State | `mytemp_assessments.pdf_status = 1` on success |

Chart PNGs (prerequisite, produced by WP): `assessments/images/chart_{id}.png`, `single_chart_{id}.png` (override variants under `assessments/override/images/`).

---

## Complete sequence

```
WP (Plugin 1) ─ payment/finish ─▶ INSERT {prefix}jobs (GenerateReportJob, pending, {assessment_id[,override,review_id]})
                                   (also: assessments:generate-report sweeper enqueues finished/pdf_status=0)
        ▼
queue:work ─ fetchNext() (pending|held & available_at due) ─▶ GenerateReportJob::handle()
        ▼
AssessmentReportService::generateReport()
   │  pdf_status==1 & file exists?           → skip (idempotent)
   │  chart images present (3-chart+single)? → NO → record missing → (later) alert email → return [id]
   │                                            YES ↓
   │  fetch Scoring Engine snapshot → render personal PDF (html2pdf) → pdf_status=1
   │  coupon manager_report==1 / details.manager_report_enabled? → generateManagerReport() + manager email
   ▼
worker: missing? → throw ChartImagesMissingException → markHeld (available_at = now + N h)
        else     → markCompleted
        │
WP releases held early when charts land (mytemp_release_held_report_jobs → available_at = now)
```

---

## Related

- [background-jobs-and-queue.md](background-jobs-and-queue.md) — the queue + held/retry
- [scoring-engine-proxy.md](scoring-engine-proxy.md) — the snapshot source
- [emails.md](emails.md) — the generation emails · [reference/data-layer.md](../reference/data-layer.md)
