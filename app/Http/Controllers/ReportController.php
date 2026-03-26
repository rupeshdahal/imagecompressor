<?php

namespace App\Http\Controllers;

use App\Models\CompressionReport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Show the reports dashboard page.
     */
    public function index()
    {
        return view('admin.reports');
    }

    /**
     * Get reports data via AJAX.
     */
    public function data(Request $request): JsonResponse
    {
        $period = $request->get('period', '7d');
        $action = trim((string) $request->get('action', 'all'));
        $format = strtolower(trim((string) $request->get('format', 'all')));
        $page = max(1, (int) $request->get('page', 1));
        $perPage = (int) $request->get('per_page', 15);
        $perPage = in_array($perPage, [10, 15, 20, 30, 50], true) ? $perPage : 15;

        $startDate = match ($period) {
            '24h'  => Carbon::now()->subHours(24),
            '7d'   => Carbon::now()->subDays(7),
            '30d'  => Carbon::now()->subDays(30),
            '90d'  => Carbon::now()->subDays(90),
            'all'  => Carbon::create(2020, 1, 1),
            default => Carbon::now()->subDays(7),
        };

        $baseReports = CompressionReport::where('created_at', '>=', $startDate);

        $reports = $this->applyReportFilters(clone $baseReports, $action, $format);

        $availableActions = (clone $baseReports)
            ->select('action')
            ->distinct()
            ->pluck('action')
            ->map(fn ($item) => $item ?: 'compress')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $availableFormats = collect()
            ->merge(
                (clone $baseReports)
                    ->whereNotNull('original_format')
                    ->distinct()
                    ->pluck('original_format')
                    ->map(fn ($item) => strtolower((string) $item))
            )
            ->merge(
                (clone $baseReports)
                    ->whereNotNull('output_format')
                    ->distinct()
                    ->pluck('output_format')
                    ->map(fn ($item) => strtolower((string) $item))
            )
            ->filter()
            ->unique()
            ->sort()
            ->values();

        // Summary stats
        $totalCompressions = (clone $reports)->count();
        $totalOriginalSize = (clone $reports)->sum('original_size');
        $totalCompressedSize = (clone $reports)->sum('compressed_size');
        $totalSaved = $totalOriginalSize - $totalCompressedSize;
        $avgReduction = (clone $reports)->avg('reduction_percent') ?? 0;

        $todayStart = Carbon::today();
        $todayEnd = Carbon::tomorrow();
        $yesterdayStart = Carbon::yesterday();

        $todayReports = (clone $reports)
            ->where('created_at', '>=', $todayStart)
            ->where('created_at', '<', $todayEnd);
        $todayCount = (clone $todayReports)->count();
        $todayOriginal = (clone $todayReports)->sum('original_size');
        $todayCompressed = (clone $todayReports)->sum('compressed_size');
        $todaySaved = max(0, $todayOriginal - $todayCompressed);
        $todayUniqueUsers = (clone $todayReports)
            ->whereNotNull('ip_address')
            ->distinct('ip_address')
            ->count('ip_address');

        $yesterdayReports = (clone $reports)
            ->where('created_at', '>=', $yesterdayStart)
            ->where('created_at', '<', $todayStart);
        $yesterdayCount = (clone $yesterdayReports)->count();
        $yesterdayOriginal = (clone $yesterdayReports)->sum('original_size');
        $yesterdayCompressed = (clone $yesterdayReports)->sum('compressed_size');
        $yesterdaySaved = max(0, $yesterdayOriginal - $yesterdayCompressed);

        $lastSevenDaysCount = (clone $reports)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();
        $lastSevenDaysOriginal = (clone $reports)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->sum('original_size');
        $lastSevenDaysCompressed = (clone $reports)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->sum('compressed_size');
        $avgDailyCountLast7 = round($lastSevenDaysCount / 7, 1);
        $avgDailySavedLast7 = max(0, $lastSevenDaysOriginal - $lastSevenDaysCompressed) / 7;

        $uniqueUsers = (clone $reports)
            ->whereNotNull('ip_address')
            ->distinct('ip_address')
            ->count('ip_address');

        $uniqueClients = (clone $reports)
            ->whereNotNull('ip_address')
            ->select('ip_address', 'user_agent')
            ->distinct()
            ->get()
            ->count();

        // Compressions by day
        $dailyStats = (clone $reports)
            ->select(
                DB::raw("DATE(created_at) as date"),
                DB::raw("COUNT(*) as count"),
                DB::raw("SUM(original_size) as total_original"),
                DB::raw("SUM(compressed_size) as total_compressed"),
                DB::raw("AVG(reduction_percent) as avg_reduction")
            )
            ->groupBy(DB::raw("DATE(created_at)"))
            ->orderBy('date')
            ->get();

        // Format breakdown
        $formatStats = (clone $reports)
            ->select(
                'original_format',
                DB::raw("COUNT(*) as count"),
                DB::raw("AVG(reduction_percent) as avg_reduction")
            )
            ->groupBy('original_format')
            ->get();

        // Output format breakdown
        $outputFormatStats = (clone $reports)
            ->select(
                'output_format',
                DB::raw("COUNT(*) as count")
            )
            ->groupBy('output_format')
            ->get();

        // Quality distribution
        $qualityStats = (clone $reports)
            ->select(
                DB::raw("CASE
                    WHEN quality <= 30 THEN 'High Compression (10-30%)'
                    WHEN quality <= 60 THEN 'Balanced (31-60%)'
                    ELSE 'High Quality (61-90%)'
                END as quality_range"),
                DB::raw("COUNT(*) as count")
            )
            ->groupBy('quality_range')
            ->get();

        // Action distribution
        $actionStats = (clone $reports)
            ->select(
                DB::raw("COALESCE(action, 'compress') as action"),
                DB::raw("COUNT(*) as count")
            )
            ->groupBy(DB::raw("COALESCE(action, 'compress')"))
            ->orderByDesc('count')
            ->get();

        // Country distribution (falls back to IP-based country when country is empty)
        $countryRows = (clone $reports)
            ->select('country', 'ip_address', 'reduction_percent')
            ->get();

        $countryBuckets = [];
        foreach ($countryRows as $row) {
            $code = $this->resolveCountryCode($row->country, $row->ip_address);
            if (!isset($countryBuckets[$code])) {
                $countryBuckets[$code] = [
                    'country' => $code,
                    'count' => 0,
                    'reduction_sum' => 0.0,
                ];
            }

            $countryBuckets[$code]['count']++;
            $countryBuckets[$code]['reduction_sum'] += (float) ($row->reduction_percent ?? 0);
        }

        $uniqueCountries = collect($countryBuckets)
            ->keys()
            ->filter(fn ($code) => $code !== 'ZZ')
            ->count();

        $countryStats = collect($countryBuckets)
            ->map(function (array $bucket) {
                $count = max(1, (int) $bucket['count']);
                return [
                    'country' => $bucket['country'],
                    'count' => $bucket['count'],
                    'avg_reduction' => round($bucket['reduction_sum'] / $count, 1),
                ];
            })
            ->sortByDesc('count')
            ->take(10)
            ->values();

        // Top IP activity
        $ipStats = (clone $reports)
            ->whereNotNull('ip_address')
            ->select(
                'ip_address',
                DB::raw("COUNT(*) as count"),
                DB::raw("AVG(reduction_percent) as avg_reduction"),
                DB::raw("SUM(original_size) as total_original"),
                DB::raw("SUM(compressed_size) as total_compressed")
            )
            ->groupBy('ip_address')
            ->orderByDesc('count')
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $saved = max(0, (int) $item->total_original - (int) $item->total_compressed);
                return [
                    'ip_address' => $this->maskIpAddress($item->ip_address),
                    'count' => (int) $item->count,
                    'avg_reduction' => round((float) $item->avg_reduction, 1) . '%',
                    'saved' => $this->formatBytes($saved),
                ];
            });

        // Recent compressions
        $recentPaginator = (clone $reports)
            ->orderByDesc('created_at')
            ->paginate($perPage, ['*'], 'page', $page);

        $recentCompressions = collect($recentPaginator->items())
            ->map(function ($r) {
                $nameWithoutExt = pathinfo($r->original_name, PATHINFO_FILENAME);
                $safeName = Str::slug(Str::limit($nameWithoutExt, 50, '')) ?: 'image';
                $filename = "compresslypro-{$safeName}.{$r->output_format}";
                $exists = Storage::disk('public')->exists("uploads/{$filename}");

                return [
                    'id'              => $r->id,
                    'original_name'   => $r->original_name,
                    'preview_url'     => $exists ? Storage::url("uploads/{$filename}") : null,
                    'original_format' => strtoupper($r->original_format),
                    'output_format'   => strtoupper($r->output_format),
                    'original_size'   => $this->formatBytes($r->original_size),
                    'compressed_size' => $this->formatBytes($r->compressed_size),
                    'reduction'       => $r->reduction_percent . '%',
                    'quality'         => $r->quality . '%',
                    'dimensions'      => ($r->width && $r->height) ? "{$r->width}×{$r->height}" : '—',
                    'created_at'      => $r->created_at->diffForHumans(),
                    'created_date'    => $r->created_at->format('M d, Y H:i'),
                    'action'          => $r->action ?? 'compress',
                    'batch_id'        => $r->batch_id,
                    'ip_address'      => $this->maskIpAddress($r->ip_address),
                    'country'         => $this->resolveCountryCode($r->country, $r->ip_address),
                ];
            });

        // Top size savings
        $topSavings = $this->applyReportFilters(CompressionReport::where('created_at', '>=', $startDate), $action, $format)
            ->whereColumn('original_size', '>=', 'compressed_size')
            ->orderByRaw('(CAST(original_size AS SIGNED) - CAST(compressed_size AS SIGNED)) DESC')
            ->limit(5)
            ->get()
            ->map(function ($r) {
                $saved = max(0, $r->original_size - $r->compressed_size);
                return [
                    'original_name' => $r->original_name,
                    'saved'         => $this->formatBytes($saved),
                    'reduction'     => $r->reduction_percent . '%',
                ];
            });

        return response()->json([
            'summary' => [
                'total_compressions'  => $totalCompressions,
                'total_original_size' => $this->formatBytes($totalOriginalSize),
                'total_compressed'    => $this->formatBytes($totalCompressedSize),
                'total_saved'         => $this->formatBytes($totalSaved),
                'avg_reduction'       => round($avgReduction, 1) . '%',
                'total_saved_bytes'   => $totalSaved,
            ],
            'daily_overview' => [
                'today_count' => $todayCount,
                'today_saved' => $this->formatBytes($todaySaved),
                'today_unique_users' => $todayUniqueUsers,
                'yesterday_count' => $yesterdayCount,
                'yesterday_saved' => $this->formatBytes($yesterdaySaved),
                'avg_daily_count_last_7d' => $avgDailyCountLast7,
                'avg_daily_saved_last_7d' => $this->formatBytes($avgDailySavedLast7),
            ],
            'audience' => [
                'unique_users' => $uniqueUsers,
                'unique_clients' => $uniqueClients,
                'unique_countries' => $uniqueCountries,
            ],
            'filters' => [
                'selected' => [
                    'period' => $period,
                    'action' => $action,
                    'format' => $format,
                ],
                'available_actions' => $availableActions,
                'available_formats' => $availableFormats,
            ],
            'daily_stats'        => $dailyStats,
            'format_stats'       => $formatStats,
            'output_format_stats' => $outputFormatStats,
            'quality_stats'      => $qualityStats,
            'action_stats'       => $actionStats,
            'country_stats'      => $countryStats,
            'ip_stats'           => $ipStats,
            'recent'             => $recentCompressions,
            'recent_pagination'  => [
                'current_page' => $recentPaginator->currentPage(),
                'last_page' => $recentPaginator->lastPage(),
                'per_page' => $recentPaginator->perPage(),
                'total' => $recentPaginator->total(),
                'from' => $recentPaginator->firstItem() ?? 0,
                'to' => $recentPaginator->lastItem() ?? 0,
            ],
            'top_savings'        => $topSavings,
        ]);
    }

    /**
     * Export all reports as a CSV file.
     */
    public function export(Request $request)
    {
        $period = $request->get('period', 'all');
        $action = trim((string) $request->get('action', 'all'));
        $format = strtolower(trim((string) $request->get('format', 'all')));

        $startDate = match ($period) {
            '24h'  => \Carbon\Carbon::now()->subHours(24),
            '7d'   => \Carbon\Carbon::now()->subDays(7),
            '30d'  => \Carbon\Carbon::now()->subDays(30),
            '90d'  => \Carbon\Carbon::now()->subDays(90),
            default => \Carbon\Carbon::create(2020, 1, 1),
        };

        $filename = 'compression-reports-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control'       => 'no-cache, must-revalidate',
            'Pragma'              => 'no-cache',
        ];

        $callback = function () use ($startDate, $action, $format) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'ID', 'Action', 'Original Name', 'Original Format', 'Output Format',
                'Original Size (bytes)', 'Compressed Size (bytes)', 'Reduction (%)',
                'Quality', 'Width', 'Height', 'Batch ID', 'IP Address', 'Country', 'Date',
            ]);

            $this->applyReportFilters(CompressionReport::where('created_at', '>=', $startDate), $action, $format)
                ->orderByDesc('created_at')
                ->chunk(500, function ($rows) use ($handle) {
                    foreach ($rows as $r) {
                        fputcsv($handle, [
                            $r->id,
                            $r->action ?? 'compress',
                            $r->original_name,
                            $r->original_format,
                            $r->output_format,
                            $r->original_size,
                            $r->compressed_size,
                            $r->reduction_percent,
                            $r->quality,
                            $r->width ?? '',
                            $r->height ?? '',
                            $r->batch_id ?? '',
                            $r->ip_address ?? '',
                            $this->resolveCountryCode($r->country, $r->ip_address),
                            $r->created_at->format('Y-m-d H:i:s'),
                        ]);
                    }
                });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Format bytes to human-readable.
     */
    private function formatBytes(int|float $bytes, int $precision = 2): string
    {
        if ($bytes <= 0) return '0 B';
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $index = 0;
        $size = (float) $bytes;
        while ($size >= 1024 && $index < count($units) - 1) {
            $size /= 1024;
            $index++;
        }
        return round($size, $precision) . ' ' . $units[$index];
    }

    /**
     * Mask IP address for safer display in admin analytics.
     */
    private function maskIpAddress(?string $ip): string
    {
        if (!$ip) {
            return '—';
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $parts = explode('.', $ip);
            if (count($parts) === 4) {
                return $parts[0] . '.' . $parts[1] . '.x.x';
            }
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $parts = explode(':', $ip);
            return implode(':', array_slice($parts, 0, 3)) . ':xxxx:xxxx';
        }

        return 'masked';
    }

    /**
     * Resolve country code from stored value, with IP fallback when empty.
     */
    private function resolveCountryCode(?string $country, ?string $ip): string
    {
        $stored = strtoupper(trim((string) $country));
        if (preg_match('/^[A-Z]{2}$/', $stored)) {
            return $stored;
        }

        return $this->countryFromIp($ip);
    }

    /**
     * Determine country code from IP using local extension if available.
     */
    private function countryFromIp(?string $ip): string
    {
        if (!$ip) {
            return 'ZZ';
        }

        $isPublicIp = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
        if ($isPublicIp === false) {
            return 'LOCAL';
        }

        if (function_exists('geoip_country_code_by_name')) {
            $resolver = 'geoip_country_code_by_name';
            $code = @$resolver($ip);
            if (is_string($code) && preg_match('/^[A-Z]{2}$/', strtoupper($code))) {
                return strtoupper($code);
            }
        }

        return 'ZZ';
    }

    /**
     * Apply action/format filters to reports queries.
     */
    private function applyReportFilters(Builder $query, string $action, string $format): Builder
    {
        if ($action !== 'all') {
            if ($action === 'compress') {
                $query->where(function (Builder $subQuery) {
                    $subQuery->where('action', 'compress')
                        ->orWhereNull('action');
                });
            } else {
                $query->where('action', $action);
            }
        }

        if ($format !== 'all') {
            $query->where(function (Builder $subQuery) use ($format) {
                $subQuery->whereRaw('LOWER(original_format) = ?', [$format])
                    ->orWhereRaw('LOWER(output_format) = ?', [$format]);
            });
        }

        return $query;
    }
}
