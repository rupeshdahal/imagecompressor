<?php

namespace App\Filament\Resources\CompressionReportResource\Pages;

use App\Filament\Resources\CompressionReportResource;
use App\Filament\Widgets\CompressionReportFormatDistributionChartWidget;
use App\Filament\Widgets\CompressionReportOverviewWidget;
use App\Filament\Widgets\CompressionReportTrendChartWidget;
use Filament\Resources\Pages\ListRecords;

class ListCompressionReports extends ListRecords
{
    protected static string $resource = CompressionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CompressionReportOverviewWidget::class,
            CompressionReportTrendChartWidget::class,
            CompressionReportFormatDistributionChartWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 3;
    }
}
