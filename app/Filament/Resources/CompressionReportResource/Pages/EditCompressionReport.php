<?php

namespace App\Filament\Resources\CompressionReportResource\Pages;

use App\Filament\Resources\CompressionReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompressionReport extends EditRecord
{
    protected static string $resource = CompressionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
