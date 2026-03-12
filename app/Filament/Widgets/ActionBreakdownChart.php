<?php

namespace App\Filament\Widgets;

use App\Models\CompressionReport;
use Filament\Widgets\ChartWidget;

class ActionBreakdownChart extends ChartWidget
{
    protected static ?string $heading = 'Actions Breakdown';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $actions = CompressionReport::selectRaw('action, COUNT(*) as total')
            ->groupBy('action')
            ->orderByDesc('total')
            ->pluck('total', 'action');

        $colors = [
            'compress'   => '#10b981',
            'convert'    => '#6366f1',
            'resize'     => '#f59e0b',
            'batch'      => '#8b5cf6',
            'watermark'  => '#ef4444',
            'img_to_pdf' => '#06b6d4',
            'pdf_to_img' => '#ec4899',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Operations',
                    'data'  => $actions->values()->toArray(),
                    'backgroundColor' => $actions->keys()->map(fn ($a) => $colors[$a] ?? '#9ca3af')->toArray(),
                ],
            ],
            'labels' => $actions->keys()->map(fn ($a) => ucfirst(str_replace('_', ' ', $a)))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
