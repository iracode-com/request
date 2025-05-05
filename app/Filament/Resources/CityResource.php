<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Models\City;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;

class CityResource extends Resource implements HasShieldPermissions
{
    use \App\Traits\HasShieldPermissions;

    protected static ?string $model          = City::class;
    protected static ?int    $navigationSort = 6;

    public static function getNavigationGroup(): ?string
    {
        return __('Organizational information');
    }

    public static function getNavigationLabel(): string
    {
        return __('Cities');
    }

    public static function getModelLabel(): string
    {
        return __('City');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Cities');
    }

    public static function canAccess(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            [
                Forms\Components\TextInput::make('name')->label(__('Name'))->required(),
                Forms\Components\TextInput::make('name_en')->label(__('Latin name'))->required(),
                Forms\Components\Select::make('province_id')
                    ->relationship('province', 'name')->label(__('Province'))
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('latitude')->label(__('Latitude')),
                Forms\Components\TextInput::make('longitude')->label(__('Longitude')),
                Forms\Components\Toggle::make('status')->label(__('Status'))->inline(false),
            ]
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('name_en')->searchable(),
                Tables\Columns\TextColumn::make('province.name')->searchable(),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('latitude')->searchable()->searchable(),
                Tables\Columns\TextColumn::make('longitude')->searchable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->jalaliDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->jalaliDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            // 'create' => Pages\CreateCity::route('/create'),
            // 'edit'   => Pages\EditCity::route('/{record}/edit'),
        ];
    }

}
