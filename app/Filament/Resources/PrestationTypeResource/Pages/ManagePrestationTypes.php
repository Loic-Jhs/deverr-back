<?php

namespace App\Filament\Resources\PrestationTypeResource\Pages;

use App\Filament\Resources\PrestationTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePrestationTypes extends ManageRecords
{
    protected static string $resource = PrestationTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
