# LiftIQ Backend

Laravel 12 API for LiftIQ — AI-Powered Personal Gym Coach.

## Tech Stack

- Laravel 12 (PHP 8.2+)
- SQLite (local dev) — swap `DB_CONNECTION` to `pgsql` for PostgreSQL in staging/prod
- Laravel Sanctum (API token auth for the mobile app)

## Setup

```bash
composer install --no-dev   # or drop --no-dev once dev-tool downloads aren't blocked locally
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

## API Overview

All routes are under `/api`. Authenticated routes require `Authorization: Bearer <token>` from
`/auth/register` or `/auth/login`.

| Area | Routes |
|---|---|
| Auth | `POST /auth/register`, `POST /auth/login`, `POST /auth/logout`, `GET /auth/me` |
| Profile | `GET /profile`, `POST /profile` (onboarding submit / update) |
| Exercises | `GET /exercises` (`?search=`, `?muscle=`), `GET /exercises/{id}` |
| Planner | `GET/POST /workout-assignments` (day → muscle group), `POST /workout-generate` (AI workout for a day) |
| Workout Logs | `GET/POST /workout-logs`, `GET /personal-records` |
| Trackers | `GET /tracker/water`, `POST /tracker/water/add`, `POST /tracker/water/reset`, `GET/POST /tracker/weight`, `GET/POST /tracker/measurements` |

## AI Workout Generator

`app/Services/WorkoutGenerator.php` builds a day's workout from the user's profile (experience,
available time) and a muscle-group focus, pulling from the seeded `exercises` table
(`database/seeders/ExerciseSeeder.php`). This mirrors the logic originally prototyped client-side
in the mobile app's `src/lib/workoutGenerator.ts`.

## Status

Core MVP endpoints are implemented and smoke-tested (register → profile → generate workout →
log workout → personal records → water tracker). Not yet built: PostgreSQL deployment config,
push notifications, real-time recovery scoring, and nutrition AI.
