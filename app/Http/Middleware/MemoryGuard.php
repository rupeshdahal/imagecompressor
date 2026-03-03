<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * MemoryGuard Middleware
 *
 * Sets a conservative, file-size-proportional PHP memory limit for every
 * image-processing request so a single large upload cannot OOM the server.
 *
 * Budget formula (tuned for low-RAM AWS instances):
 *   - Base overhead:  64 MB   (Laravel + libraries)
 *   - Per-byte factor: ×6     (GD/Imagick worst case: raw RGBA + encode buffer)
 *   - Minimum:        96 MB
 *   - Hard ceiling:  256 MB   (change via MEMORY_GUARD_MAX_MB in .env)
 *
 * For a 10 MB PNG worst-case: 64 + (10×6) = 124 MB → well under 256 MB.
 * For a 20 MB PNG worst-case: 64 + (20×6) = 184 MB → well under 256 MB.
 */
class MemoryGuard
{
    /** Base overhead in MB (Laravel bootstrap + libraries). */
    private const BASE_MB = 64;

    /** Bytes-to-MB expansion factor for image decoding + re-encoding. */
    private const EXPAND_FACTOR = 6;

    /** Minimum memory limit in MB. */
    private const MIN_MB = 96;

    public function handle(Request $request, Closure $next): Response
    {
        $maxMb  = (int) env('MEMORY_GUARD_MAX_MB', 256);
        $fileMb = $this->largestUploadMb($request);
        $needed = self::BASE_MB + (int) ceil($fileMb * self::EXPAND_FACTOR);
        $limit  = max(self::MIN_MB, min($needed, $maxMb));

        ini_set('memory_limit', $limit . 'M');

        return $next($request);
    }

    /** Returns the size of the largest uploaded file in MB (0 if none). */
    private function largestUploadMb(Request $request): float
    {
        $maxBytes = 0;
        foreach ($request->allFiles() as $file) {
            $files = is_array($file) ? $file : [$file];
            foreach ($files as $f) {
                if ($f && method_exists($f, 'getSize')) {
                    $maxBytes = max($maxBytes, (int) $f->getSize());
                }
            }
        }
        // Also check Content-Length header for chunked JSON requests
        $contentLength = (int) $request->header('Content-Length', 0);
        $maxBytes = max($maxBytes, $contentLength);

        return $maxBytes / (1024 * 1024);
    }
}
