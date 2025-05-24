<?php

namespace App\Filament\Resources;

use App\Enums\UserRole;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use App\Filament\Resources\UserResource\Schemas;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource implements HasShieldPermissions
{
    use \App\Traits\HasShieldPermissions;

    protected static ?string $model          = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    public ?array            $permissions    = [];

    public static function getNavigationGroup(): ?string
    {
        return __('Users management');
    }

    public static function getLabel(): ?string
    {
        return __('User');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Users');
    }

    public static function canCreate(): bool
    {
        return current_user_has_role(UserRole::SUPERADMIN);
    }

    public static function canDelete(Model $record): bool
    {
        return current_user_has_role(UserRole::SUPERADMIN);
    }

    public static function canAccess(): bool
    {
        return current_user_has_role(UserRole::SUPERADMIN);
    }

    public static function canEdit(Model $record): bool
    {
        return current_user_has_role(UserRole::SUPERADMIN);
    }

    public static function form(Form $form): Form
    {
        // return match ($form->getOperation()) {
        //     'create' => $form->schema(Pages\CreateUser::schema()),
        //     'edit'   => $form->schema(Pages\EditUser::schema()),
        //     default  => throw new \Exception('Unsupported'),
        // };

        return $form->schema([
            Forms\Components\Tabs::make(__('User Management'))
                ->contained(false)
                ->tabs([
                    Forms\Components\Tabs\Tab::make(__('Expert personal information'))->icon('heroicon-o-user')
                        ->schema(Schemas\UserManagementSchema::schema()),

                    // Forms\Components\Tabs\Tab::make(__('Roles'))->icon('heroicon-o-finger-print')
                    //     ->schema(Schemas\RoleSchema::schema()),

                    // Forms\Components\Tabs\Tab::make(__('Organizational specification'))->icon('heroicon-o-building-office')
                    //     ->schema(Schemas\OrganizationSchema::schema()),

                    // Forms\Components\Tabs\Tab::make(__('Authorizations'))->icon('heroicon-o-key')
                    //     ->schema(Schemas\PermissionSchema::schema())
                    //     ->statePath('permissions')
                ])->columnSpanFull()
                ->persistTabInQueryString()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('family')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('mobile')->searchable(),
                Tables\Columns\TextColumn::make('role')->label(__('سطح دسترسی'))->sortable()->badge(),
                Tables\Columns\TextColumn::make('user_type')->getStateUsing(fn($record)=> array_key_exists($record->user_type, User::USER_TYPES) ? User::USER_TYPES[$record->user_type] : '')->label(__('User Type'))->sortable()->badge(),
                // Tables\Columns\TextColumn::make('roles.name')->listWithLineBreaks()->limitList()->expandableLimitedList()->sortable()->badge()->toggleable(),
                // Tables\Columns\TextColumn::make('roles.permissions.name')->listWithLineBreaks()->limitList()->expandableLimitedList()->sortable()->color('warning')->badge()->color('warning')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email_verified_at')->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('mobile_verified_at')->sortable()->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('ip')->searchable()->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('agent')->searchable()->words(3)->tooltip(fn(User $user) => $user->agent)->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('last_login')->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('status')->disabled(fn($record) => $record->id == auth()->id()),
                Tables\Columns\TextColumn::make('created_at')->jalaliDateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->jalaliDateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tables\Filters\SelectFilter::make('role')->label('سطح دسترسی')->options(UserRole::class),
                // Tables\Filters\SelectFilter::make('roles')->relationship('roles', 'nick_name')
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
