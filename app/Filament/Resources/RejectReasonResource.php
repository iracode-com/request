<?php

namespace App\Filament\Resources;

use App\Enums\UserRole;
use App\Filament\Resources\RejectReasonResource\Pages;
use App\Filament\Resources\RejectReasonResource\RelationManagers;
use App\Models\RejectReason;
use App\Traits\LabelsTrait;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RejectReasonResource extends Resource
{
    use LabelsTrait;
    protected static ?string $model = RejectReason::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationGroup(): ?string
    {
        return __('Organizational information');
    }

    public static function canAccess(): bool
    {
        return current_user_has_role(UserRole::ADMIN);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->required()
                    ->options(RejectReason::TYPES),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->getStateUsing(function($record){
                        return array_key_exists($record->type, RejectReason::TYPES) ? RejectReason::TYPES[$record->type] : '';
                    })
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->jalaliDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->jalaliDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListRejectReasons::route('/'),
            // 'create' => Pages\CreateRejectReason::route('/create'),
            // 'edit' => Pages\EditRejectReason::route('/{record}/edit'),
        ];
    }
}
