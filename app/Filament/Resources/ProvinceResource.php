<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvinceResource\Pages;
use App\Models\Province;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;

class ProvinceResource extends Resource implements HasShieldPermissions
{
    use \App\Traits\HasShieldPermissions;

    protected static ?string $model          = Province::class;
    protected static ?int    $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('Organizational information');
    }

    public static function getNavigationLabel(): string
    {
        return __('Provinces');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Provinces');
    }

    public static function getModelLabel(): string
    {
        return __('Province');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label(__('Name'))->required(),
                Forms\Components\TextInput::make('name_en')->label(__('Latin name'))->required(),
                Forms\Components\TextInput::make('latitude')->label(__('Latitude')),
                Forms\Components\TextInput::make('longitude')->label(__('Longitude')),
                Forms\Components\Toggle::make('status')->label(__('Status'))->inline(false),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('Name')),
                Tables\Columns\TextColumn::make('name_en')->label(__('Latin name')),
                Tables\Columns\TextColumn::make('status')->badge()->label(__('Status')),
                Tables\Columns\TextColumn::make('latitude')->label(__('Latitude'))->searchable(),
                Tables\Columns\TextColumn::make('longitude')->label(__('Longitude'))->searchable(),
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
            'index' => Pages\ListProvinces::route('/'),
            // 'create' => Pages\CreateProvince::route('/create'),
            // 'edit'   => Pages\EditProvince::route('/{record}/edit'),
        ];
    }
}
