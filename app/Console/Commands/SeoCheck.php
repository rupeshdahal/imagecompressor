<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeoCheck extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'seo:check
                            {--base= : Base URL to test (defaults to APP_URL)}
                            {--timeout=12 : HTTP timeout in seconds}
                            {--public-only : Skip utility/non-indexable URL checks}';

    /**
     * The console command description.
     */
    protected $description = 'Audit canonical and indexing signals for key URLs';

    public function handle(): int
    {
        $base = rtrim((string) ($this->option('base') ?: config('app.url')), '/');
        if ($base === '') {
            $this->error('Missing base URL. Set APP_URL or pass --base=https://example.com');
            return self::FAILURE;
        }

        $timeout = max(3, (int) $this->option('timeout'));

        $publicPaths = [
            '/',
            '/tools/compress',
            '/tools/convert',
            '/tools/resize',
            '/tools/batch-compress',
            '/tools/watermark',
            '/tools/image-to-pdf',
            '/tools/pdf-to-image',
            '/blog',
            '/about',
            '/contact',
            '/privacy-policy',
            '/terms',
        ];

        $checks = [];
        foreach ($publicPaths as $path) {
            $checks[] = ['path' => $path, 'expectsNoindex' => false, 'expectsCanonical' => true];
        }

        if (! $this->option('public-only')) {
            $apiSlug = (string) config('api_routes.compress');
            $utilityPaths = [
                '/authorize',
                '/login',
                '/admin/login',
                '/api/' . $apiSlug,
                '/dl/does-not-exist.jpg',
                '/pdf/does-not-exist.pdf',
                '/this-page-should-404',
            ];

            foreach ($utilityPaths as $path) {
                $checks[] = ['path' => $path, 'expectsNoindex' => true, 'expectsCanonical' => false];
            }
        }

        $client = new Client([
            'timeout' => $timeout,
            'http_errors' => false,
            'allow_redirects' => [
                'max' => 10,
                'strict' => true,
                'referer' => true,
                'track_redirects' => true,
            ],
            'headers' => [
                'User-Agent' => 'CompresslyPro-SEO-Audit/1.0 (+https://compresslypro.com)',
                'Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8',
            ],
        ]);

        $rows = [];
        $failed = 0;

        foreach ($checks as $check) {
            $url = $base . $check['path'];

            try {
                $response = $client->request('GET', $url);
                $status = (int) $response->getStatusCode();
                $body = (string) $response->getBody();
                $contentType = strtolower((string) $response->getHeaderLine('Content-Type'));
                $xRobots = strtolower((string) $response->getHeaderLine('X-Robots-Tag'));

                $redirectHistory = $response->getHeader('X-Guzzle-Redirect-History');
                $effectiveUrl = count($redirectHistory) > 0
                    ? end($redirectHistory)
                    : $url;

                $canonical = $this->extractMetaUrl($body, 'canonical');
                $ogUrl = $this->extractMetaUrl($body, 'og:url');

                $issues = [];

                if ($status >= 500) {
                    $issues[] = 'server-error';
                }

                if (! $check['expectsNoindex'] && $status >= 400) {
                    $issues[] = 'public-4xx';
                }

                $isHtml = Str::contains($contentType, 'text/html') || Str::contains($contentType, 'application/xhtml+xml');

                if ($check['expectsCanonical'] && $isHtml) {
                    if ($canonical === null) {
                        $issues[] = 'missing-canonical';
                    } else {
                        $normalizedCanonical = $this->normalizeUrl($canonical);
                        $normalizedEffective = $this->normalizeUrl($effectiveUrl);
                        if ($normalizedCanonical !== $normalizedEffective) {
                            $issues[] = 'canonical-mismatch';
                        }
                    }

                    if ($ogUrl === null) {
                        $issues[] = 'missing-og-url';
                    } elseif ($canonical !== null && $this->normalizeUrl($ogUrl) !== $this->normalizeUrl($canonical)) {
                        $issues[] = 'og-canonical-mismatch';
                    }

                    if ($xRobots !== '' && Str::contains($xRobots, 'noindex')) {
                        $issues[] = 'unexpected-noindex';
                    }
                }

                if ($check['expectsNoindex'] && ! Str::contains($xRobots, 'noindex')) {
                    $issues[] = 'missing-noindex';
                }

                $result = count($issues) === 0 ? 'PASS' : 'FAIL';
                if ($result === 'FAIL') {
                    $failed++;
                }

                $rows[] = [
                    $result,
                    $check['path'],
                    (string) $status,
                    $canonical ?? '-',
                    $ogUrl ?? '-',
                    $xRobots !== '' ? $xRobots : '-',
                    count($issues) > 0 ? implode(',', $issues) : '-',
                ];
            } catch (\Throwable $e) {
                $failed++;
                $rows[] = ['FAIL', $check['path'], 'ERR', '-', '-', '-', 'request-failed'];
                $this->warn('Request failed for ' . $url . ': ' . $e->getMessage());
            }
        }

        $this->table(
            ['Result', 'Path', 'Status', 'Canonical', 'OG URL', 'X-Robots-Tag', 'Issues'],
            $rows
        );

        if ($failed > 0) {
            $this->error("SEO checks failed: {$failed} URL(s) need attention.");
            return self::FAILURE;
        }

        $this->info('SEO checks passed: canonical, OG URL, status codes, and robots signals look healthy.');
        return self::SUCCESS;
    }

    /**
     * Extract canonical or og:url from HTML.
     */
    private function extractMetaUrl(string $html, string $type): ?string
    {
        if ($html === '') {
            return null;
        }

        if ($type === 'canonical') {
            if (preg_match('/<link[^>]*rel=["\']canonical["\'][^>]*href=["\']([^"\']+)["\'][^>]*>/i', $html, $m)) {
                return trim($m[1]);
            }
            if (preg_match('/<link[^>]*href=["\']([^"\']+)["\'][^>]*rel=["\']canonical["\'][^>]*>/i', $html, $m)) {
                return trim($m[1]);
            }

            return null;
        }

        if ($type === 'og:url') {
            if (preg_match('/<meta[^>]*property=["\']og:url["\'][^>]*content=["\']([^"\']+)["\'][^>]*>/i', $html, $m)) {
                return trim($m[1]);
            }
            if (preg_match('/<meta[^>]*content=["\']([^"\']+)["\'][^>]*property=["\']og:url["\'][^>]*>/i', $html, $m)) {
                return trim($m[1]);
            }
        }

        return null;
    }

    /**
     * Normalize URL to reduce false mismatches.
     */
    private function normalizeUrl(string $url): string
    {
        $parts = parse_url(trim($url));
        if (! is_array($parts)) {
            return rtrim(trim($url), '/');
        }

        $scheme = strtolower((string) ($parts['scheme'] ?? 'https'));
        $host = strtolower((string) ($parts['host'] ?? ''));
        $path = (string) ($parts['path'] ?? '/');
        $query = isset($parts['query']) && $parts['query'] !== '' ? '?' . $parts['query'] : '';

        $path = $path === '/' ? '/' : rtrim($path, '/');

        return $scheme . '://' . $host . $path . $query;
    }
}
