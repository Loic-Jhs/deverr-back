<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Widgets\StatsOverview;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $modelLabel = 'Utilisateurs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('firstname')->label('Prénom'),
                Forms\Components\TextInput::make('lastname')->label('Nom'),
                Forms\Components\TextInput::make('email')->label('Email'),
                Forms\Components\TextInput::make('role')->label('Rôle'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('firstname')->sortable()->searchable()->label('Prénom'),
                Tables\Columns\TextColumn::make('lastname')->sortable()->searchable()->label('Nom'),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable()->label('Email'),
                Tables\Columns\TextColumn::make('email_verified_at')->sortable()->searchable()->label('Email vérifié le')->date('d/m/Y'),
                Tables\Columns\TextColumn::make('role')->enum([
                    0 => 'Utilisateur',
                    1 => 'Développeur',
                    2 => 'Admin',
                ])->sortable()->label('Rôle'),

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
            'index' => Pages\ManageUsers::route('/'),
        ];
    }

    //public static function getWidgets(): array
    //{
    //    return [
    //        StatsOverview::class,
    //    ];
    //}
}
