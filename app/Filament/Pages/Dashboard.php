<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource\Widgets\StatsOverview;
use App\Filament\Widgets\OrdersStatsOverview;
use App\Filament\Widgets\UsersChart;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            OrdersStatsOverview::class,
            UsersChart::class,
        ];
    }
}
