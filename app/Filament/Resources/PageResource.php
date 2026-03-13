<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Page Data')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->options([
                                        'tool' => 'Tool',
                                        'blog' => 'Blog',
                                        'page' => 'Page',
                                    ])
                                    ->required()
                                    ->live(),
                                Forms\Components\TextInput::make('title')
                                    ->required(),
                                Forms\Components\TextInput::make('slug')
                                    ->required(),
                                Forms\Components\Toggle::make('is_active')
                                    ->default(true)
                                    ->required(),
                                Forms\Components\TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ])->columns(2),
                        
                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\RichEditor::make('body')
                                    ->columnSpanFull(),
                            ]),
                            
                        Forms\Components\Tabs\Tab::make('Hero')
                            ->schema([
                                Forms\Components\TextInput::make('hero_badge'),
                                Forms\Components\TextInput::make('hero_title'),
                                Forms\Components\TextInput::make('hero_title_gradient'),
                                Forms\Components\Textarea::make('hero_description')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('Blog & Metadata')
                            ->schema([
                                Forms\Components\TextInput::make('category'),
                                Forms\Components\TextInput::make('listing_emoji'),
                                Forms\Components\TextInput::make('read_time'),
                                Forms\Components\DatePicker::make('published_at'),
                                Forms\Components\Toggle::make('is_featured'),
                                Forms\Components\Textarea::make('excerpt')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_description')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('og_title'),
                                Forms\Components\Textarea::make('og_description')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('canonical_path'),
                            ])->columns(2),
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'tool',
                        'success' => 'blog',
                        'warning' => 'page',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'tool' => 'Tool',
                        'blog' => 'Blog',
                        'page' => 'Page',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
