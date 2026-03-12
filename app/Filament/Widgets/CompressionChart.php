<?php

namespace App\Filament\Widgets;

use App\Models\CompressionReport;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CompressionChart extends ChartWidget
{
    protected static ?string $heading = 'Compressions — Last 14 Days';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $days = collect(range(13, 0))->map(fn ($i) => Carbon::today()->subDays($i));

        $data = $days->map(fn ($day) => CompressionReport::whereDate('created_at', $day)->count());

        return [
            'datasets' => [
                [
                    'label' => 'Compressions',
                    'data'  => $data->toArray(),
                    'borderColor' => '#6366f1',
                    'backgroundColor' => 'rgba(99, 102, 241, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $days->map(fn ($d) => $d->format('M j'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
