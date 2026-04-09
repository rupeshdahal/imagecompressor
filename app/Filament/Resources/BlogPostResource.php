<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $modelLabel = 'Blog Post';

    protected static ?string $pluralModelLabel = 'Blog Posts';

    protected static ?string $slug = 'blog-posts';

    public static function getNavigationLabel(): string
    {
        return 'Blog Manager';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Post Details')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $state, callable $set, callable $get): void {
                                if (blank($get('slug'))) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Used in the public URL, for example /blog/your-slug')
                            ->rules(['regex:/^[a-z0-9\-]+$/']),
                        TextInput::make('category')
                            ->maxLength(100),
                        TextInput::make('read_time_minutes')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(120),
                        DateTimePicker::make('published_at')
                            ->seconds(false)
                            ->required(),
                        Toggle::make('featured'),
                        Toggle::make('is_published')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('SEO')
                    ->schema([
                        Textarea::make('excerpt')
                            ->rows(4)
                            ->columnSpanFull(),
                        TextInput::make('meta_title')
                            ->maxLength(255),
                        Textarea::make('meta_description')
                            ->rows(3),
                        TextInput::make('og_title')
                            ->maxLength(255),
                        Textarea::make('og_description')
                            ->rows(3),
                    ])
                    ->columns(2),

                Section::make('Content')
                    ->schema([
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('schema_json')
                            ->label('Schema JSON / Head HTML')
                            ->rows(10)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('category')
                    ->badge()
                    ->color('gray')
                    ->placeholder('Uncategorized'),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('read_time_minutes')
                    ->label('Read Time')
                    ->suffix(' min')
                    ->toggleable(),
                IconColumn::make('featured')
                    ->boolean(),
                IconColumn::make('is_published')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published'),
                Tables\Filters\TernaryFilter::make('featured'),
                Tables\Filters\SelectFilter::make('category')
                    ->options(fn (): array => BlogPost::query()
                        ->whereNotNull('category')
                        ->distinct()
                        ->orderBy('category')
                        ->pluck('category', 'category')
                        ->all()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('title'),
                TextEntry::make('slug'),
                TextEntry::make('category')
                    ->badge(),
                TextEntry::make('published_at')
                    ->dateTime(),
                TextEntry::make('excerpt')
                    ->columnSpanFull(),
                TextEntry::make('content')
                    ->html()
                    ->columnSpanFull(),
                TextEntry::make('schema_json')
                    ->code()
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
            'view' => Pages\ViewBlogPost::route('/{record}'),
        ];
    }
}
