# Feature: Scoring Engine Proxy

This service is the **browser-facing proxy** to the external Scoring Engine (GraphQL). During the assessment funnel, the participant's browser posts high-frequency writes to `/api/v1/scoring-engine/*`, and this service translates them into GraphQL calls against the engine — keeping the engine's app-id/api-key server-side and normalizing responses for the browser.

## Sections
- [Why a proxy](#why-a-proxy)
- [The GraphQL transport](#the-graphql-transport)
- [The resource services](#the-resource-services)
- [The proxy controllers](#the-proxy-controllers)
- [Self-assessment responses (idempotent upsert)](#self-assessment-responses-idempotent-upsert)
- [Needs-assessment complete](#needs-assessment-complete)
- [Server-side use (report snapshot)](#server-side-use-report-snapshot)
- [Related](#related)

---

## Why a proxy

The Scoring Engine holds all answers and computes DISC results. Two access patterns exist (see the WP-side funnel doc `wp-temperament-assessment/docs/features/assessment-process.md`, path only):
- **Browser → this API proxy → engine** for the funnel's frequent writes (per-question self responses, `questionsCompleted`, needs-complete). The browser never sees the engine credentials or the raw GraphQL shape.
- **Server-side → engine** for report generation (the result snapshot).

The plugin's PHP GraphQL client handles the session/participant lifecycle directly; this proxy handles the browser writes.

---

## The GraphQL transport

`Services/Http/BaseGraphQLService.php` — the single connection manager (the active path; the REST `BaseHttpService.php` is legacy):
- **Endpoint** from the WP `mytemp_settings` option (`graphql_endpoint_production` / `_staging`, selected by `staging_mode`) — read via `OptionsModel` (never written here).
- **Credentials** (`x-app-id`, `x-api-key`) from `.env` via `config/graphql.php`.
- **30s cURL timeout.** Returns the decoded `data` object or `null`; `getLastError()` gives a human-readable message.

---

## The resource services

`Services/Api/*Service.php` — one service per Scoring Engine resource: self/needs assessment surveys, sections, questions, choices, responses, results, overrides, ratings, graders, patterns, participants, sessions, editions, and validation surveys/sections. Each wraps `BaseGraphQLService` with the resource's queries/mutations.

---

## The proxy controllers

`app/Controllers/ScoringEngine/` — the HTTP controllers behind the `/api/v1/scoring-engine/*` routes ([reference/routes.md](../reference/routes.md)):
- `ParticipantController` — participants CRUD.
- `ParticipantSessionController` — participant sessions CRUD.
- `SelfAssessmentResponseController` — self-response CRUD (the funnel's per-question save).
- `NeedsAssessmentCompleteController` — the combined needs-complete endpoint.

---

## Self-assessment responses (idempotent upsert)

`POST /api/v1/scoring-engine/self-assessment-responses` → `SelfAssessmentResponseController::store()`:
- Runs the engine's **idempotent** `saveSelfAssessmentResponse(input: SaveSelfAssessmentResponseInput!)` mutation (create-or-update keyed by `participantSessionId + questionPath`), returning `outcome` + `response { id, questionPath, mostChoiceId, leastChoiceId }`.
- **Normalizes** the HTTP response to `{ "responseId": "<id>" }` — the browser never sees the raw GraphQL shape. `null` → 422 with `getLastError()`.
- The legacy `create`/`updateById` mutations are retained for back-compat but the funnel uses the single upsert.

This is the endpoint the funnel calls once per answered question (see the WP funnel doc, path only).

---

## Needs-assessment complete

`POST /api/v1/scoring-engine/needs-assessment-complete` → `NeedsAssessmentCompleteController::complete()`:
- Saves the participant's needs choices **and** completes the needs session on the engine in one call (`{ participantSessionId, assessment_id, choices }`).
- The WP side then syncs its own DB status and triggers chart generation (path reference).

---

## Server-side use (report snapshot)

Report generation ([report-generation.md](report-generation.md)) uses the resource services to fetch the consolidated result **snapshot** (self result + responses + needs responses) that the PDF template renders — a server-side GraphQL read, not through the proxy controllers.

---

## Related

- [report-generation.md](report-generation.md) — the server-side snapshot consumer
- [reference/routes.md](../reference/routes.md) — the proxy route map
- [integrations.md](../integrations.md) — the engine endpoint/credentials contract
