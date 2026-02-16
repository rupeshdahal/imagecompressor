<?php

namespace App\Http\Controllers;

use App\Models\CompressionReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $startDate = match ($period) {
            '24h'  => Carbon::now()->subHours(24),
            '7d'   => Carbon::now()->subDays(7),
            '30d'  => Carbon::now()->subDays(30),
            '90d'  => Carbon::now()->subDays(90),
            'all'  => Carbon::create(2020, 1, 1),
            default => Carbon::now()->subDays(7),
        };

        $reports = CompressionReport::where('created_at', '>=', $startDate);

        // Summary stats
        $totalCompressions = (clone $reports)->count();
        $totalOriginalSize = (clone $reports)->sum('original_size');
        $totalCompressedSize = (clone $reports)->sum('compressed_size');
        $totalSaved = $totalOriginalSize - $totalCompressedSize;
        $avgReduction = (clone $reports)->avg('reduction_percent') ?? 0;

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

        // Recent compressions
        $recentCompressions = (clone $reports)
            ->orderByDesc('created_at')
            ->limit(20)
            ->get()
            ->map(function ($r) {
                return [
                    'id'              => $r->id,
                    'original_name'   => $r->original_name,
                    'original_format' => strtoupper($r->original_format),
                    'output_format'   => strtoupper($r->output_format),
                    'original_size'   => $this->formatBytes($r->original_size),
                    'compressed_size' => $this->formatBytes($r->compressed_size),
                    'reduction'       => $r->reduction_percent . '%',
                    'quality'         => $r->quality . '%',
                    'dimensions'      => ($r->width && $r->height) ? "{$r->width}×{$r->height}" : '—',
                    'created_at'      => $r->created_at->diffForHumans(),
                    'created_date'    => $r->created_at->format('M d, Y H:i'),
                ];
            });

        // Top size savings
        $topSavings = CompressionReport::where('created_at', '>=', $startDate)
            ->orderByRaw('(original_size - compressed_size) DESC')
            ->limit(5)
            ->get()
            ->map(function ($r) {
                return [
                    'original_name' => $r->original_name,
                    'saved'         => $this->formatBytes($r->original_size - $r->compressed_size),
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
            'daily_stats'        => $dailyStats,
            'format_stats'       => $formatStats,
            'output_format_stats' => $outputFormatStats,
            'quality_stats'      => $qualityStats,
            'recent'             => $recentCompressions,
            'top_savings'        => $topSavings,
        ]);
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
}
