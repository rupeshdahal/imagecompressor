<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SystemInfoWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 3;

    protected function getStats(): array
    {
        return [
            Stat::make('Laravel Version', app()->version())
                ->description('Framework runtime')
                ->color('primary'),
            Stat::make('PHP Version', PHP_VERSION)
                ->description('Interpreter runtime')
                ->color('gray'),
            Stat::make('Upload Limit', ini_get('upload_max_filesize') ?: 'Unknown')
                ->description('PHP upload cap')
                ->color('success'),
            Stat::make('Memory Limit', ini_get('memory_limit') ?: 'Unknown')
                ->description('PHP memory cap')
                ->color('warning'),
            Stat::make('Database', config('database.default'))
                ->description('Configured connection')
                ->color('primary'),
            Stat::make('Status', 'Online')
                ->description('Application health')
                ->color('success'),
        ];
    }
}