<?php

namespace App\Filament\Resources\CompressionReportResource\Pages;

use App\Filament\Resources\CompressionReportResource;
use Filament\Resources\Pages\Page;

class ListCompressionReports extends Page
{
    protected static string $resource = CompressionReportResource::class;

    protected static string $view = 'filament.pages.compression-reports';

    protected static ?string $title = 'Compression Reports';

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static ?string $slug = 'reports';

    public string $reportsDataUrl;

    public string $reportsExportUrl;

    public string $dashboardUrl;

    public string $siteUrl;

    public string $blogUrl;

    public function mount(): void
    {
        $this->reportsDataUrl = route('admin.reports.data');
        $this->reportsExportUrl = route('admin.reports.export');
        $this->dashboardUrl = url('/admin');
        $this->siteUrl = url('/');
        $this->blogUrl = url('/admin/blog');
    }

    public static function getNavigationLabel(): string
    {
        return 'Reports';
    }
}
