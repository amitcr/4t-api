# Feature: Authentication

How the API authenticates callers — JWT bearer tokens issued at login / temporary registration, validated by middleware, with **WordPress-compatible password hashing** so credentials interoperate with the plugins.

## Sections
- [Overview](#overview)
- [The auth routes](#the-auth-routes)
- [Login](#login)
- [Temporary registration](#temporary-registration)
- [Tokens & refresh](#tokens--refresh)
- [JWT middleware](#jwt-middleware)
- [WordPress-compatible hashing](#wordpress-compatible-hashing)
- [Middleware summary](#middleware-summary)
- [Related](#related)

---

## Overview

`AuthController` (`app/Controllers/AuthController.php`) issues JWTs via `JwtService`; `PasswordHashService` verifies WordPress phpass hashes so the same user credentials work on the WP site and the API. Protected routes are guarded by `JwtMiddleware`.

---

## The auth routes

Under `/api/v1/auth` ([reference/routes.md](../reference/routes.md)):

| Method · Path | Controller method | Guard |
|---|---|---|
| `POST /auth/login` | `login` | — |
| `POST /auth/temporary-registration` | `registerDummyUser` | — |
| `POST /auth/refresh` | `refresh` | — |
| `POST /auth/logout` | `logout` | `JwtMiddleware` |
| `GET /auth/me` | `me` | `JwtMiddleware` |

---

## Login

`AuthController::login($request)`:
1. Look up the WordPress user by login/email.
2. Verify the password with `PasswordHashService` using the **same phpass params as WordPress** (`new PasswordHash(8, true)`).
3. On success, build the JWT payload and `JwtService::generateToken($payload)`; mint a secure random **refresh token** (`bin2hex(random_bytes(32))`, `refresh_expires_at = now + 7 days`).
4. Return `{ access_token, refresh_token, ... }`.

---

## Temporary registration

`AuthController::registerDummyUser($request)` creates a **temporary user + participant** and returns a token — the funnel's guest path (mirrors the WP temp-participant creation so tokens interoperate):
1. Create the WP user (password hashed WP-compatibly), assign the participant record.
2. Generate the JWT + refresh token (as in login).
3. Return the tokens for the browser to use against the proxy endpoints.

---

## Tokens & refresh

- **Access token:** a JWT (HS256) signed with `JWT_SECRET`. A default fallback secret exists if the env var is unset — **production must set a real one**.
- **Refresh token:** an opaque random string stored with an expiry (`refresh_expires_at`, ~7 days). `POST /auth/refresh` exchanges a valid refresh token for a new access token.

---

## JWT middleware

`app/Middleware/JwtMiddleware.php` — validates `Authorization: Bearer <jwt>` (HS256), attaches the decoded payload to **`$request->tokendata`**, and returns **401** on a missing/invalid/expired token. Applied to the protected routes (`/auth/logout`, `/auth/me`, `/assessments/validate`, `/protected/secret`).

---

## WordPress-compatible hashing

`app/Services/PasswordHashService.php` is a port of WordPress's phpass (`PasswordHash(8, true)`), so:
- The API can verify a password that WordPress hashed (login works with the same credentials).
- Temporary users created here have hashes WordPress accepts.

Keep this in sync with the WP side if either changes. The related `Services/Crypto/WpCryptoService` (byte-compatible with the plugin `class-crypto.php`) covers shared encrypted values (not passwords).

---

## Middleware summary

| Middleware | Applied to | Behavior |
|---|---|---|
| `CorsMiddleware` | the whole `/v1` group | `Access-Control-Allow-Origin: *` |
| `JwtMiddleware` | protected routes | HS256 bearer validation → `$request->tokendata`, 401 on failure |
| `RateLimitMiddleware` | `/health` only | 120 req/min/IP, file-cache backed |

---

## Related

- [reference/routes.md](../reference/routes.md) — the guarded routes
- [scoring-engine-proxy.md](scoring-engine-proxy.md) — what temporary-registration tokens are used for
- [integrations.md](../integrations.md) — shared crypto/hashing with the plugins
