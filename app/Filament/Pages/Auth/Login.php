<?php

namespace App\Filament\Pages\Auth;

use App\Plugins\AuthUIEnhancerPlugin\Concerns\HasCustomLayout;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    use HasCustomLayout;

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getMobileFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $credentials = ['password' => $data['password']];
        $validator   = Validator::make(
            ['mobile' => $data['loginId']],
            ['mobile' => 'min:11']
        );

        $validator->passes()
            ? $credentials['mobile'] = $data['loginId']
            : $credentials['mobile'] = $data['loginId'];

        return $credentials;
    }

    protected function getMobileFormComponent(): Component
    {
        return TextInput::make('loginId')
            ->label(__('Mobile'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.loginId' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
