<?php

namespace App\Filament\Widgets;

use App\Models\CompressionReport;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CompressionReportOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $query = CompressionReport::query();

        $totalReports = (clone $query)->count();
        $totalOriginal = (clone $query)->sum('original_size');
        $totalCompressed = (clone $query)->sum('compressed_size');
        $savedBytes = max(0, $totalOriginal - $totalCompressed);
        $avgReduction = round((float) ((clone $query)->avg('reduction_percent') ?? 0), 1);
        $uniqueUsers = (clone $query)
            ->whereNotNull('ip_address')
            ->distinct('ip_address')
            ->count('ip_address');

        return [
            Stat::make('Total Compressions', number_format($totalReports))
                ->description('All recorded compression jobs')
                ->color('primary'),
            Stat::make('Space Saved', $this->formatBytes($savedBytes))
                ->description('Original minus compressed size')
                ->color('success'),
            Stat::make('Avg Reduction', $avgReduction . '%')
                ->description('Mean reduction across reports')
                ->color('warning'),
            Stat::make('Unique Users', number_format($uniqueUsers))
                ->description('Distinct IPs in the database')
                ->color('gray'),
        ];
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $power = min((int) floor(log($bytes, 1024)), count($units) - 1);

        return number_format($bytes / (1024 ** $power), 1) . ' ' . $units[$power];
    }
}