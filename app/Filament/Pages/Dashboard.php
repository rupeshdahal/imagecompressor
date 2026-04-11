<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminQuickActionsWidget;
use App\Filament\Widgets\CompressionReportOverviewWidget;
use App\Filament\Widgets\SystemInfoWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'Dashboard';

    public function getWidgets(): array
    {
        return [
            CompressionReportOverviewWidget::class,
            AdminQuickActionsWidget::class,
            SystemInfoWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }
}