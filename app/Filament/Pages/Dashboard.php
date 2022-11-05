<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
