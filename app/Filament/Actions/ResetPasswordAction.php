<?php

namespace App\Filament\Actions;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'reset_password';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->form([
                TextInput::make('password')
                    ->inlineLabel()
                    ->live()
                    ->password()
                    ->revealable()
                    ->confirmed()
                    ->required(),
                TextInput::make('password_confirmation')
                    ->inlineLabel()
                    ->live()
                    ->password()
                    ->revealable()
                    ->required()
            ])
            ->action(function (array $data, User $user) {
                $user
                    ->forceFill(['password' => $data['password']])
                    ->setRememberToken(Str::random(60));

                $user->save();

                Notification::make()->success()->title(__('Your password has been updated!'))->send();
            })
            ->icon('heroicon-o-arrow-path')
            ->color('danger')
            ->requiresConfirmation()
            ->visible(fn(string $operation, ?User $record) => (
                $operation == 'edit'
                && auth()->user()->canResetUsersPassword()
                && $record->isNot(auth()->user()))
            );
    }
}
