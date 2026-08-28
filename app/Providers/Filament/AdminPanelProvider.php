<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Pages\Auth\Login;
use App\Filament\Widgets\RecentSalesOrders;
use App\Filament\Widgets\SalesOverview;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->profile(
            EditProfile::class,
            isSimple: false,)
            ->userMenu(position: \Filament\Enums\UserMenuPosition::Sidebar)
            ->userMenuItems([
                'logout' => fn (Action $action) => $action->color('danger'),
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->brandName('Joyce and Kenneth I.T. Service')
            ->brandLogo('/images/logo1.png')
            ->brandLogoHeight('3.1rem')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                SalesOverview::class,
                RecentSalesOrders::class,
            ])
            ->navigationItems([
                NavigationItem::make('Customers')->group('Sales')->url('#')->sort(1),
                NavigationItem::make('Customer Groups')->group('Sales')->url('#')->sort(2),
                NavigationItem::make('Products')->group('Sales')->url('#')->sort(3),
                NavigationItem::make('Services')->group('Sales')->url('#')->sort(4),
                NavigationItem::make('Price Lists')->group('Sales')->url('#')->sort(5),
                NavigationItem::make('Quotations')->group('Sales')->url('#')->sort(6),
                NavigationItem::make('Delivery')->group('Sales')->url('#')->sort(8),
                NavigationItem::make('Sales Invoices')->group('Sales')->url('#')->sort(9),
                NavigationItem::make('Payments')->group('Sales')->url('#')->sort(10),
                NavigationItem::make('Returns')->group('Sales')->url('#')->sort(11),
                NavigationItem::make('Discounts')->group('Sales')->url('#')->sort(12),
                NavigationItem::make('Sales Representatives')->group('Sales')->url('#')->sort(13),
                NavigationItem::make('Sales Reports')->group('Sales')->url('#')->sort(14),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}