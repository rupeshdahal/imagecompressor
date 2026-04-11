<?php

namespace App\Filament\Widgets;

use App\Models\CompressionReport;
use Filament\Widgets\ChartWidget;

class CompressionReportTrendChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Compressions Over Time';

    protected static ?int $sort = 4;

    protected static ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $days = 14;
        $startDate = now()->subDays($days - 1)->startOfDay();

        $rows = CompressionReport::query()
            ->where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->all();

        $labels = [];
        $counts = [];

        for ($offset = $days - 1; $offset >= 0; $offset--) {
            $date = now()->subDays($offset)->format('Y-m-d');
            $labels[] = now()->subDays($offset)->format('M d');
            $counts[] = (int) ($rows[$date] ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Compressions',
                    'data' => $counts,
                    'borderColor' => 'rgb(99, 102, 241)',
                    'backgroundColor' => 'rgba(99, 102, 241, 0.18)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
            ],
            'labels' => $labels,
        ];
    }
}