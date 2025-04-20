<?php

namespace App\Filament\Resources;

use App\Enums\UserRequestState;
use App\Enums\UserRole;
use App\Filament\Resources\AdminUserRequestResource\Pages;
use App\Filament\Resources\AdminUserRequestResource\RelationManagers;
use App\Models\RejectReason;
use App\Models\User;
use App\Models\UserRequest;
use App\Traits\BadgeTrait;
use App\Traits\LabelsTrait;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class AdminUserRequestResource extends Resource
{
    use LabelsTrait, BadgeTrait;

    protected static ?string $model = UserRequest::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __("User Requests");
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canAccess(): bool
    {
        return current_user_has_role(UserRole::ADMIN);
    }

    public static function canEdit(Model $record): bool
    {
        return current_user_has_role(UserRole::ADMIN);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()->where('admin_user_id', auth()->id())->whereIn('status', [UserRequestState::APPROVED, UserRequestState::CLOSED, UserRequestState::PENDING]);

        if (
            static::isScopedToTenant() &&
            ($tenant = Filament::getTenant())
        ) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->disabled()
                    ->required()
                    ->options(function () {
                        return get_users_list();
                    }),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->readOnly()
                    ->maxLength(255),
                Forms\Components\Textarea::make('text')
                    ->required()
                    ->readOnly()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('attachment')
                    ->disabled(),
                Forms\Components\Select::make('status')
                    ->options(UserRequestState::class)
                    ->searchable()
                    ->live()
                    ->required(),
                Forms\Components\Select::make('reject_reason_id')
                    ->required()
                    ->searchable()
                    ->visible(function (Get $get) {
                        return $get('status') && $get('status') == UserRequestState::REJECTED->value;
                    })
                    ->options(RejectReason::where('is_active', 1)->get()->pluck('name', 'id')),
                Forms\Components\Repeater::make('responses')
                    ->relationship()
                    ->reorderable(false)
                    ->deletable(false)
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('attachment')
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->getStateUsing(function ($record) {
                        return $record->user?->name . ' ' . $record->user?->family . ' ' . (array_key_exists($record->user?->user_type, User::USER_TYPES) ? User::USER_TYPES[$record->user?->user_type] : '');
                    })
                    ->searchable(
                        query: fn(Builder $query, string $search) => $query->whereHas(
                            relation: 'user',
                            callback: fn(Builder $q) => $q->where('name', 'like', "%{$search}%")->orWhere('family', 'like', "%{$search}%")->orWhere('mobile', 'like', "%{$search}%")->orWhere(DB::raw('CONCAT(name, " ", family)'), 'like', '%' . $search . '%')
                        )
                    ),
                Tables\Columns\TextColumn::make('admin_user.name')
                    ->getStateUsing(function ($record) {
                        return $record->admin_user?->name . ' ' . $record->admin_user?->family;
                    })
                    ->searchable(
                        query: fn(Builder $query, string $search) => $query->whereHas(
                            relation: 'admin_user',
                            callback: fn(Builder $q) => $q->where('name', 'like', "%{$search}%")->orWhere('family', 'like', "%{$search}%")->orWhere('mobile', 'like', "%{$search}%")->orWhere(DB::raw('CONCAT(name, " ", family)'), 'like', '%' . $search . '%')
                        )
                    ),
                Tables\Columns\TextColumn::make('tracking_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('approved_at')
                    ->jalaliDateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('closed_at')
                    ->jalaliDateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->jalaliDateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->jalaliDateTime()
                    ->sortable(),
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
            'index' => Pages\ListAdminUserRequests::route('/'),
            'create' => Pages\CreateAdminUserRequest::route('/create'),
            'edit' => Pages\EditAdminUserRequest::route('/{record}/edit'),
        ];
    }
}
