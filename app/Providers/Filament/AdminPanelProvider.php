<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Filament\Pages;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Bytexr\QueueableBulkActions\Enums\StatusEnum;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Bytexr\QueueableBulkActions\QueueableBulkActionsPlugin;
use Croustibat\FilamentJobsMonitor\FilamentJobsMonitorPlugin;
use Filament\Forms\Components\FileUpload;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile(isSimple: false)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->spa()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ->authGuard('web')
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentSpatieLaravelBackupPlugin::make()
                    ->authorize(fn() => auth()->user()?->can('page_Backups')),
                FilamentSpatieLaravelHealthPlugin::make()
                    ->authorize(fn() => auth()->user()?->can('page_HealthCheckResults')),
                BreezyCore::make()
                    // ->avatarUploadComponent(fn($fileUpload) => $fileUpload->disableLabel())
                    ->avatarUploadComponent(fn() => FileUpload::make('profile_photo_url')->disk('profile-photos')->avatar())
                    ->enableTwoFactorAuthentication()
                    ->myProfile(
                        shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                        userMenuLabel: 'My Profile', // Customizes the 'account' link label in the panel User Menu (default = null)
                        shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                        navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                        hasAvatars: true, // Enables the avatar upload form component (default = false)
                        slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                    ),
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 4,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
                // Job Monitor Plugin
                QueueableBulkActionsPlugin::make()
                    // ->bulkActionModel(YourBulkActionModel::class) // (optional) - Allows you to register your own model which extends \Bytexr\QueueableBulkActions\Models\BulkAction
                    // ->bulkActionRecordModel(YourBulkActionRecordModel::class) // (optional) - Allows you to register your own model for records which extends \Bytexr\QueueableBulkActions\Models\BulkActionRecord
                    // ->renderHook(PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE) // (optional) - Allows you to change where notification is rendered, multiple render hooks can be passed as array [Default: PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE]
                    // ->pollingInterval('5s') // (optional) - Allows you to change or disable polling interval, set to null to disable. [Default: 5s]
                    // ->queue('redis', 'default')  // (optional) - Allows you to change which connection and queue should be used [Default: env('QUEUE_CONNECTION'), default]
                    // ->resource(YourBulkActionResource::class) // (optional) - Allows you to change which resource should be used to display historical bulk actions
                    ->colors([
                        StatusEnum::QUEUED->value => 'slate',
                        StatusEnum::IN_PROGRESS->value => 'info',
                        StatusEnum::FINISHED->value => 'success',
                        StatusEnum::FAILED->value => 'danger',
                    ]), // (optional) - Allows you to change notification and badge colors used for statuses. Uses filament colors defined in panel provider. [Default: as show in method]
                FilamentJobsMonitorPlugin::make(),
            ]);
    }
}
