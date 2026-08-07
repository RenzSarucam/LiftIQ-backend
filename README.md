# LiftIQ Backend

Laravel 12 API for LiftIQ — AI-Powered Personal Gym Coach.

## Tech Stack

- Laravel 12 (PHP 8.2+)
- SQLite (local dev) / MySQL (production, via Railway)
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

## Deployment (Railway)

This repo deploys to Railway via `railway.json`, which runs migrations and starts the server
automatically on every push to `main`:

1. Railway → New Project → Deploy from GitHub repo → this repo.
2. Add a MySQL database to the project ("+ New" → Database → Add MySQL).
3. Set environment variables on the backend service:
   ```
   APP_KEY=<generate via `php artisan key:generate --show`>
   APP_ENV=production
   APP_DEBUG=false
   DB_CONNECTION=mysql
   DB_URL=${{MySQL.MYSQL_URL}}
   ```
4. Settings → Networking → Generate Domain for the public API URL.

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
log workout → personal records → water tracker). Deployed on Railway (MySQL). Not yet built:
push notifications, real-time recovery scoring, and nutrition AI.
