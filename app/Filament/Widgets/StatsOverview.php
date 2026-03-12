<?php

namespace App\Filament\Widgets;

use App\Models\CompressionReport;
use App\Models\Page;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalReports   = CompressionReport::count();
        $todayReports   = CompressionReport::whereDate('created_at', today())->count();
        $totalPages     = Page::active()->count();
        $totalTools     = Page::tools()->count();
        $totalBlogs     = Page::blogs()->count();

        $avgReduction   = CompressionReport::avg('reduction_percent');
        $totalSaved     = CompressionReport::selectRaw('SUM(original_size - compressed_size) as saved')->value('saved');

        return [
            Stat::make('Total Compressions', number_format($totalReports))
                ->description($todayReports . ' today')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart(self::lastSevenDaysCounts()),

            Stat::make('Avg Reduction', round($avgReduction ?? 0, 1) . '%')
                ->description('Across all operations')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),

            Stat::make('Data Saved', self::formatBytes($totalSaved ?? 0))
                ->description('Total bytes saved for users')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('warning'),

            Stat::make('Published Pages', $totalPages)
                ->description($totalTools . ' tools · ' . $totalBlogs . ' blog posts')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
        ];
    }

    private static function lastSevenDaysCounts(): array
    {
        $counts = [];
        for ($i = 6; $i >= 0; $i--) {
            $counts[] = CompressionReport::whereDate('created_at', today()->subDays($i))->count();
        }
        return $counts;
    }

    private static function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return round($bytes / 1073741824, 1) . ' GB';
        }
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1) . ' MB';
        }
        if ($bytes >= 1024) {
            return round($bytes / 1024, 1) . ' KB';
        }
        return $bytes . ' B';
    }
}
