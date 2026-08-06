# Reference: HTTP Routes

Every HTTP endpoint, from `app/routes.php`. All routes are under the **`/v1`** group (full base path **`/api/v1`**), served by Apache from `public/` at `/api/`. The `/v1` group applies `CorsMiddleware` (`Access-Control-Allow-Origin: *`) to everything.

Route groups accept `prefix`, `controller`, and `middleware` keys. A stub `/v2` group exists (`GET /v2/health`).

---

## Health & misc

| Method · Path | Handler | Middleware |
|---|---|---|
| `GET /v1/health` | `HealthController::index` | `RateLimitMiddleware` (120/min/IP) |
| `GET /v1/users/{id}` | inline closure (echo id) | — |
| `GET /v1/protected/secret` | `ProtectedController::secret` | `JwtMiddleware` |

---

## Auth — `/v1/auth` (`AuthController`)

| Method · Path | Method | Guard |
|---|---|---|
| `POST /auth/login` | `login` | — |
| `POST /auth/temporary-registration` | `registerDummyUser` | — |
| `POST /auth/refresh` | `refresh` | — |
| `POST /auth/logout` | `logout` | `JwtMiddleware` |
| `GET /auth/me` | `me` | `JwtMiddleware` |

See [../features/authentication.md](../features/authentication.md).

---

## Assessments — `/v1/assessments` (`AssessmentController`)

| Method · Path | Method | Guard |
|---|---|---|
| `POST /assessments/validate` | `validate` | `JwtMiddleware` |
| `GET /assessments` | `index` | — |
| `GET /assessments/{id}` | `show` | — |
| `POST /assessments` | `store` | — |
| `PUT /assessments/{id}` | `update` | — |
| `DELETE /assessments/{id}` | `destroy` | — |

The funnel's `PUT /assessments/{id}` is how the browser advances `questionsCompleted`.

---

## Jobs — `/v1/jobs` (`JobController`)

CRUD over the `{prefix}jobs` queue table: `GET /jobs`, `GET /jobs/{id}`, `POST /jobs`, `PUT /jobs/{id}`, `DELETE /jobs/{id}`. See [../features/background-jobs-and-queue.md](../features/background-jobs-and-queue.md).

---

## Participants & sessions

`ParticipantController` and `ParticipantSessionController` — full CRUD:
- `/v1/participants` — `GET`, `GET /{id}`, `POST`, `PUT /{id}`, `PATCH /{id}`, `DELETE /{id}`.
- `/v1/participant-sessions` — `GET`, `GET /{id}`, `POST`, `PUT /{id}`, `DELETE /{id}`.

---

## Scoring Engine proxy — `/v1/scoring-engine` (`Controllers/ScoringEngine/*`)

The browser-facing proxy to the Scoring Engine ([../features/scoring-engine-proxy.md](../features/scoring-engine-proxy.md)):

| Method · Path | Controller |
|---|---|
| `GET/POST/PUT/PATCH/DELETE /scoring-engine/participants[/{id}]` | `ScoringEngine\ParticipantController` |
| `GET/POST/PUT/PATCH/DELETE /scoring-engine/participant-sessions[/{id}]` | `ScoringEngine\ParticipantSessionController` (`indexSessions`/`showSession`/…) |
| `POST /scoring-engine/needs-assessment-complete` | `NeedsAssessmentCompleteController::complete` |
| `GET/POST/PUT/PATCH/DELETE /scoring-engine/self-assessment-responses[/{id}]` | `SelfAssessmentResponseController` |

`POST /scoring-engine/self-assessment-responses` (the funnel's per-question save) runs the idempotent `saveSelfAssessmentResponse` upsert and returns `{ responseId }`.

---

## Related

- [../features/authentication.md](../features/authentication.md) · [../features/scoring-engine-proxy.md](../features/scoring-engine-proxy.md)
- [../architecture.md](../architecture.md#http-request-lifecycle) · [commands.md](commands.md)
