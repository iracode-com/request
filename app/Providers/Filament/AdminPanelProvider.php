<?php

namespace App\Providers\Filament;

use App\Enums\QuestionTypes;
use App\Enums\RoleEnum;
use App\Enums\UserRole;
use App\Filament\Pages;
use App\Filament\Pages\Auth\CustomRequestPasswordReset;
use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Auth\OtpRegister;
use App\Filament\Pages\CustomProfilePage;
use App\Filament\Resources\Organization\OrganizationResource\Pages\EditOrganization;
use App\Filament\Resources\Question\FirstAuditResource;
use App\Filament\Resources\Question\FirstAuditResource\Pages\CreateFirstAudit;
use App\Filament\Resources\Question\ServiceRequestResource;
use App\Filament\Widgets;
use App\Livewire\CustomEditProfileComponent;
use App\Models\Organization\Organization;
use App\Plugins\ArchivablePlugin\ArchivablePlugin;
use App\Plugins\AuthUIEnhancerPlugin\AuthUIEnhancerPlugin;
use App\Plugins\PdfViewerPlugin\PdfViewer;
use App\Plugins\PdfViewerPlugin\PdfViewerPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Devonab\FilamentEasyFooter\EasyFooterPlugin;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentPdfViewer\FilamentPdfViewerPlugin;
use Kenepa\Banner\BannerPlugin;
use Rmsramos\Activitylog\ActivitylogPlugin;
use function App\Support\setting;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->spa()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->registration(OtpRegister::class)
            ->passwordReset(CustomRequestPasswordReset::class)
            ->emailVerification()
            ->databaseNotifications()
            ->colors([
                ...self::color(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([Pages\Dashboard::class])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn() => auth()->user()->name)
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle'),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make()
                    ->sectionColumnSpan(1)
                    ->gridColumns(2)
                    ->checkboxListColumns(2),
                ThemesPlugin::make(),
                ActivitylogPlugin::make()->navigationItem(false),
                AuthUIEnhancerPlugin::make()
                    ->formPanelPosition('left')
                    ->showEmptyPanelOnMobile(true)
                    ->emptyPanelBackgroundImageUrl(Vite::asset('resources/assets/images/auth-banner.png')),
                ArchivablePlugin::make(),

                // self::configureEaseFooterPlugin(),

                EasyFooterPlugin::make()
                    ->withFooterPosition('sidebar.footer')
                    ->withSentence(new HtmlString('<img src="' . Vite::asset('resources/assets/images/iracode.webp') . '" width="30"> نسخه 1.0.0'))
                    ->withLinks([
                        ['title' => 'طراحی و توسعه توسط ایراکد', 'url' => 'https://iracode.com'],
                    ]),

                BannerPlugin::make()
                    ->navigationLabel(__("Banner Manager"))
                    ->title(__("Banner Manager"))
                    ->subheading('')
                    ->disableBannerManager()
                    ->persistsBannersInDatabase(),

                \Hasnayeen\Themes\ThemesPlugin::make()
                    ->canViewThemesPage(fn()=>current_user_has_role(UserRole::ADMIN)),

                FilamentEditProfilePlugin::make()
                    ->slug('my-profile')
                    ->shouldShowAvatarForm(true)
                    ->shouldShowEditProfileForm(false)
                    ->shouldRegisterNavigation(false)
                    ->shouldShowBrowserSessionsForm()
                    ->customProfileComponents([CustomEditProfileComponent::class])
            ])
            ->sidebarFullyCollapsibleOnDesktop()
            ->brandLogo(self::getBrandLogo())
            ->favicon(self::getFavicon())
            ->brandLogoHeight('3rem')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->navigationItems(self::navigation())
            ->navigationGroups([
                __('Organizational information'),
                __('Users management'),
                __('Setting'),
            ])
            ->unsavedChangesAlerts();
    }

    public static function navigation(): array
    {
        // bug: it is visible for user
        $questionnaires = [];

        foreach (QuestionTypes::cases() as $type) {
            $questionnaires[] = NavigationItem::make($type->getLabel())
                ->label($type->getLabel())
                ->url(fn(): string => $type->getAction())
                // ->visible($type->canView())
                ->parentItem(__('پرسشنامه ها'));
        }

        return [
            NavigationItem::make('organization')
                ->label(__('Organizational specification'))
                ->url(fn(): string => EditOrganization::getUrl(['record' => Organization::query()->first()->id]))
                ->visible(fn() => auth()->user()->can('update_organization::organization'))
                ->group(__('Organizational information')),

            // ...$questionnaires
        ];
    }

    public static function getBrandLogo(): string
    {
        if ($brandLogo = setting('site_logo')) {
            return Storage::url($brandLogo);
        }

        return Vite::asset('resources/assets/images/logo.png');
    }

    public static function getFavicon(): string
    {
        if ($favicon = setting('site_favicon')) {
            return asset('storage/' . $favicon);
        }

        return Vite::asset('resources/assets/images/logo.png');
    }

    public static function color(): array
    {
        return [
            'primary' => '#1A79FF' ?? setting('theme_color') ?? Color::Blue,
            'danger' => '#DC2626',
        ];
    }

    public static function configureEaseFooterPlugin()
    {
        return EasyFooterPlugin::make()
            ->withBorder()
            ->withSentence(new HtmlString('<img src="' . self::getBrandLogo() . '" width="40"> ' . setting('copyright')))
            ->withLinks([
                ['title' => 'صفحه اصلی', 'url' => 'https://iracode.com'],
                ['title' => 'تماس با ما', 'url' => 'https://iracode.com/about-us'],
                ['title' => 'درباره ما', 'url' => 'https://iracode.com/about-us'],
            ]);
    }
}
