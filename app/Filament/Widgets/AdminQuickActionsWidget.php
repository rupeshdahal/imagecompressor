<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AdminQuickActionsWidget extends Widget
{
    protected static ?int $sort = 2;

    protected static string $view = 'filament.widgets.admin-quick-actions';

    protected int | string | array $columnSpan = 'full';
}