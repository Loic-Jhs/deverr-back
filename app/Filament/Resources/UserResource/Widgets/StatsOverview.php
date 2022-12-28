<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Developer;
use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    public function getRolesAdmin(): int
    {
        return User::all('role')->where('role', '=', 2)->count();
    }

    public function getNewUsersPerDay(): int
    {
        return User::all('created_at')->where('created_at', '>=', now()->subDays(1))->count();
    }

    public function getNewDevelopersPerDay(): int
    {
        return Developer::all('created_at')->where('created_at', '>=', now()->subDays(1))->count();
    }

    protected function getCards(): array
    {
        return [
            Card::make('Utilisateurs', User::all()->count())
                ->description($this->getNewUsersPerDay() . ' utilisateur(s) de + sur les dernières 24h')
                ->icon('heroicon-o-user-group')
                ->descriptionIcon('')
                ->color('success'),
            Card::make('Développeurs', Developer::all()->count())
                ->description($this->getNewDevelopersPerDay() . ' développeur(s) de + sur les dernières 24h')
                ->color('success')
                ->icon('heroicon-o-user-group'),
            Card::make('Admins', $this->getRolesAdmin())
                ->icon('heroicon-o-user-group'),

        ];
    }
}
