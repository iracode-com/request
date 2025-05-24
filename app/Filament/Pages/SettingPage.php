<?php

namespace App\Filament\Pages;

use App\Enums\EmailProviderEnum;
use App\Enums\SocialNetworkEnum;
use App\Enums\UserRole;
use App\Support\EmailDataHelper;
use App\Mail\TestMail;
use App\Services\MailSettingsService;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Pages\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use function App\Support\error;
use function App\Support\saved;

class SettingPage extends Page
{
    // protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string  $view           = 'filament.pages.setting';
    public ?array $data = [];

    public static function getNavigationGroup(): ?string
    {
        return __('Setting');
    }

    public function getTitle(): string
    {
        return __('Setting');
    }

    public static function getNavigationLabel(): string
    {
        return __('Setting');
    }

    public function mount(): void
    {
        $this->data = Setting::query()->first()?->toArray() ?? [];

        $this->data['seo_description'] = $this->data['seo_description'] ?? '';
        $this->data['seo_preview']     = $this->data['seo_preview'] ?? '';
        $this->data['theme_color']     = $this->data['theme_color'] ?? '';
        $this->data['seo_metadata']    = $this->data['seo_metadata'] ?? [];
        $this->data                    = EmailDataHelper::getEmailConfigFromDatabase($this->data);


        if (isset($this->data['site_logo']) && is_string($this->data['site_logo'])) {
            $this->data['site_logo'] = [
                'name' => $this->data['site_logo'],
            ];
        }

        if (isset($this->data['site_favicon']) && is_string($this->data['site_favicon'])) {
            $this->data['site_favicon'] = [
                'name' => $this->data['site_favicon'],
            ];
        }
        
        if (isset($this->data['site_login_bg']) && is_string($this->data['site_login_bg'])) {
            $this->data['site_login_bg'] = [
                'name' => $this->data['site_login_bg'],
            ];
        }
    }

    public function form(Form $form): Form
    {
        $arrTabs = [];

        $arrTabs[] = Tabs\Tab::make(__('Application'))
            ->icon('heroicon-o-tv')
            ->schema([
                Forms\Components\TextInput::make('site_name')->autofocus()->columnSpanFull(),
                // Forms\Components\TextInput::make('site_description')->maxLength(1024)->columnSpanFull(),
                // Forms\Components\Textarea::make('address')->columnSpanFull(),
                Forms\Components\TextInput::make('copyright')->columnSpanFull(),

                Forms\Components\Grid::make()->schema([
                    Forms\Components\FileUpload::make('site_logo')
                        ->image()
                        ->moveFiles()
                        ->imageEditor()
                        ->getUploadedFileNameForStorageUsing(fn() => 'site_logo.png')
                        ->columnSpan(2),


                    Forms\Components\FileUpload::make('site_favicon')
                        ->image()
                        ->moveFiles()
                        // ->getUploadedFileNameForStorageUsing(fn() => 'site_favicon.ico')
                        // ->acceptedFileTypes(['image/x-icon', 'image/vnd.microsoft.icon'])
                        ->columnSpan(2),

                    Forms\Components\FileUpload::make('site_login_bg')
                        ->image()
                        ->moveFiles()
                        ->imageEditor()
                        ->columnSpan(2),

                ])->columns(4),
                Forms\Components\TextInput::make('support_email')->prefixIcon('heroicon-o-envelope'),
                Forms\Components\TextInput::make('support_phone')->prefixIcon('heroicon-o-phone'),

                // Forms\Components\ColorPicker::make('theme_color')->prefixIcon('heroicon-o-swatch')
                //     ->formatStateUsing(fn(?string $state): string => $state ?? config('filament.theme.colors.primary'))
                //     ->helperText('این رنگ به عنوان رنگ اصلی برای رنگ پیش فرض استفاده می شود، آن را خالی بگذارید'),
            ])
            ->columns(3);

        // $arrTabs[] = Tabs\Tab::make(__('Analytics'))
        //     ->icon('heroicon-o-globe-alt')
        //     ->schema([
        //         Forms\Components\TextInput::make('google_analytics_id')
        //             ->placeholder('UA-123456789-1'),
        //         Forms\Components\Textarea::make('posthog_html_snippet')
        //             ->placeholder('<script src=\'https://app.posthog.com/123456789.js\'></script>'),
        //     ]);

        // $arrTabs[] = Tabs\Tab::make(__('Seo'))
        //     ->icon('heroicon-o-window')
        //     ->schema([
        //         Forms\Components\ViewField::make('seo_description')->hiddenLabel()->view('forms.components.seo-description'),
        //         Forms\Components\Split::make([
        //             Forms\Components\Section::make([
        //                 Forms\Components\TextInput::make('seo_title'),
        //                 Forms\Components\TextInput::make('seo_keywords')->helperText('کلمات کلیدی را با کاما از هم جدا کنید'),
        //                 Forms\Components\KeyValue::make('seo_metadata'),
        //             ]),
        //             Forms\Components\Section::make([
        //                 Forms\Components\ViewField::make('seo_preview')->hiddenLabel()->view('forms.components.seo-preview', $this->data),
        //             ]),
        //         ]),
        //     ])
        //     ->columns(1);

        // $arrTabs[] = Tabs\Tab::make(__('Email'))
        //     ->icon('heroicon-o-envelope')
        //     ->schema([
        //         Forms\Components\Grid::make()
        //             ->schema([
        //                 Forms\Components\Section::make([
        //                     Forms\Components\Select::make('default_email_provider')
        //                         ->allowHtml()
        //                         ->preload()
        //                         ->options(function () {
        //                             $options = [];
        //                             foreach (EmailProviderEnum::options() as $key => $value) {
        //                                 if (file_exists(public_path('vendor/filament-general-settings/images/email-providers/' . strtolower($value) . '.svg'))) {
        //                                     $options[strtolower($value)] = '<div class="flex gap-2">' . ' <img src="' . asset('vendor/filament-general-settings/images/email-providers/' . strtolower($value) . '.svg') . '"  class="h-5">' . $value . '</div>';
        //                                 } else {
        //                                     $options[strtolower($value)] = $value;
        //                                 }
        //                             }

        //                             return $options;
        //                         })
        //                         ->helperText('برای پنهان کردن نماد شبکه اجتماعی، آن را خالی بگذارید')
        //                         ->live()
        //                         ->columnSpanFull(),

        //                     Forms\Components\Group::make()
        //                         ->schema([
        //                             Forms\Components\TextInput::make('smtp_host'),
        //                             Forms\Components\TextInput::make('smtp_port'),
        //                             Forms\Components\Select::make('smtp_encryption')->options(['ssl' => 'SSL', 'tls' => 'TLS',]),
        //                             Forms\Components\TextInput::make('smtp_timeout'),
        //                             Forms\Components\TextInput::make('smtp_username')->label(__('Username')),
        //                             Forms\Components\TextInput::make('smtp_password')->label(__('Password')),
        //                         ])
        //                         ->columns()
        //                         ->visible(fn($state) => $state['default_email_provider'] === 'smtp'),

        //                     Forms\Components\Group::make()
        //                         ->schema([
        //                             Forms\Components\TextInput::make('mailgun_domain'),
        //                             Forms\Components\TextInput::make('mailgun_secret'),
        //                             Forms\Components\TextInput::make('mailgun_endpoint'),
        //                         ])
        //                         ->columns(1)
        //                         ->visible(fn($state) => $state['default_email_provider'] === 'mailgun'),

        //                     Forms\Components\Group::make()
        //                         ->schema([
        //                             Forms\Components\TextInput::make('postmark_token'),
        //                         ])
        //                         ->columns(1)
        //                         ->visible(fn($state) => $state['default_email_provider'] === 'postmark'),

        //                     Forms\Components\Group::make()
        //                         ->schema([
        //                             Forms\Components\TextInput::make('amazon_ses_key'),
        //                             Forms\Components\TextInput::make('amazon_ses_secret'),
        //                             Forms\Components\TextInput::make('amazon_ses_region')->default('us-east-1'),
        //                         ])
        //                         ->columns(1)
        //                         ->visible(fn($state) => $state['default_email_provider'] === 'ses'),
        //                 ]),
        //             ])
        //             ->columnSpan(['lg' => 2]),
        //         Forms\Components\Grid::make()
        //             ->schema([
        //                 Forms\Components\Section::make([
        //                     Forms\Components\TextInput::make('email_from_name')
        //                         ->helperText("این نامی است که به عنوان نام 'از' برای همه ایمیل ها استفاده می شود"),
        //                     Forms\Components\TextInput::make('email_from_address')
        //                         ->helperText("این آدرس ایمیلی است که به عنوان آدرس ایمیل 'از' برای همه ایمیل ها استفاده می شود")
        //                         ->email(),
        //                 ]),
        //                 Forms\Components\Section::make()
        //                     ->schema([
        //                         Forms\Components\TextInput::make('mail_to')
        //                             ->hiddenLabel()
        //                             ->placeholder(fn() => __('mail_to'))
        //                             ->reactive(),
        //                         Forms\Components\Actions::make([
        //                             Forms\Components\Actions\Action::make('Send Test Mail')
        //                                 ->disabled(fn($state) => empty($state['mail_to']))
        //                                 ->action('sendTestMail')
        //                                 ->icon('heroicon-o-paper-airplane'),
        //                         ])->fullWidth(),
        //                     ]),
        //             ])
        //             ->columnSpan(['lg' => 1]),
        //     ])
        //     ->columns(3);


        // $arrTabs[] = Tabs\Tab::make(__('Social networks'))
        //     ->icon('heroicon-o-heart')
        //     ->schema(function () {
        //         $fields = [];
        //         foreach (SocialNetworkEnum::options() as $key => $value) {
        //             $fields[] = Forms\Components\TextInput::make($key);
        //         }

        //         return $fields;
        //     })
        //     ->columns()
        //     ->statePath('social_network');

        return $form
            ->schema([Tabs::make('Tabs')->tabs($arrTabs)])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Forms\Components\Actions\Action::make('Save')->color('primary')->submit('Update'),
        ];
    }

    public function update(): void
    {
        $data = $this->form->getState();

        $data = EmailDataHelper::setEmailConfigToDatabase($data);

        $data = $this->clearVariables($data);

        Setting::query()->updateOrCreate([], $data);

        saved(__('Settings saved'));

        $this->redirect(request()?->header('referrer'));
    }

    private function clearVariables(array $data): array
    {
        unset(
            $data['seo_preview'],
            $data['seo_description'],
            $data['default_email_provider'],
            $data['smtp_host'],
            $data['smtp_port'],
            $data['smtp_encryption'],
            $data['smtp_timeout'],
            $data['smtp_username'],
            $data['smtp_password'],
            $data['mailgun_domain'],
            $data['mailgun_secret'],
            $data['mailgun_endpoint'],
            $data['postmark_token'],
            $data['amazon_ses_key'],
            $data['amazon_ses_secret'],
            $data['amazon_ses_region'],
            $data['mail_to'],
        );

        return $data;
    }

    public function sendTestMail(MailSettingsService $mailSettingsService): void
    {
        $data = $this->form->getState();

        $email = $data['mail_to'];

        $settings = $mailSettingsService->loadToConfig($data);

        try {
            Mail::mailer($settings['default_email_provider'])
                ->to($email)
                ->send(new TestMail([
                    'subject' => 'This is a test email to verify SMTP settings',
                    'body'    => 'This is for testing email using smtp.',
                ]));
        } catch (\Exception $e) {
            error(__('Test email error'), $e->getMessage());

            return;
        }

        saved(__('Test email success') . $email);
    }

    public static function canAccess(): bool
    {
        return current_user_has_role(UserRole::SUPERADMIN);
    }
}
