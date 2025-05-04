<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\PasswordReset\RequestPasswordReset;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Support\Facades\Password;
use Filament\Notifications\Auth\ResetPassword as ResetPasswordNotification;
use App\Interfaces\ISmsHandler;
use Filament\Actions\Action;

class CustomRequestPasswordReset extends RequestPasswordReset
{
    /**
     * @return array<int | string, string | \Filament\Forms\Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getMobileFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getMobileFormComponent(): Component
    {
        return TextInput::make('mobile')
            ->label(__('Mobile'))
            ->minLength(11)
            ->maxLength(11)
            ->required()
            ->autofocus();
    }

    public function request(): void
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return;
        }

        $data = $this->form->getState();
        $data['email'] = $data['email'] ?? User::where('mobile', $data['mobile'])->first()?->email;

        $status = Password::broker(Filament::getAuthPasswordBroker())->sendResetLink(
            $data,
            function (CanResetPassword|User $user, string $token) use ($data): void {
                if (!method_exists($user, 'notify')) {
                    $userClass = $user::class;

                    throw new \Exception("Model [{$userClass}] does not have a [notify()] method.");
                }

                $notification = app(ResetPasswordNotification::class, ['token' => $token]);
                $notification->url = Filament::getResetPasswordUrl($token, $user);

                if ($notification->url) {
                    // info('reset pass', ["لینک تغییر رمز عبور شما: " . $notification->url]);
                    $smsHandler = app(ISmsHandler::class);
                    $smsHandler->sendSms(null, $data['mobile'], "لینک تغییر رمز عبور شما: ". $notification->url);
                }

                $user->notify($notification);
            },
        );

        if ($status !== Password::RESET_LINK_SENT) {
            Notification::make()
                ->title(__($status))
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(__($status))
            ->success()
            ->send();

        $this->form->fill();
    }

    protected function getRequestFormAction(): Action
    {
        return Action::make('request')
            ->label(__('Send Link'))
            ->submit('request');
    }
}