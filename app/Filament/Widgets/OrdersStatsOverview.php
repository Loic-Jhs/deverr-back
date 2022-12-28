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
            Card::make('Commandes totales', Order::all()->count())
                ->icon('heroicon-o-shopping-cart'),
            Card::make('Commandes en cours', Order::query()->where('is_accepted_by_developer',true)->count())
                ->icon('heroicon-o-shopping-cart'),
            Card::make('Commandes en attente d\'acceptation', Order::query()->where('is_accepted_by_developer',false)->count())
                ->icon('heroicon-o-shopping-cart'),
            Card::make('Commandes payées', Order::query()->where('is_paid',true)->where('is_accepted_by_developer', true)->count())
                ->icon('heroicon-o-shopping-cart'),
            Card::make('commandes terminées', Order::query()->where('is_finished',true)->where('is_accepted_by_developer', true)->count())
                ->icon('heroicon-o-shopping-cart'),
        ];
    }
}
