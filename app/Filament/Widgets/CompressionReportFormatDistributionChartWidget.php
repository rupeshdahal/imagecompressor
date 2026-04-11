<?php

namespace App\Filament\Widgets;

use App\Models\CompressionReport;
use Filament\Widgets\ChartWidget;

class CompressionReportFormatDistributionChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Format Distribution';

    protected static ?int $sort = 5;

    protected static ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $formatCounts = CompressionReport::query()
            ->whereNotNull('original_format')
            ->selectRaw('LOWER(original_format) as format, COUNT(*) as count')
            ->groupBy('format')
            ->orderByDesc('count')
            ->pluck('count', 'format')
            ->all();

        if ($formatCounts === []) {
            $formatCounts = ['unknown' => 1];
        }

        return [
            'datasets' => [
                [
                    'data' => array_values($formatCounts),
                    'backgroundColor' => [
                        'rgba(99, 102, 241, 0.9)',
                        'rgba(16, 185, 129, 0.9)',
                        'rgba(245, 158, 11, 0.9)',
                        'rgba(14, 165, 233, 0.9)',
                        'rgba(168, 85, 247, 0.9)',
                    ],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => array_map('strtoupper', array_keys($formatCounts)),
        ];
    }
}