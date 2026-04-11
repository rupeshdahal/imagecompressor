<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompressionReportResource\Pages;
use App\Filament\Widgets\CompressionReportFormatDistributionChartWidget;
use App\Filament\Widgets\CompressionReportOverviewWidget;
use App\Filament\Widgets\CompressionReportTrendChartWidget;
use App\Models\CompressionReport;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompressionReportResource extends Resource
{
    protected static ?string $model = CompressionReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static ?string $navigationLabel = 'Reports';

    protected static ?string $navigationGroup = 'Analytics';

    protected static ?string $slug = 'reports';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('original_name')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('action')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('original_format')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('output_format')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('original_size')
                    ->label('Original')
                    ->formatStateUsing(fn ($state): string => self::formatBytes((int) $state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('compressed_size')
                    ->label('Compressed')
                    ->formatStateUsing(fn ($state): string => self::formatBytes((int) $state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('reduction_percent')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\TextColumn::make('quality')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ip_address')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('country')
                    ->badge()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->since()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompressionReports::route('/'),
        ];
    }

    protected static function formatBytes(int $bytes): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $power = min((int) floor(log($bytes, 1024)), count($units) - 1);

        return number_format($bytes / (1024 ** $power), 1) . ' ' . $units[$power];
    }

    public static function getHeaderWidgets(): array
    {
        return [
            CompressionReportOverviewWidget::class,
            CompressionReportTrendChartWidget::class,
            CompressionReportFormatDistributionChartWidget::class,
        ];
    }

    public static function getHeaderWidgetsColumns(): int | array
    {
        return 3;
    }
}
