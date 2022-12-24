<?php

namespace App\Filament\Resources\DeveloperPrestationResource\Pages;

use App\Filament\Resources\DeveloperPrestationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDeveloperPrestations extends ManageRecords
{
    protected static string $resource = DeveloperPrestationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
