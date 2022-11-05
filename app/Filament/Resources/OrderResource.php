<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    protected static ?string $modelLabel = 'Commandes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('user_id')->sortable()->label('id Utilisateur'),
                Tables\Columns\TextColumn::make('developer_id')->sortable()->label('id Développeur'),
                Tables\Columns\TextColumn::make('developer_prestation_id')->sortable()->label('id presta dev'),
                Tables\Columns\TextColumn::make('is_payed')->sortable()->label('Payé ?'),
                Tables\Columns\TextColumn::make('is_accepted_by_developer')->sortable()->label('Accepté par le développeur ?'),
                Tables\Columns\TextColumn::make('reference')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
        ];
    }
}
