<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Tabs::make('Page')
                ->tabs([

                    /* ── General ─────────────────────────── */
                    Forms\Components\Tabs\Tab::make('General')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Forms\Components\Grid::make(3)->schema([
                                Forms\Components\Select::make('type')
                                    ->options([
                                        'tool' => '🛠 Tool',
                                        'blog' => '📝 Blog Post',
                                        'page' => '📄 Static Page',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->live(),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->helperText('URL-safe identifier, e.g. "compress" or "how-to-compress-images"'),

                                Forms\Components\TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ]),

                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Published')
                                    ->default(true)
                                    ->inline(false),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Featured')
                                    ->default(false)
                                    ->inline(false)
                                    ->visible(fn (Forms\Get $get) => $get('type') === 'blog'),
                            ]),
                        ]),

                    /* ── SEO Meta ────────────────────────── */
                    Forms\Components\Tabs\Tab::make('SEO')
                        ->icon('heroicon-o-magnifying-glass')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255)
                                ->helperText('Browser tab / search result title')
                                ->columnSpanFull(),

                            Forms\Components\Textarea::make('meta_description')
                                ->required()
                                ->rows(3)
                                ->maxLength(500)
                                ->helperText('Google snippet — aim for 150-160 characters')
                                ->columnSpanFull(),

                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('og_title')
                                    ->label('OG Title')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('og_description')
                                    ->label('OG Description')
                                    ->maxLength(255),
                            ]),

                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('og_type')
                                    ->label('OG Type')
                                    ->default('website')
                                    ->maxLength(30),

                                Forms\Components\TextInput::make('canonical_path')
                                    ->label('Canonical Path')
                                    ->placeholder('/tools/compress')
                                    ->maxLength(255),
                            ]),

                            Forms\Components\Textarea::make('schema_markup')
                                ->label('JSON-LD Schema')
                                ->rows(8)
                                ->helperText('Paste valid JSON-LD. Leave blank to skip.')
                                ->columnSpanFull()
                                ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $state)
                                ->dehydrateStateUsing(fn ($state) => $state ? json_decode($state, true) : null),
                        ]),

                    /* ── Hero Section ────────────────────── */
                    Forms\Components\Tabs\Tab::make('Hero')
                        ->icon('heroicon-o-sparkles')
                        ->schema([
                            Forms\Components\TextInput::make('breadcrumb_label')
                                ->maxLength(100),

                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('hero_badge')
                                    ->placeholder('🗜️ Free · No Signup · Unlimited')
                                    ->maxLength(255),

                                Forms\Components\Select::make('hero_badge_color')
                                    ->options([
                                        'brand'  => '🟣 Brand (Indigo)',
                                        'green'  => '🟢 Green',
                                        'purple' => '🟣 Purple',
                                        'blue'   => '🔵 Blue',
                                        'pink'   => '🩷 Pink',
                                        'amber'  => '🟡 Amber',
                                        'red'    => '🔴 Red',
                                    ])
                                    ->default('brand')
                                    ->native(false),
                            ]),

                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('hero_title')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('hero_title_gradient')
                                    ->label('Gradient Text')
                                    ->placeholder('Online Free')
                                    ->maxLength(100),
                            ]),

                            Forms\Components\Textarea::make('hero_description')
                                ->rows(3)
                                ->helperText('HTML allowed for <strong> etc.')
                                ->columnSpanFull(),
                        ]),

                    /* ── CTA (Tools) ─────────────────────── */
                    Forms\Components\Tabs\Tab::make('CTA')
                        ->icon('heroicon-o-cursor-arrow-rays')
                        ->visible(fn (Forms\Get $get) => $get('type') === 'tool')
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('cta_icon')
                                    ->placeholder('🗜️')
                                    ->maxLength(50),

                                Forms\Components\Select::make('cta_color')
                                    ->options([
                                        'brand'  => '🟣 Brand',
                                        'green'  => '🟢 Green',
                                        'purple' => '🟣 Purple',
                                        'blue'   => '🔵 Blue',
                                        'pink'   => '🩷 Pink',
                                        'amber'  => '🟡 Amber',
                                        'red'    => '🔴 Red',
                                    ])
                                    ->default('brand')
                                    ->native(false),
                            ]),

                            Forms\Components\TextInput::make('cta_title')
                                ->maxLength(255),

                            Forms\Components\Textarea::make('cta_description')
                                ->rows(2),

                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('cta_button_text')
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('cta_button_url')
                                    ->placeholder('/#compress')
                                    ->maxLength(255),
                            ]),
                        ]),

                    /* ── Blog Fields ─────────────────────── */
                    Forms\Components\Tabs\Tab::make('Blog')
                        ->icon('heroicon-o-newspaper')
                        ->visible(fn (Forms\Get $get) => $get('type') === 'blog')
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('category')
                                    ->placeholder('Compression, Web Performance')
                                    ->maxLength(100),

                                Forms\Components\Select::make('category_color')
                                    ->options([
                                        'brand'  => '🟣 Brand',
                                        'purple' => '🟣 Purple',
                                        'green'  => '🟢 Green',
                                        'orange' => '🟠 Orange',
                                        'pink'   => '🩷 Pink',
                                        'blue'   => '🔵 Blue',
                                        'cyan'   => '🩵 Cyan',
                                        'rose'   => '🌹 Rose',
                                        'indigo' => '💜 Indigo',
                                        'amber'  => '🟡 Amber',
                                    ])
                                    ->native(false),
                            ]),

                            Forms\Components\Grid::make(3)->schema([
                                Forms\Components\DatePicker::make('published_at')
                                    ->default(now()),

                                Forms\Components\TextInput::make('read_time')
                                    ->placeholder('12 min read')
                                    ->maxLength(30),

                                Forms\Components\TextInput::make('listing_emoji')
                                    ->placeholder('📚')
                                    ->maxLength(10),
                            ]),

                            Forms\Components\Textarea::make('excerpt')
                                ->rows(3)
                                ->helperText('Short description for blog listing cards')
                                ->columnSpanFull(),
                        ]),

                    /* ── Body Content ────────────────────── */
                    Forms\Components\Tabs\Tab::make('Content')
                        ->icon('heroicon-o-pencil-square')
                        ->schema([
                            Forms\Components\RichEditor::make('body')
                                ->toolbarButtons([
                                    'bold', 'italic', 'underline', 'strike',
                                    'h2', 'h3',
                                    'bulletList', 'orderedList',
                                    'link', 'blockquote',
                                    'codeBlock',
                                    'undo', 'redo',
                                ])
                                ->columnSpanFull(),
                        ]),

                    /* ── Related Items ───────────────────── */
                    Forms\Components\Tabs\Tab::make('Related')
                        ->icon('heroicon-o-link')
                        ->schema([
                            Forms\Components\Repeater::make('related_tools')
                                ->label('Related Tools')
                                ->schema([
                                    Forms\Components\Grid::make(4)->schema([
                                        Forms\Components\TextInput::make('slug')->required(),
                                        Forms\Components\TextInput::make('emoji')->required()->maxLength(10),
                                        Forms\Components\TextInput::make('title')->required(),
                                        Forms\Components\TextInput::make('description')->required(),
                                    ]),
                                ])
                                ->defaultItems(0)
                                ->collapsible()
                                ->collapsed()
                                ->itemLabel(fn (array $state): ?string => ($state['emoji'] ?? '') . ' ' . ($state['title'] ?? ''))
                                ->columnSpanFull(),

                            Forms\Components\Repeater::make('related_posts')
                                ->label('Related Blog Posts')
                                ->schema([
                                    Forms\Components\Grid::make(3)->schema([
                                        Forms\Components\TextInput::make('slug')->required(),
                                        Forms\Components\TextInput::make('title')->required(),
                                        Forms\Components\TextInput::make('description')->required(),
                                    ]),
                                ])
                                ->defaultItems(0)
                                ->collapsible()
                                ->collapsed()
                                ->itemLabel(fn (array $state): ?string => $state['title'] ?? '')
                                ->columnSpanFull(),
                        ]),

                ])->columnSpanFull(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tool' => 'success',
                        'blog' => 'info',
                        'page' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->title),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->color('gray')
                    ->copyable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->visible(fn ($livewire) => true),

                Tables\Columns\TextColumn::make('published_at')
                    ->date()
                    ->sortable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'tool' => 'Tools',
                        'blog' => 'Blog Posts',
                        'page' => 'Static Pages',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Published'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Page $record): string => url($record->url))
                    ->openUrlInNewTab(),
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
            'index'  => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit'   => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
