<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeveloperPrestationResource\Pages;
use App\Models\DeveloperPrestation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class DeveloperPrestationResource extends Resource
{
    protected static ?string $model = DeveloperPrestation::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $modelLabel = 'Prestations développeur';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('developer_id')->label('Id développeur'),
                Forms\Components\TextInput::make('prestation_type_id')->label('Id prestation type'),
                Forms\Components\TextInput::make('description')->label('Description'),
                Forms\Components\TextInput::make('price')->label('Prix €'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('developer_id')->sortable()->searchable()->label('Id développeur'),
                Tables\Columns\TextColumn::make('prestation_type_id')->sortable()->searchable()->label('Id prestation type'),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable()->label('Description'),
                Tables\Columns\TextColumn::make('price')->sortable()->searchable()->label('Prix €'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDeveloperPrestations::route('/'),
        ];
    }
}
