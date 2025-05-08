<?php

namespace App\Filament\Resources;

use App\Enums\UserRequestState;
use App\Enums\UserRole;
use App\Filament\Resources\NormalUserRequestResource\Pages;
use App\Filament\Resources\NormalUserRequestResource\RelationManagers;
use App\Models\RejectReason;
use App\Models\UserRequest;
use App\Traits\BadgeTrait;
use App\Traits\LabelsTrait;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NormalUserRequestResource extends Resource
{
    use LabelsTrait, BadgeTrait;
    protected static ?string $model = UserRequest::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __("User Requests");
    }

    public static function canDelete(Model $record): bool
    {
        return $record->status == UserRequestState::PENDING;
    }

    public static function canAccess(): bool
    {
        return current_user_has_role(UserRole::USER);
    }

    public static function canCreate(): bool
    {
        return current_user_has_role(UserRole::USER);
    }

    public static function canEdit(Model $record): bool
    {
        return current_user_has_role(UserRole::USER);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()->where('user_id', auth()->id());

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
        $user = auth()->user();

        return $form
            ->schema([
                Section::make(__("User Information"))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('profile_national_code')
                            ->label(__('National Code'))
                            ->required()
                            ->default(fn() => $user->user_type == 1 && $user->profile ? $user->profile->national_code : null)
                            ->visible(fn() => $user->user_type == 1),
                        Forms\Components\DatePicker::make('profile_birthdate')
                            ->label(__('Birthdate'))
                            ->jalali()
                            ->required()
                            ->default(fn() => $user->user_type == 1 && $user->profile ? $user->profile->birthdate : null)
                            ->visible(fn() => $user->user_type == 1),
                        Forms\Components\TextInput::make('profile_fathername')
                            ->label(__('Father Name'))
                            ->required()
                            ->default(fn() => $user->user_type == 1 && $user->profile ? $user->profile->fathername : null)
                            ->visible(fn() => $user->user_type == 1),

                        // Corporate profile fields
                        Forms\Components\TextInput::make('corp_company_code')
                            ->label(__('Company Code'))
                            ->required()
                            ->default(fn() => $user->user_type == 2 && $user->corporationProfile ? $user->corporationProfile->company_code : null)
                            ->visible(fn() => $user->user_type == 2),
                        Forms\Components\TextInput::make('corp_company_name')
                            ->label(__('Company Name'))
                            ->required()
                            ->default(fn() => $user->user_type == 2 && $user->corporationProfile ? $user->corporationProfile->company_name : null)
                            ->visible(fn() => $user->user_type == 2),
                        Forms\Components\TextInput::make('corp_company_owner_name')
                            ->label(__('Company Owner Name'))
                            ->required()
                            ->default(fn() => $user->user_type == 2 && $user->corporationProfile ? $user->corporationProfile->company_owner_name : null)
                            ->visible(fn() => $user->user_type == 2),
                        Forms\Components\DatePicker::make('corp_company_owner_birthdate')
                            ->label(__('Company Owner Birthdate'))
                            ->required()
                            ->jalali()
                            ->default(fn() => $user->user_type == 2 && $user->corporationProfile ? $user->corporationProfile->company_owner_birthdate : null)
                            ->visible(fn() => $user->user_type == 2),
                        Forms\Components\TextInput::make('corp_company_owner_mobile')
                            ->label(__('Company Owner Mobile'))
                            ->required()
                            ->default(fn() => $user->user_type == 2 && $user->corporationProfile ? $user->corporationProfile->company_owner_mobile : null)
                            ->visible(fn() => $user->user_type == 2),
                        Forms\Components\TextInput::make('corp_company_owner_national_code')
                            ->label(__('Company Owner National Code'))
                            ->required()
                            ->default(fn() => $user->user_type == 2 && $user->corporationProfile ? $user->corporationProfile->company_owner_national_code : null)
                            ->visible(fn() => $user->user_type == 2),
                        Forms\Components\TextInput::make('corp_phone')
                            ->label(__('Phone'))
                            ->required()
                            ->default(fn() => $user->user_type == 2 && $user->corporationProfile ? $user->corporationProfile->phone : null)
                            ->visible(fn() => $user->user_type == 2),
                        Forms\Components\TextInput::make('corp_address')
                            ->label(__('Address'))
                            ->required()
                            ->default(fn() => $user->user_type == 2 && $user->corporationProfile ? $user->corporationProfile->address : null)
                            ->visible(fn() => $user->user_type == 2),
                    ]),
                Section::make(__("Request Information"))
                    ->columns(2)
                    ->schema([
                        Forms\Components\Hidden::make('user_id')
                            ->default(auth()->id()),
                        Forms\Components\Hidden::make('tracking_code')
                            ->default(generateTrackingCode()),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('text')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('attachment')
                            ->columnSpanFull(),
                    ]),
                Section::make(__("Response Information"))
                    ->columns(2)
                    ->schema([
                        Forms\Components\Repeater::make('responses')
                            ->relationship()
                            ->reorderable(false)
                            ->deletable(false)
                            ->addable(false)
                            ->columnSpanFull()
                            ->columns(2)
                            ->defaultItems(0)
                            ->visibleOn(['edit'])
                            ->live()
                            ->label(function(Get $get){
                                return !$get('responses') || (is_array($get('responses')) && count($get('responses')) <= 0) ? __("Responses (No Item Found)") : __("Responses");
                            })
                            ->schema([
                                Forms\Components\Textarea::make('message')
                                    ->required()
                                    ->readOnly(),
                                Forms\Components\FileUpload::make('attachment')
                                    ->disabled(),
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tracking_code')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('approved_at')
                    ->jalaliDateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rejected_at')
                    ->jalaliDateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('closed_at')
                    ->jalaliDateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reject_reason.name')
                    ->searchable(),
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
            'index' => Pages\ListNormalUserRequests::route('/'),
            'create' => Pages\CreateNormalUserRequest::route('/create'),
            'edit' => Pages\EditNormalUserRequest::route('/{record}/edit'),
        ];
    }
}