<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources;
use App\Models\Country;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CountryResource extends Resource implements HasShieldPermissions
{
    use \App\Traits\HasShieldPermissions;

    protected static ?string $model          = Country::class;
    protected static ?int    $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('Organizational information');
    }

    public static function getNavigationLabel(): string
    {
        return __('Countries');
    }

    public static function getModelLabel(): string
    {
        return __('Country');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Countries');
    }

    public static function canAccess(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fa_name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('en_name')
                    ->label(__('Latin name'))
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('fips')
                    ->label(__("Fips code"))
                    ->required(),
                Forms\Components\TextInput::make('iso')
                    ->label(__("Iso code"))
                    ->required(),
                Forms\Components\TextInput::make('domain')
                    ->label(__("Domain"))
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->label(__('Status'))
                    ->required()
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fa_name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('en_name')
                    ->label(__('Latin name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('fips')
                    ->label(__("Fips code"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso')
                    ->label(__("Iso code"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('domain')
                    ->label(__("Domain"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label(__('Status')),
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
            'index'  => CountryResource\Pages\ListCountries::route('/'),
            'create' => CountryResource\Pages\CreateCountry::route('/create'),
            'edit'   => CountryResource\Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
