<?php

namespace App\Providers\Filament;

use App\Filament\Reports\Pages\AnnRepDashboard;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ReportsPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('reports')
            ->path('reports')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Reports/Resources'), for: 'App\Filament\Reports\Resources')
            ->discoverPages(in: app_path('Filament/Reports/Pages'), for: 'App\Filament\Reports\Pages')
            ->pages([
                AnnRepDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Reports/Widgets'), for: 'App\Filament\Reports\Widgets')
            ->widgets([
            ])
            ->navigationItems([
                NavigationItem::make('RadDB')
                    ->url('/')
                    ->icon(Heroicon::OutlinedHome)
                    ->sort(1),
                NavigationItem::make('Shielding Requests')
                    ->url('shielding')
                    ->icon(Heroicon::OutlinedShieldCheck)
                    ->sort(3),
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
                // Authenticate::class,
            ]);
    }
}
