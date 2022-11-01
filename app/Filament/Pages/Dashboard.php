<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use App\Filament\Resources\UserResource\Widgets\StatsOverview;

class Dashboard extends BasePage
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class
        ];
    }
}
