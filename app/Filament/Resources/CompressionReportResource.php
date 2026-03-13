<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompressionReportResource\Pages;
use App\Models\CompressionReport;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompressionReportResource extends Resource
{
    protected static ?string $model = CompressionReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Analytics';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('action')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('original_name')
                    ->searchable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('original_format')
                    ->searchable(),
                Tables\Columns\TextColumn::make('output_format')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reduction_percent')
                    ->suffix('%')
                    ->sortable()
                    ->numeric(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // Read-only grid
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompressionReports::route('/'),
        ];
    }
}
