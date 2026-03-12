<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view')
                ->icon('heroicon-o-eye')
                ->url(fn () => url($this->record->url))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }
}
