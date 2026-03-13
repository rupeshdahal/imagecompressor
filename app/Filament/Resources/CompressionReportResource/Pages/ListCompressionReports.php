<?php

namespace App\Filament\Resources\CompressionReportResource\Pages;

use App\Filament\Resources\CompressionReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompressionReports extends ListRecords
{
    protected static string $resource = CompressionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
