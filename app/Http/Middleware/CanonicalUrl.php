<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanonicalUrl
{
    /**
     * Enforce a single canonical scheme/host/path format for crawlable GET URLs.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET') && ! $request->isMethod('HEAD')) {
            return $next($request);
        }

        $appUrl = (string) config('app.url', '');
        if ($appUrl === '') {
            return $next($request);
        }

        $parts = parse_url($appUrl);
        $canonicalHost = $parts['host'] ?? null;
        $canonicalScheme = $parts['scheme'] ?? null;
        $basePath = isset($parts['path']) ? rtrim($parts['path'], '/') : '';

        if (! $canonicalHost || ! $canonicalScheme) {
            return $next($request);
        }

        $currentHost = (string) $request->getHost();
        $currentScheme = (string) $request->getScheme();
        $currentPath = $request->getPathInfo();
        $normalizedPath = $currentPath === '/' ? '/' : rtrim($currentPath, '/');

        $hostMismatch = strcasecmp($currentHost, $canonicalHost) !== 0;
        $schemeMismatch = strcasecmp($currentScheme, $canonicalScheme) !== 0;
        $pathMismatch = $currentPath !== $normalizedPath;

        if (! $hostMismatch && ! $schemeMismatch && ! $pathMismatch) {
            return $next($request);
        }

        $canonicalPath = $normalizedPath;
        if ($basePath !== '') {
            $canonicalPath = $canonicalPath === '/'
                ? $basePath
                : $basePath . $canonicalPath;
        }

        $url = $canonicalScheme . '://' . $canonicalHost . ($canonicalPath === '' ? '/' : $canonicalPath);
        $query = (string) $request->server('QUERY_STRING', '');
        if ($query !== '') {
            $url .= '?' . $query;
        }

        return redirect()->to($url, 301);
    }
}