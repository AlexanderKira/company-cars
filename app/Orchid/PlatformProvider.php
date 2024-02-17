<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make(__('Booking'))
                ->icon('browser')
                ->route('platform.booking')
                ->permission('platform.booking.read'),

            Menu::make(__('Comfort category'))
                ->icon('browser')
                ->route('platform.comfortCategories')
                ->permission('platform.cars.read'),

            Menu::make(__('Cars'))
                ->icon('browser')
                ->route('platform.cars')
                ->permission('platform.cars.read'),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
            ItemPermission::group(__('Cars'))
                ->addPermission('platform.cars.read', __('Access to read cars'))
                ->addPermission('platform.cars.write', __('Access to write cars')),
            ItemPermission::group(__('Booking'))
                ->addPermission('platform.booking.read', __('Access to read booking'))
                ->addPermission('platform.booking.write', __('Access to write booking')),
        ];
    }
}
