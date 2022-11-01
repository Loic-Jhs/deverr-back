<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Developer;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    public function getRolesAdmin(): int
    {
        return User::all('role')->where('role', '=', 2)->count();
    }

    protected function getCards(): array
    {
        return [
            Card::make('Utilisateurs', User::all()->count())
                ->description('3 utilisateurs de plus')
                ->icon('heroicon-o-user-group')
                ->descriptionIcon('')
                ->color('success'),
            Card::make('Développeurs', Developer::all()->count())
                ->icon('heroicon-o-user-group'),
            Card::make('Admins', $this->getRolesAdmin())
                ->icon('heroicon-o-user-group'),
        ];
    }
}
