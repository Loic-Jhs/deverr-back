<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class OrdersStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Commandes totales', Order::query()->count())
                ->description(Order::query()->where('is_accepted_by_developer', true)->count() . ' commandes en cours | '
                    . Order::query()->where('is_accepted_by_developer', false)->count() . ' commandes en attente | '
                    . Order::query()->where('is_accepted_by_developer', true)->where('is_finished', true)->count() . ' commandes terminées')
                ->color('warning')
                ->icon('heroicon-o-shopping-cart'),
        ];
    }
}
