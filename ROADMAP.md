# CompresslyPro — Feature Roadmap & Implementation Plan

> **Stack:** Laravel 12 · PHP 8.4 · Intervention Image · Alpine.js v3 · Tailwind CSS  
> **Document version:** 2026-03-02  
> **Status key:** `[ ]` planned · `[~]` in progress · `[x]` done

---

## Table of Contents

1. [Current State](#current-state)
2. [Tier 1 — Quick Wins (High Impact / Low–Medium Effort)](#tier-1)
3. [Tier 2 — Core Growth (Medium Impact / Medium Effort)](#tier-2)
4. [Tier 3 — Strategic / Moat Features](#tier-3)
5. [Technical Debt & Infrastructure](#technical-debt)
6. [SEO Keyword Targets by Feature](#seo-keywords)
7. [Database Schema Evolution](#database-schema)
8. [Implementation Order (Sprint Plan)](#sprint-plan)

---

## Current State

### ✅ What is already built

| Feature | Route | Notes |
|---|---|---|
| Image Compress (single) | `POST /api/{slug}` | Quality slider 10–90%, keeps original format |
| Image Convert (single) | `POST /api/{slug}` | JPG → PNG → WebP |
| Chunked upload | `POST /api/{slug}` + finalize | 1 MB chunks, supports up to 20 MB files |
| Download | `GET /dl/{filename}` | Serves `compresslypro-{name}.{ext}` |
| Admin login | `GET/POST /authorize` | Email + password, `is_admin` flag |
| Admin dashboard | `GET /admin` | Basic stats view |
| Admin reports | `GET /admin/reports` | Compression history table + AJAX data |
| Compression reports DB | `compression_reports` table | Records every operation |
| OG image | `public/og-image.png` | 1200×630, GD-generated |
| PWA manifest | `public/manifest.json` | Add to Home Screen support |
| Schema markup | JSON-LD in `<head>` | WebApplication, HowTo, FAQ, Organization |
| Obfuscated API URLs | `config/api_routes.php` | Hex slugs from `.env` |
| Sitemap + robots.txt | `public/` | `compresslypro.com` domain |

### ❌ What is missing / planned

See Tiers 1–3 below.

---

## Tier 1 — Quick Wins {#tier-1}

> **Goal:** Ship these first. Each takes 1–4 hours. Immediate improvement in UX, reliability, and SEO.

---

### T1-1 · Scheduled Image Cleanup Command

**Priority:** 🔴 Critical (file storage fills up without this)  
**Effort:** ~1 hour  
**Status:** `[ ]`

#### Problem
The UI says "files auto-delete in 30 minutes" but no cleanup actually runs.  
`storage/app/public/uploads/` and `storage/app/temp-uploads/` accumulate forever.

#### Implementation

**1. Create artisan command**
```bash
php artisan make:command CleanupImages
```

**File:** `app/Console/Commands/CleanupImages.php`
```php
<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanupImages extends Command
{
    protected $signature   = 'images:cleanup';
    protected $description = 'Delete processed images and temp chunks older than 30 minutes';

    public function handle(): void
    {
        $maxAge = now()->subMinutes(30);
        $deleted = 0;

        // Clean processed uploads
        foreach (Storage::files('public/uploads') as $file) {
            if (Storage::lastModified($file) < $maxAge->timestamp) {
                Storage::delete($file);
                $deleted++;
            }
        }

        // Clean orphaned temp chunk dirs
        foreach (Storage::directories('temp-uploads') as $dir) {
            $files = Storage::files($dir);
            if (empty($files) || Storage::lastModified($dir . '/chunk_0') < $maxAge->timestamp) {
                Storage::deleteDirectory($dir);
                $deleted++;
            }
        }

        $this->info("Cleanup complete. Removed {$deleted} files/dirs.");
    }
}
```

**2. Register schedule in `routes/console.php`**
```php
use Illuminate\Support\Facades\Schedule;

Schedule::command('images:cleanup')->everyFiveMinutes();
```

**3. Add cron on server**
```cron
* * * * * cd /var/www/compresslypro && php artisan schedule:run >> /dev/null 2>&1
```

#### Testing
```bash
php artisan images:cleanup
```

---

### T1-2 · Before / After Preview Slider

**Priority:** 🔴 High (trust builder, increases time-on-page = SEO signal)  
**Effort:** ~2 hours  
**Status:** `[ ]`

#### Problem
After compression users have no visual way to compare quality. They download blindly.

#### Implementation

No new dependencies — pure CSS + Alpine.js.

**Add to result card in `home.blade.php` (compress tab, after the stats grid):**
```html
<div class="relative rounded-2xl overflow-hidden select-none touch-none"
     x-data="{ sliderPos: 50 }"
     x-on:mousemove="if($event.buttons===1){ sliderPos = Math.min(Math.max(($event.offsetX/$el.offsetWidth)*100,2),98) }"
     x-on:touchmove.prevent="sliderPos = Math.min(Math.max((($event.touches[0].clientX - $el.getBoundingClientRect().left)/$el.offsetWidth)*100,2),98)"
     style="height:260px;">

    <!-- Original (right side) -->
    <img :src="previewUrl" class="absolute inset-0 w-full h-full object-contain" alt="Original">

    <!-- Compressed (left side — clipped) -->
    <div class="absolute inset-0 overflow-hidden" :style="'width:' + sliderPos + '%'">
        <img :src="result.download_url" class="absolute inset-0 w-full h-full object-contain" alt="Compressed">
    </div>

    <!-- Divider handle -->
    <div class="absolute top-0 bottom-0 w-0.5 bg-white shadow-lg cursor-ew-resize flex items-center justify-center"
         :style="'left:' + sliderPos + '%'">
        <div class="w-8 h-8 bg-white rounded-full shadow-xl flex items-center justify-center text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l-3 3 3 3M16 9l3 3-3 3"/>
            </svg>
        </div>
    </div>

    <!-- Labels -->
    <span class="absolute top-2 left-3 bg-black/50 text-white text-xs font-bold px-2 py-1 rounded">Original</span>
    <span class="absolute top-2 right-3 bg-brand-600/80 text-white text-xs font-bold px-2 py-1 rounded">Compressed</span>
</div>
```

---

### T1-3 · Copy to Clipboard Button

**Priority:** 🟡 High  
**Effort:** ~30 minutes  
**Status:** `[ ]`

#### Implementation

Add button to result card alongside Download:
```html
<button x-on:click="copyToClipboard()"
        class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-5 rounded-2xl transition-all">
    <svg class="w-5 h-5" .../>  <!-- clipboard icon -->
    <span x-text="copied ? 'Copied!' : 'Copy'"></span>
</button>
```

Alpine.js method (add to `compressor()` data):
```javascript
copied: false,
async copyToClipboard() {
    try {
        const res  = await fetch(this.result.download_url);
        const blob = await res.blob();
        await navigator.clipboard.write([
            new ClipboardItem({ [blob.type]: blob })
        ]);
        this.copied = true;
        setTimeout(() => this.copied = false, 2000);
    } catch (e) {
        // Fallback: open in new tab
        window.open(this.result.download_url, '_blank');
    }
},
```

---

### T1-4 · AVIF Format Support

**Priority:** 🟡 Medium  
**Effort:** ~1 hour  
**Status:** `[ ]`

#### Why
AVIF = ~50% smaller than WebP at equivalent quality. All major browsers support it.  
Adds a high-value talking point + keyword: *"convert to avif online free"*.

#### Implementation

**`ImageController.php`** — add to constants and `getEncoder()`:
```php
private const ALLOWED_MIMES = [
    'image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/avif', // add avif
];

private const MIME_TO_EXT = [
    'image/jpeg' => 'jpg',
    'image/png'  => 'png',
    'image/webp' => 'webp',
    'image/gif'  => 'gif',
    'image/avif' => 'avif',  // add
];

private function getEncoder(string $format, int $quality)
{
    return match (strtolower($format)) {
        'jpg', 'jpeg' => new JpegEncoder(quality: $quality),
        'png'         => new PngEncoder(),
        'webp'        => new WebpEncoder(quality: $quality),
        'avif'        => new AvifEncoder(quality: $quality),  // add
        'gif'         => new GifEncoder(),
        default       => new JpegEncoder(quality: $quality),
    };
}
```

Add `use Intervention\Image\Encoders\AvifEncoder;` at top.

**Convert tab** — add AVIF as 4th format button:
```html
<!-- Add 'avif' to the x-for loop -->
<template x-for="fmt in ['jpg', 'png', 'webp', 'avif']" :key="fmt">
```

**Validate in routes** — update `in:jpg,png,webp` → `in:jpg,png,webp,avif`.

> ⚠️ Requires `libavif` on the server. Check with: `php -r "echo (new Imagick())->queryFormats('AVIF') ? 'OK' : 'NO';"`

---

### T1-5 · Strip EXIF / Metadata Viewer

**Priority:** 🟡 High (privacy feature, keyword: *"remove exif data from image online"* ~90K/mo)  
**Effort:** ~2 hours  
**Status:** `[ ]`

#### Implementation

**Show metadata after upload** (client-side, no server round-trip):
```javascript
// Read EXIF from file blob before uploading
async readExif(file) {
    // Use exifr.js (lightweight, 14KB gzipped)
    const exif = await Exifr.parse(file, ['Make', 'Model', 'DateTimeOriginal', 'GPSLatitude', 'GPSLongitude']);
    this.exifData = exif;
    this.hasGps   = !!(exif?.GPSLatitude);
},
```

Add to `<head>`:
```html
<script src="https://cdn.jsdelivr.net/npm/exifr/dist/lite.esm.js" type="module"></script>
```

**UI — warning badge in settings panel:**
```html
<div x-show="hasGps" class="flex items-center gap-2 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-700">
    ⚠️ <strong>GPS data found</strong> — will be stripped automatically on compress.
</div>
```

**Backend:** Intervention Image strips EXIF by default on re-encode — nothing extra needed.

**Add "EXIF stripped" badge to result card.**

---

## Tier 2 — Core Growth {#tier-2}

> **Goal:** These features directly target high-volume SEO keywords and expand the tool's audience significantly.

---

### T2-1 · Batch Upload + ZIP Download

**Priority:** 🔴 Very High  
**Effort:** ~6–8 hours  
**Status:** `[ ]`

#### Why
TinyPNG's most-used feature. Targets: *"compress multiple images at once"* (~60K/mo).

#### Database change
```php
// New migration
Schema::table('compression_reports', function (Blueprint $table) {
    $table->string('batch_id', 32)->nullable()->index()->after('id');
});
```

#### Backend
```php
// New method in ImageController
public function compressBatch(Request $request): JsonResponse
{
    $request->validate([
        'images'   => 'required|array|min:1|max:20',
        'images.*' => 'file|mimes:jpeg,jpg,png,webp,gif|max:20480',
        'quality'  => 'required|integer|min:10|max:90',
    ]);

    $batchId = Str::random(16);
    $results = [];

    foreach ($request->file('images') as $file) {
        // ... same compress logic ...
        $results[] = [
            'original_name'       => $file->getClientOriginalName(),
            'download_url'        => route('image.download', $outputFilename),
            'formatted_original'  => $this->formatBytes($originalSize),
            'formatted_compressed'=> $this->formatBytes($compressedSize),
            'reduction'           => $reduction,
        ];
    }

    return response()->json(['success' => true, 'batch_id' => $batchId, 'files' => $results]);
}
```

#### ZIP download endpoint
```php
public function downloadZip(Request $request): BinaryFileResponse
{
    $request->validate(['files' => 'required|array|max:20']);

    $zip  = new ZipArchive();
    $path = storage_path('app/temp-uploads/batch-' . Str::random(8) . '.zip');
    $zip->open($path, ZipArchive::CREATE);

    foreach ($request->input('files') as $filename) {
        // validate filename pattern
        if (!preg_match('/^compresslypro-[a-z0-9\-]+\.(jpg|png|webp|gif)$/i', $filename)) continue;
        $filePath = storage_path("app/public/uploads/{$filename}");
        if (file_exists($filePath)) {
            $zip->addFile($filePath, $filename);
        }
    }

    $zip->close();
    return response()->download($path, 'compresslypro-batch.zip')->deleteFileAfterSend(true);
}
```

#### Frontend — file queue UI
```
┌─────────────────────────────────────────────────┐
│  📁 Drop multiple images here                    │
│  ─────────────────────────────────────────────  │
│  photo1.jpg      2.3 MB  → 340 KB  ✅ -85%      │
│  banner.png      1.1 MB  → uploading... ⏳       │
│  logo.webp       45 KB   → queued               │
│                                                  │
│  [📦 Download All as ZIP]  [🗑 Clear All]        │
└─────────────────────────────────────────────────┘
```

Alpine.js: `files[]` array, each with `{ file, status, result }`.  
Process files sequentially to avoid overwhelming the server.

---

### T2-2 · Image Resize Tool

**Priority:** 🔴 Very High  
**Effort:** ~4 hours  
**Status:** `[ ]`

#### Why
*"resize image online"* — 1.8M searches/month. Third most common image operation.

#### New tab: "Resize"

**Resize options:**
- **Exact dimensions** — W × H (with lock aspect ratio toggle)
- **By percentage** — 50%, 25%, 75%, custom
- **Preset sizes** — 1920px, 1280px, 1024px, 800px, 512px, 150px (thumbnail)
- **Max width/height** — resize down only, never upscale

**New route:** `POST /api/{slug}` → `ImageController@resize`

**Controller logic:**
```php
public function resize(Request $request): JsonResponse
{
    $validated = $request->validate([
        'image'      => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480',
        'mode'       => 'required|in:exact,percentage,max_width,max_height',
        'width'      => 'nullable|integer|min:1|max:8000',
        'height'     => 'nullable|integer|min:1|max:8000',
        'percentage' => 'nullable|integer|min:1|max:200',
        'lock_ratio' => 'nullable|boolean',
    ]);

    $image = Image::read($file->getRealPath());

    $resized = match ($validated['mode']) {
        'exact'      => $image->resize($validated['width'], $validated['height']),
        'percentage' => $image->scale(
                            (int)($image->width()  * $validated['percentage'] / 100),
                            (int)($image->height() * $validated['percentage'] / 100)
                        ),
        'max_width'  => $image->scaleDown(width: $validated['width']),
        'max_height' => $image->scaleDown(height: $validated['height']),
    };

    // ... encode and save as usual ...
}
```

**UI snippet:**
```html
<!-- Mode toggle -->
<div class="flex gap-2 mb-4">
    <button x-on:click="resizeMode='exact'"      :class="resizeMode==='exact'      ? 'active' : ''">Exact Size</button>
    <button x-on:click="resizeMode='percentage'" :class="resizeMode==='percentage' ? 'active' : ''">Percentage</button>
    <button x-on:click="resizeMode='preset'"     :class="resizeMode==='preset'     ? 'active' : ''">Preset</button>
</div>

<!-- Exact size inputs -->
<div x-show="resizeMode === 'exact'" class="flex items-center gap-3">
    <input type="number" x-model="rWidth"  placeholder="Width"  class="...">
    <button x-on:click="lockRatio = !lockRatio">🔒</button>
    <input type="number" x-model="rHeight" placeholder="Height" class="...">
    <span class="text-xs text-gray-400">px</span>
</div>
```

---

### T2-3 · Image to PDF

**Priority:** 🟡 High  
**Effort:** ~3 hours  
**Status:** `[ ]`

#### Why
*"jpg to pdf"* — 3.1M searches/month. `barryvdh/laravel-dompdf` is **already installed**.

#### Implementation

**Controller method:**
```php
public function imageToPdf(Request $request)
{
    $validated = $request->validate([
        'image' => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480',
    ]);

    $file     = $request->file('image');
    $b64      = base64_encode(file_get_contents($file->getRealPath()));
    $mime     = $file->getMimeType();
    $safeName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'image';

    $html = "
        <!DOCTYPE html><html><body style='margin:0;padding:0;'>
        <img src='data:{$mime};base64,{$b64}'
             style='max-width:100%;max-height:100%;display:block;margin:auto;'>
        </body></html>
    ";

    $pdf      = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
    $filename = "compresslypro-{$safeName}.pdf";
    $path     = storage_path("app/public/uploads/{$filename}");

    file_put_contents($path, $pdf->output());

    return response()->json([
        'success'      => true,
        'download_url' => route('image.download', $filename),
        'filename'     => $filename,
    ]);
}
```

Add `→ PDF` as 4th format button in Convert tab.  
Add `application/pdf` validation exception for download route pattern.

---

### T2-4 · PDF to Image

**Priority:** 🟡 High  
**Effort:** ~3 hours  
**Status:** `[ ]`

#### Why
*"convert pdf to jpg online"* — 2.4M searches/month.

#### Requirements
- PHP `imagick` extension with Ghostscript (`gs`) on server
- Or: `spatie/pdf-to-image` package

```bash
composer require spatie/pdf-to-image
```

#### Implementation
```php
use Spatie\PdfToImage\Pdf as PdfImage;

public function pdfToImage(Request $request): JsonResponse
{
    $request->validate([
        'pdf'    => 'required|file|mimes:pdf|max:20480',
        'format' => 'required|in:jpg,png,webp',
        'page'   => 'nullable|integer|min:1|max:100',
    ]);

    $file     = $request->file('pdf');
    $page     = (int) $request->input('page', 1);
    $format   = $request->input('format', 'jpg');
    $safeName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'document';

    $pdf      = new PdfImage($file->getRealPath());
    $filename = "compresslypro-{$safeName}-p{$page}.{$format}";
    $output   = storage_path("app/public/uploads/{$filename}");

    $pdf->selectPage($page)->format($format)->save($output);

    return response()->json([
        'success'      => true,
        'download_url' => route('image.download', $filename),
        'filename'     => $filename,
        'pages'        => $pdf->pageCount(),
    ]);
}
```

---

### T2-5 · Watermark Tool

**Priority:** 🟡 Medium  
**Effort:** ~4 hours  
**Status:** `[ ]`

#### Why
Photographers and content creators. *"add watermark to image online"* ~110K/mo.

#### Options to expose
- **Text watermark:** custom text, font size (sm/md/lg), color, opacity
- **Position:** 9-point grid (TL, TC, TR, ML, MC, MR, BL, BC, BR) + tile
- **Combined with compression** in same pipeline

#### Implementation
```php
// Add to compress pipeline (optional, before encode)
if ($request->boolean('watermark') && $request->filled('watermark_text')) {
    $text     = Str::limit($request->input('watermark_text'), 50);
    $position = $request->input('watermark_position', 'bottom-right');
    $opacity  = (int) $request->input('watermark_opacity', 60);
    $size     = (int) $request->input('watermark_size', 24);

    $image->text($text, ...positionToCoords($image, $position), function ($font) use ($size, $opacity) {
        $font->size($size);
        $font->color([255, 255, 255, $opacity / 100]);
        $font->align('right');
        $font->valign('bottom');
    });
}
```

---

### T2-6 · URL-based Compression

**Priority:** 🟡 Medium  
**Effort:** ~3 hours  
**Status:** `[ ]`

#### Why
*"compress image from url"* — removes the download-then-upload friction.

#### Implementation
```php
public function compressFromUrl(Request $request): JsonResponse
{
    $request->validate(['url' => 'required|url|max:2048']);

    $url = $request->input('url');

    // SSRF protection: block private IPs
    $host = parse_url($url, PHP_URL_HOST);
    if (filter_var(gethostbyname($host), FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return response()->json(['success' => false, 'message' => 'Invalid URL.'], 422);
    }

    $response = Http::timeout(10)->get($url);
    $mime     = $response->header('Content-Type');

    if (!in_array(explode(';', $mime)[0], self::ALLOWED_MIMES)) {
        return response()->json(['success' => false, 'message' => 'URL does not point to a supported image.'], 422);
    }

    // Write to temp file, run through existing compress logic
    $tmpPath = storage_path('app/temp-uploads/url-' . Str::random(12) . '.tmp');
    file_put_contents($tmpPath, $response->body());

    // ... rest of compress pipeline ...
}
```

Add a second upload option below the dropzone:
```html
<div class="mt-4 flex gap-2">
    <input type="url" x-model="imageUrl" placeholder="Or paste an image URL..." class="...">
    <button x-on:click="compressFromUrl()">Fetch</button>
</div>
```

---

### T2-7 · Admin Dashboard Upgrade

**Priority:** 🟡 Medium  
**Effort:** ~5 hours  
**Status:** `[ ]`

#### New metrics to add

| Metric | Query |
|---|---|
| Total data saved (all time) | `SUM(original_size - compressed_size)` |
| Average file reduction | `AVG(reduction_percent)` |
| Most popular input format | `GROUP BY original_format ORDER BY count DESC` |
| Most popular output format | `GROUP BY output_format ORDER BY count DESC` |
| Operations per hour (today) | `GROUP BY HOUR(created_at)` |
| Top 10 user agents | `GROUP BY user_agent` |

#### New DB column to add
```php
$table->string('referrer', 500)->nullable();  // for traffic source analysis
$table->string('action', 10)->default('compress');  // 'compress' or 'convert' or 'resize'
```

#### Export CSV
```php
public function export(Request $request)
{
    return response()->streamDownload(function () {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID','Date','Action','Format','Original KB','Compressed KB','Reduction %','IP']);

        CompressionReport::orderByDesc('id')->chunk(500, function ($rows) use ($handle) {
            foreach ($rows as $row) {
                fputcsv($handle, [
                    $row->id, $row->created_at->format('Y-m-d H:i'),
                    $row->action ?? 'compress',
                    $row->original_format . '→' . $row->output_format,
                    round($row->original_size / 1024, 1),
                    round($row->compressed_size / 1024, 1),
                    $row->reduction_percent,
                    $row->ip_address,
                ]);
            }
        });
        fclose($handle);
    }, 'compresslypro-reports-' . now()->format('Y-m-d') . '.csv', [
        'Content-Type' => 'text/csv',
    ]);
}
```

---

## Tier 3 — Strategic / Moat Features {#tier-3}

> **Goal:** These create defensible advantages, recurring traffic, and monetisation opportunities.

---

### T3-1 · REST API with API Keys

**Priority:** 🟡 High (monetisation path)  
**Effort:** ~10 hours  
**Status:** `[ ]`

#### Why
Developers want to integrate compression into their CMS, e-commerce, or CI pipeline.  
Creates B2B leads, backlinks from developer blogs, and a paid tier opportunity.

#### Database
```sql
CREATE TABLE api_keys (
    id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id       BIGINT UNSIGNED NULL,           -- NULL = anonymous key
    name          VARCHAR(100) NOT NULL,
    key           CHAR(64) NOT NULL UNIQUE,       -- sha256 hex
    requests_today INT UNSIGNED DEFAULT 0,
    requests_month INT UNSIGNED DEFAULT 0,
    daily_limit   INT UNSIGNED DEFAULT 100,
    monthly_limit INT UNSIGNED DEFAULT 1000,
    last_used_at  TIMESTAMP NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (key)
);
```

#### Middleware
```php
// app/Http/Middleware/ApiKeyAuth.php
public function handle(Request $request, Closure $next): Response
{
    $key = ApiKey::where('key', hash('sha256', $request->bearerToken()))->first();

    if (!$key) {
        return response()->json(['error' => 'Invalid API key.'], 401);
    }
    if ($key->requests_today >= $key->daily_limit) {
        return response()->json(['error' => 'Daily limit exceeded.'], 429);
    }

    $key->increment('requests_today');
    $key->increment('requests_month');
    $key->update(['last_used_at' => now()]);

    $request->merge(['api_key' => $key]);
    return $next($request);
}
```

#### API endpoints
```
POST /v1/compress          — compress image, returns JSON + download_url
POST /v1/convert           — convert format
POST /v1/resize            — resize image
GET  /v1/usage             — current key usage stats
```

#### Example response
```json
{
    "success": true,
    "original_size": 2457600,
    "compressed_size": 312456,
    "reduction_percent": 87.3,
    "format": "WEBP",
    "download_url": "https://compresslypro.com/dl/compresslypro-photo.webp",
    "expires_in": "30 minutes"
}
```

---

### T3-2 · Shareable Result Pages

**Priority:** 🟡 Medium (viral growth)  
**Effort:** ~5 hours  
**Status:** `[ ]`

#### Why
User compresses a 5MB photo to 320KB. They want to share the impressive result.  
`compresslypro.com/r/abc123` → page showing before/after stats + "Try it yourself" CTA.

#### Database
```sql
CREATE TABLE share_results (
    id           BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    token        CHAR(12) NOT NULL UNIQUE,
    original_name VARCHAR(255),
    original_size BIGINT UNSIGNED,
    compressed_size BIGINT UNSIGNED,
    reduction_percent DECIMAL(5,1),
    format       VARCHAR(10),
    width        SMALLINT UNSIGNED NULL,
    height       SMALLINT UNSIGNED NULL,
    expires_at   TIMESTAMP NOT NULL,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (token),
    INDEX (expires_at)
);
```

#### Controller
```php
// After successful compress, optionally generate share link:
$share = ShareResult::create([
    'token'             => Str::random(12),
    'original_size'     => $originalSize,
    'compressed_size'   => $compressedSize,
    'reduction_percent' => $reduction,
    'format'            => strtoupper($outputExt),
    'expires_at'        => now()->addHours(24),
]);

// Include in JSON response:
'share_url' => route('share.show', $share->token),
```

#### Share page `GET /r/{token}`
- Shows animated stats: "**87% smaller** · 2.3 MB → 312 KB"
- Big "Compress Your Images Free →" CTA button
- OG meta tags so it previews nicely on Slack/Twitter

---

### T3-3 · Dark Mode (Proper Implementation)

**Priority:** 🟡 Medium  
**Effort:** ~4 hours  
**Status:** `[ ]`

#### Implementation strategy
Use `prefers-color-scheme` as default + optional manual toggle saved to `localStorage`.

```javascript
// In <head>, before Tailwind loads (prevents flash)
(function() {
    const stored = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (stored === 'dark' || (!stored && prefersDark)) {
        document.documentElement.classList.add('dark');
    }
})();
```

Tailwind config: `darkMode: 'class'` (already removed — re-add).

Toggle button in navbar:
```html
<button x-on:click="toggleDark()" class="...">
    <svg x-show="!dark">☀️ sun icon</svg>
    <svg x-show="dark">🌙 moon icon</svg>
</button>
```

---

### T3-4 · Browser Extension

**Priority:** 🟢 Low (high payoff, high effort)  
**Effort:** ~20 hours  
**Status:** `[ ]`

#### Why
Right-click any image on any website → "Compress with CompresslyPro".  
Available on Chrome Web Store = free ongoing distribution channel.

#### Architecture
- Manifest V3 Chrome extension
- Context menu item injected on `<img>` elements
- Popup: drag-and-drop UI mirroring the website
- Calls `https://compresslypro.com/v1/compress` (needs API — build T3-1 first)

#### Files needed
```
extension/
  manifest.json
  background.js      — service worker, handles API calls
  content.js         — injects context menu
  popup.html         — mini compressor UI
  popup.js
  icons/             — 16, 32, 48, 128px
```

---

## Technical Debt & Infrastructure {#technical-debt}

| Item | Priority | Notes |
|---|---|---|
| `storage:link` verified in deployment | 🔴 Critical | `php artisan storage:link` must run on deploy |
| Queue worker for large files | 🟡 Medium | Move processing to `dispatch(new CompressImageJob(...))` for files >5MB to prevent timeout |
| Image processing jobs (Queue) | 🟡 Medium | Use `database` or `redis` queue driver |
| Error logging (Sentry) | 🟡 Medium | `composer require sentry/sentry-laravel` |
| Automated tests | 🟡 Medium | Feature tests for compress/convert/chunk endpoints |
| Rate limiting per-route tuning | 🟡 Medium | Current: 30/min compress, 120/min chunk — review under load |
| `.env` validation on boot | 🟡 Low | Fail loudly if `API_SLUG_*` vars are missing |
| CDN / object storage | 🟢 Low | Move uploads to S3/R2 for scale — use `Storage::disk('s3')` |

---

## SEO Keyword Targets by Feature {#seo-keywords}

| Feature | Primary Keyword | Monthly Volume | Difficulty |
|---|---|---|---|
| Compress (current) | image compressor online free | 450K | Hard |
| Compress (current) | compress jpg online | 165K | Medium |
| Convert (current) | convert jpg to png | 201K | Medium |
| Resize (T2-2) | resize image online | 1.8M | Hard |
| Image → PDF (T2-3) | jpg to pdf | 3.1M | Hard |
| PDF → Image (T2-4) | pdf to jpg | 2.4M | Hard |
| Strip EXIF (T1-5) | remove exif data online | 90K | Low |
| AVIF (T1-4) | convert to avif | 27K | Low |
| Watermark (T2-5) | add watermark to image | 110K | Medium |
| URL compress (T2-6) | compress image from url | 22K | Low |
| Batch (T2-1) | compress multiple images | 60K | Low |
| API (T3-1) | image compression api | 40K | Low |

---

## Database Schema Evolution {#database-schema}

### Current schema

```
compression_reports: id, original_name, original_format, output_format,
                     original_size, compressed_size, reduction_percent,
                     quality, width, height, ip_address, user_agent, timestamps
```

### Planned additions (in order)

```sql
-- Sprint 1
ALTER TABLE compression_reports ADD COLUMN action VARCHAR(10) DEFAULT 'compress';
ALTER TABLE compression_reports ADD COLUMN referrer VARCHAR(500) NULL;
ALTER TABLE compression_reports ADD COLUMN batch_id VARCHAR(32) NULL;

-- Sprint 2
CREATE TABLE share_results (...);   -- T3-2
CREATE TABLE api_keys (...);        -- T3-1

-- Sprint 3
CREATE TABLE resize_reports (...);  -- T2-2 (or reuse compression_reports with action='resize')
```

---

## Implementation Order (Sprint Plan) {#sprint-plan}

### Sprint 1 — Foundation (Week 1) ~8 hours
- [ ] T1-1: Auto image cleanup command + cron
- [ ] T1-3: Copy to clipboard button
- [ ] T1-5: Strip EXIF metadata display
- [ ] T1-4: AVIF format support
- [ ] T2-7: Admin dashboard upgrade (export CSV, referrer column)

### Sprint 2 — UX Upgrade (Week 2) ~10 hours
- [ ] T1-2: Before/After preview slider
- [ ] T2-1: Batch upload + ZIP download
- [ ] T2-6: URL-based compression

### Sprint 3 — New Tools (Week 3–4) ~12 hours
- [ ] T2-2: Image resize tool (new tab)
- [ ] T2-3: Image → PDF (add to Convert tab)
- [ ] T2-4: PDF → Image (add to Convert tab)

### Sprint 4 — Monetisation (Week 5–6) ~15 hours
- [ ] T3-1: REST API with API keys
- [ ] T2-5: Watermark tool
- [ ] T3-2: Shareable result pages

### Sprint 5 — Polish & Growth (Week 7+) ~20 hours
- [ ] T3-3: Dark mode (proper)
- [ ] T3-4: Browser extension
- [ ] Queue worker for large file processing
- [ ] Sentry error monitoring

---

## Quick Reference — New Files to Create

```
app/Console/Commands/CleanupImages.php       T1-1
app/Http/Controllers/ResizeController.php    T2-2
app/Http/Controllers/PdfController.php       T2-3, T2-4
app/Http/Controllers/ApiController.php       T3-1
app/Http/Middleware/ApiKeyAuth.php           T3-1
app/Models/ApiKey.php                        T3-1
app/Models/ShareResult.php                   T3-2
app/Jobs/CompressImageJob.php                (infra)
resources/views/share.blade.php              T3-2
resources/views/api-docs.blade.php           T3-1
database/migrations/*_add_batch_id_*.php     T2-1
database/migrations/*_create_api_keys_*.php  T3-1
database/migrations/*_create_share_*.php     T3-2
public/extension/                            T3-4
```

---

*Last updated: 2026-03-02 — CompresslyPro v1.0*
