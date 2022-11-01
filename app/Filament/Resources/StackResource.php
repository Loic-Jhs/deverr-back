<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StackResource\Pages;
use App\Filament\Resources\StackResource\RelationManagers;
use App\Models\Stack;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class StackResource extends Resource
{
    protected static ?string $model = Stack::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';

    protected static ?string $modelLabel = 'Stacks';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->label('Nom'),
                Forms\Components\TextInput::make('logo')->required()->label('Logo')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')->label('Nom')->searchable()
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
            'index' => Pages\ManageStacks::route('/'),
        ];
    }
}
