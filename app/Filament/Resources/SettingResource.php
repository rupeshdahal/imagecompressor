<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('label')
                        ->required(),
                    Forms\Components\TextInput::make('key')
                        ->required()
                        ->disabled(fn (?Setting $record) => $record !== null), // disabled if editing
                    Forms\Components\Select::make('group')
                        ->options([
                            'general' => 'General',
                            'navigation' => 'Navigation',
                            'ads' => 'Ads',
                            'seo' => 'SEO',
                        ])
                        ->required(),
                    Forms\Components\Select::make('type')
                        ->options([
                            'text' => 'Text',
                            'textarea' => 'Text Area',
                            'boolean' => 'Boolean',
                            'json' => 'JSON',
                        ])
                        ->required()
                        ->live(),
                    Forms\Components\Textarea::make('value')
                        ->columnSpanFull()
                        ->rows(5)
                        ->helperText(fn (Forms\Get $get) => $get('type') === 'json' ? 'Must be valid JSON' : ($get('type') === 'boolean' ? 'Enter true or false' : '')),
                    Forms\Components\Textarea::make('description')
                        ->columnSpanFull(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->fontFamily('mono')
                    ->size('sm'),
                Tables\Columns\BadgeColumn::make('group')
                    ->colors([
                        'primary' => 'general',
                        'success' => 'navigation',
                        'warning' => 'ads',
                        'danger' => 'seo',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'navigation' => 'Navigation',
                        'ads' => 'Ads',
                        'seo' => 'SEO',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Remove delete for settings usually, or keep it.
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
