<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Rmsramos\Activitylog\ActivitylogPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use CWSPS154\AppSettings\AppSettingsPlugin;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Filament\Forms\Components\FileUpload;
use Filament\Navigation\NavigationGroup;
use App\Filament\Resources\ActivityLogCustomResource;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->authGuard('web')
            ->brandLogoHeight('2.5rem')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(__('Users Managements'))
                    ->collapsed(),
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                ActivitylogPlugin::make()
                ->navigationGroup(__('Users Managements'))
                ->resource(ActivityLogCustomResource::class),
                AppSettingsPlugin::make(),
                BreezyCore::make()
                ->myProfile(
                    shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                    userMenuLabel: 'My Profile', // Customizes the 'account' link label in the panel User Menu (default = null)
                    shouldRegisterNavigation: true, // Sets the 'My Profile' link in the panel navigation (default = true)
                    navigationGroup: (__('Users Managements')), // Customizes the 'My Profile' link label in the panel navigation (default = null)
                    hasAvatars: true, // Sets the 'My Profile' link in the panel navigation (default = true)
                    slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                )
                ->avatarUploadComponent(fn() => FileUpload::make('avatar_url')->disk('profile-photos'))
                ->enableBrowserSessions()
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
