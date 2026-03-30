# AGENTS.md — CompresslyPro Codebase Guide

## Project Overview
Laravel 12 / PHP 8.2+ image-processing SaaS (**CompresslyPro**). No API keys or third-party processing — all image work is server-side via **Intervention Image v3**. Uses SQLite by default.

## Architecture

### Two Controller Split
- `ImageController` — single-image compress/convert + chunked upload (Sprint 1)
- `T2Controller` — all Sprint 2 tools: batch compress, resize, watermark, image↔PDF, URL-based compression

Both controllers use the shared trait `app/Http/Controllers/Concerns/ImageSafetyGuard.php` for memory safety (dimension guard, stream chunk assembly, auto-downscale).

### Obfuscated API Routes
All public image-processing AJAX endpoints live under `/api/{slug}` where slugs are random tokens stored in `config/api_routes.php`, overridable via `.env` (`API_SLUG_*`). **Never hard-code these slugs in frontend JS** — always read them from the Blade template where they're injected as JS variables.

```php
// config/api_routes.php — rotate slugs by changing .env values
'compress' => env('API_SLUG_COMPRESS', '8f3879ade1c2e843'),
```

### Middleware Stack
| Alias | Class | Purpose |
|---|---|---|
| `memory.guard` | `MemoryGuard` | Sets per-request PHP memory limit (formula: 64 MB + 6× file size, capped at 256 MB) |
| `admin.auth` | `AdminAuth` | Checks `Auth::user()->is_admin` |
| `SecurityHeaders` | (global web) | Adds hardening headers (`X-Frame-Options`, `Referrer-Policy`, etc.) and `X-Robots-Tag` on admin/auth/api/download and 4xx responses |
| `CanonicalUrl` | (global web) | In production, 301-redirects GET/HEAD requests to canonical scheme/host/path from `APP_URL` |

All image-processing POST routes are wrapped in the `memory.guard` group in `routes/web.php`.

### Frontend Stack
- **Tailwind CSS** loaded via CDN in `layouts/page.blade.php` (not the Vite build) with an inline `tailwind.config` block for brand/accent color extensions
- **Vite** bundles `resources/css/app.css` + `resources/js/app.js`; currently only the default `welcome.blade.php` uses `@vite`, while routed tool/marketing pages use Blade + CDN assets
- **Alpine.js** for reactive UI on the main tool pages — no separate JS build for tool pages

## Developer Workflows

### Full Dev Start (all services)
```bash
composer run dev
# Starts: php artisan serve, queue:listen, pail (log viewer), vite — concurrently
```

### First-time Setup
```bash
composer run setup  # installs deps, copies .env, migrates, builds assets
php artisan db:seed --class=AdminSeeder  # creates admin@imagecompressor.com / admin123
```

### Tests
```bash
composer run test  # clears config cache, then runs phpunit
php artisan test --filter SomeTest
```

### File Cleanup (scheduled hourly in production)
```bash
php artisan uploads:cleanup              # deletes files older than 1440 min (24h) by default
php artisan uploads:cleanup --dry-run   # preview only
php artisan uploads:cleanup --minutes=60
```
Cleans two locations: `storage/app/public/uploads/` (outputs) and `storage/app/temp-uploads/` (assembled chunks).

## Key Conventions

### Chunked Uploads
Large files are split client-side and uploaded chunk-by-chunk to either `ImageController::uploadChunk` or `T2Controller::uploadChunk`. After all chunks land in `storage/app/temp-uploads/{upload_id}/`, the finalize endpoint assembles them via `streamAssembleChunks()` (streams only — no per-chunk RAM). MIME is re-validated on the assembled file.

### Reporting Every Operation
Every compress/convert/resize/etc. call writes a `CompressionReport` record with `action`, `batch_id`, `referrer`, sizes, quality, dimensions, and anonymized IP. Admin dashboard reads these via `ReportController`.

### Admin Panel
- Login URL: `/authorize` (not `/login` — intentional obfuscation)
- Guard: `is_admin` boolean on `users` table; `User::isAdmin()` method
- Protected routes prefixed `/admin/*` under `admin.auth` middleware

### Blog / Tool Landing Pages
Static Blade views only — no DB queries. Blog slugs are allowlisted in `routes/web.php`; adding a new post requires both a new view in `resources/views/blog/` and an entry in the `$blogSlugs` array.

### SEO / Layout
Most public-facing marketing/tool/blog pages extend `layouts/page.blade.php`. Override `@section('title')`, `@section('description')`, `@section('canonical')`, `@section('og_title')` etc. `home.blade.php` and legal pages are standalone templates. AdSense script is only injected in `app()->isProduction()`.

## Key Files
| Path | Purpose |
|---|---|
| `app/Http/Controllers/ImageController.php` | Single-image compress/convert, chunk upload |
| `app/Http/Controllers/T2Controller.php` | All Sprint 2 tools (1541 lines) |
| `app/Http/Controllers/Concerns/ImageSafetyGuard.php` | Shared memory/safety trait |
| `app/Http/Middleware/MemoryGuard.php` | Dynamic memory_limit per request |
| `app/Console/Commands/CleanupUploads.php` | Cleanup command behavior (`uploads:cleanup` options and deletion rules) |
| `config/api_routes.php` | Obfuscated endpoint slugs |
| `routes/web.php` | All route definitions, middleware grouping |
| `resources/views/layouts/page.blade.php` | Master layout (SEO, nav, footer, Tailwind CDN) |
| `routes/console.php` | Scheduled cleanup (`uploads:cleanup --minutes=1440` hourly) |

## Environment Variables (non-obvious)
```
IMAGE_MAX_PIXELS=16777216     # default 4096×4096; rejects oversized images before RAM load
IMAGE_DOWNSCALE_PIXELS=9000000 # auto-downscale threshold before heavy ops
MEMORY_GUARD_MAX_MB=256       # hard ceiling for MemoryGuard
API_SLUG_*                    # rotate all AJAX endpoint URLs without code changes
```

