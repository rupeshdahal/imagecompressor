<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompressionReportResource\Pages;
use App\Models\CompressionReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompressionReportResource extends Resource
{
    protected static ?string $model = CompressionReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Analytics';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Compression Reports';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\TextInput::make('action'),
                Forms\Components\TextInput::make('batch_id'),
                Forms\Components\TextInput::make('referrer'),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('original_name'),
                Forms\Components\TextInput::make('original_format'),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('output_format'),
                Forms\Components\TextInput::make('quality'),
            ]),
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\TextInput::make('original_size')->numeric(),
                Forms\Components\TextInput::make('compressed_size')->numeric(),
                Forms\Components\TextInput::make('reduction_percent')->numeric(),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('width')->numeric(),
                Forms\Components\TextInput::make('height')->numeric(),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('ip_address'),
                Forms\Components\TextInput::make('user_agent'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('action')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'compress'    => 'success',
                        'convert'     => 'info',
                        'resize'      => 'warning',
                        'batch'       => 'primary',
                        'watermark'   => 'danger',
                        'img_to_pdf'  => 'gray',
                        'pdf_to_img'  => 'gray',
                        default       => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('original_name')
                    ->searchable()
                    ->limit(25)
                    ->tooltip(fn ($record) => $record->original_name),

                Tables\Columns\TextColumn::make('original_format')
                    ->label('In')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('output_format')
                    ->label('Out')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('original_size')
                    ->label('Original')
                    ->formatStateUsing(fn ($state) => $state ? self::formatBytes($state) : '—')
                    ->sortable(),

                Tables\Columns\TextColumn::make('compressed_size')
                    ->label('Result')
                    ->formatStateUsing(fn ($state) => $state ? self::formatBytes($state) : '—')
                    ->sortable(),

                Tables\Columns\TextColumn::make('reduction_percent')
                    ->label('Saved')
                    ->formatStateUsing(fn ($state) => $state ? round($state, 1) . '%' : '—')
                    ->color(fn ($state) => match (true) {
                        $state >= 70 => 'success',
                        $state >= 40 => 'info',
                        $state > 0   => 'warning',
                        default      => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('quality')
                    ->sortable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('When'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('action')
                    ->options([
                        'compress'   => 'Compress',
                        'convert'    => 'Convert',
                        'resize'     => 'Resize',
                        'batch'      => 'Batch',
                        'watermark'  => 'Watermark',
                        'img_to_pdf' => 'Image → PDF',
                        'pdf_to_img' => 'PDF → Image',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompressionReports::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    private static function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1) . ' MB';
        }
        if ($bytes >= 1024) {
            return round($bytes / 1024, 1) . ' KB';
        }
        return $bytes . ' B';
    }
}
