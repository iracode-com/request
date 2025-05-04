<?php

namespace App\Filament\Pages\Auth;

use App\Enums\OtpAuthType;
use App\Enums\OtpType;
use App\Enums\UserRole;
use App\Forms\Components\OtpInput;
use App\Models\Otp;
use App\Models\User;
use App\Plugins\AuthUIEnhancerPlugin\Concerns\HasCustomLayout;
use App\Services\OtpService;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Events\Auth\Registered;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Get;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register;
use Filament\Forms\Components\Component;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;

class OtpRegister extends Register
{
    use HasCustomLayout;

    protected ?string $maxWidth = '2xl';
    protected OtpService $otpService;

    public function __construct()
    {
        $this->otpService = app(OtpService::class);
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        Wizard::make([
                            Wizard\Step::make(__('Register'))->schema([
                                $this->getTypeComponent(),
                                $this->getNameFormComponent(),
                                $this->getFamilyFormComponent(),
                                $this->getEmailFormComponent(),
                                $this->getMobileFormComponent(),
                                $this->getPhoneFormComponent(),
                                $this->getAddressFormComponent(),
                                $this->getPasswordFormComponent(),
                                $this->getPasswordConfirmationFormComponent(),
                                $this->getPrivacyPolicyFormComponent()
                            ])->afterValidation(fn($state) => $this->afterRegisterValidation($state)),
                            Wizard\Step::make(__('Mobile verification'))->schema([
                                $this->getOtpTokenFormComponent(),
                                $this->getOtpCodeFormComponent(),
                            ])
                        ])
                            ->skippable(false)
                            ->nextAction(fn(Action $action) => $action->label(__('Send otp')))
                            ->submitAction(new HtmlString(Blade::render(<<<BLADE
                                    <x-filament::button type="submit" size="sm" wire:submit="register">
                                        {{ __('Register') }}
                                        <span wire:loading wire:target="register">
                                            <x-filament::loading-indicator class="h-5 w-5" />
                                        </span>
                                    </x-filament::button>
                                BLADE
                            )))
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    public function register(): ?RegistrationResponse
    {
        $this->handleRateLimit();

        $data = $this->data;

        $this->verifyOtp($data);

        $user = $this->handleRegistration($data);

        $user->assignRole('user');

        event(new Registered($user));

        Filament::auth()->login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }

    protected function handleRegistration(array $data): Model
    {
        $user = $this->getUserModel()::firstOrCreate(
            ['mobile' => $data['mobile']],
            [
                'name' => $data['name'],
                'family' => $data['family'],
                'password' => $data['password'],
                'user_type' => $data['user_type'],
                'role' => UserRole::USER->value,
                'mobile_verified_at' => now(),
            ]
        );
        if ($user->user_type == 1) {
            $user->profile()->create([
                'fullname' => $user->name . ' ' . $user->family,
                'mobile' => $user->mobile
            ]);
        } else {
            $user->corporationProfile()->create([
                "company_name" => $data['name'],
                "phone" => $data['phone'],
                "address" => $data['address'],
            ]);
        }
        return $user;
    }

    protected function afterRegisterValidation(array $data): void
    {
        $this->handleRateLimit();

        // $user = $this->wrapInDatabaseTransaction(function () use ($data) {
        $this->callHook('beforeValidate');

        $this->callHook('afterValidate');

        $data = $this->mutateFormDataBeforeRegister($data);

        $this->callHook('beforeRegister');

        $this->callHook('afterRegister');

        // return $user;
        // });

        // if (! $user) {
        //     throw new Halt();
        // }

        $this->sendOtpCode(null, $data);
    }

    protected function sendOtpCode(User|null $user, $data): void
    {
        if ($user && !$user->wasRecentlyCreated && !$this->otpService->allowRequestOtp($user)) {
            Notification::make('too_many_requests')
                ->danger()
                ->title(__('Server Error'))
                ->body(__('Too Many Requests'))
                ->send();

            throw new Halt();
        }

        $otp = $this->otpService->create(null, [
            'login_id' => $data['mobile'],
            'type' => OtpType::MOBILE,
            'auth_type' => OtpAuthType::REGISTER,
            'ip' => request()->ip(),
            'agent' => request()->userAgent(),
        ]);

        $this->otpService->sendOtp($otp->code, $otp->login_id);

        Notification::make('otp_sent')
            ->success()
            ->title(__('Success'))
            ->body(__('Otp code sent successfully to :mobile', ['mobile' => $user?->mobile ?? $data['mobile']]))
            ->send();

        $this->form->fill([
            'user_type' => $data['user_type'],
            'token' => $otp->token,
            'password' => $data['password'],
            'passwordConfirmation' => $data['passwordConfirmation'],
            'privacy_policy' => $data['privacy_policy'],
            'name' => $data['name'],
            'family' => $data['family'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
        ]);
    }

    public function verifyOtp(array $data): void
    {
        // $otp = Otp::query()->notExpiredToken($data['token'])->first();
        $otp = Otp::where('token', $data['token'])
            ->where('expired', false)
            ->first();

        if (
            !$otp
            // ||
            // $otp->code != $data['otp']
        ) {
            Notification::make('invalid_code')
                ->danger()
                ->title(__('Error'))
                ->body(__('The given data was invalid.'))
                ->send();

            throw ValidationException::withMessages(['data.otp' => __('The given data was invalid.')]);
        }

        $this->otpService->markCodeAsUsed($otp);
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getTypeComponent(): Component
    {
        return Select::make('user_type')
            ->label(__('User Type'))
            ->required()
            ->options(User::USER_TYPES)
            ->default(1)
            ->live();
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label(function (Get $get) {
                return $get('user_type') && $get('user_type') == 1 ? __("Name") : __("Company name");
            })
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getFamilyFormComponent(): Component
    {
        return TextInput::make('family')
            ->label(__('Family'))
            ->visible(function (Get $get) {
                return $get('user_type') && $get('user_type') == 1;
            })
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->required()
            ->email()
            ->unique((new User)->getTable(), 'email', ignoreRecord: true);
    }

    protected function getMobileFormComponent(): Component
    {
        return TextInput::make('mobile')
            ->required()
            ->numeric()
            ->minLength(11)
            ->hint(__("Must starts with 09"))
            ->unique((new User)->getTable(), 'mobile', ignoreRecord: true)
            ->startsWith('09');
    }

    protected function getPhoneFormComponent(): Component
    {
        return TextInput::make('phone')
            ->required()
            ->visible(function (Get $get) {
                return $get('user_type') && $get('user_type') == 2;
            })
            ->hint(__("Must conains province prefix"))
            ->minLength(11);
    }

    protected function getAddressFormComponent(): Component
    {
        return Textarea::make('address')
            ->visible(function (Get $get) {
                return $get('user_type') && $get('user_type') == 2;
            });
    }

    protected function getOtpCodeFormComponent(): Component
    {
        return OtpInput::make('otp')
            ->required()
            ->numberInput(6);
    }

    protected function getOtpTokenFormComponent(): Component
    {
        return Hidden::make('token')->required();
    }

    protected function getPrivacyPolicyFormComponent(): Component
    {
        return Checkbox::make('privacy_policy')
            ->accepted()
            ->label(__('Rules and regulations'))
            ->helperText(new HtmlString(view('components.privacy-policy')));
    }

    protected function handleRateLimit()
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }
    }
}
