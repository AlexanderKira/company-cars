<?php

declare(strict_types=1);

use App\Orchid\Screens\Car\CarEditScreen;
use App\Orchid\Screens\Car\CarListScreen;
use App\Orchid\Screens\CarBooking\CarBookingEditScreen;
use App\Orchid\Screens\CarBooking\CarBookingListScreen;
use App\Orchid\Screens\ComfortCategory\ComfortCategoryEditScreen;
use App\Orchid\Screens\ComfortCategory\ComfortCategoryListScreen;
use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

Route::prefix('cars')->group(function () {
    // Platform > Cars
    Route::screen('/', CarListScreen::class)
        ->name('platform.cars')
        ->breadcrumbs(fn (Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('Cars'), route('platform.cars')));
    // Platform > Cars > Create
    Route::screen('/create', CarEditScreen::class)
        ->name('platform.cars.create')
        ->breadcrumbs(fn (Trail $trail) => $trail
            ->parent('platform.cars')
            ->push(__('Create'), route('platform.cars.create')));
    // Platform > Cars > Edit
    Route::screen('/{car}/edit', CarEditScreen::class)
        ->name('platform.cars.edit')
        ->breadcrumbs(fn (Trail $trail, $car) => $trail
            ->parent('platform.cars')
            ->push($car->model, route('platform.cars.edit', $car)));
});

Route::prefix('comfort')->group(function () {
    // Platform > ComfortCategories
    Route::screen('/', ComfortCategoryListScreen::class)
        ->name('platform.comfortCategories')
        ->breadcrumbs(fn (Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('Comfort categories'), route('platform.comfortCategories')));
    // Platform > ComfortCategories > Create
    Route::screen('/create', ComfortCategoryEditScreen::class)
        ->name('platform.comfortCategories.create')
        ->breadcrumbs(fn (Trail $trail) => $trail
            ->parent('platform.comfortCategories')
            ->push(__('Create comfort categories'), route('platform.comfortCategories.create')));
    // Platform > ComfortCategories > Edit
    Route::screen('/{comfortCategory}/edit', ComfortCategoryEditScreen::class)
        ->name('platform.comfortCategories.edit')
        ->breadcrumbs(fn (Trail $trail, $comfortCategory) => $trail
            ->parent('platform.comfortCategories')
            ->push($comfortCategory->title, route('platform.comfortCategories.edit', $comfortCategory)));
});

Route::prefix('booking')->group(function () {
    // Platform > Booking
    Route::screen('/', CarBookingListScreen::class)
        ->name('platform.booking')
        ->breadcrumbs(fn (Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('Booking'), route('platform.booking')));
    // Platform > Booking > Create
    Route::screen('/{carId}/create', CarBookingEditScreen::class)
        ->name('platform.booking.create')
        ->breadcrumbs(fn (Trail $trail, $carId) => $trail
            ->parent('platform.booking')
            ->push(__('Create'), route('platform.booking.create', $carId)));
    // Platform > Cars > Edit
    Route::screen('/{carBooking}/edit', CarBookingEditScreen::class)
        ->name('platform.booking.edit')
        ->breadcrumbs(fn (Trail $trail, $carBooking) => $trail
            ->parent('platform.booking')
            ->push('booking id' . '-' . $carBooking->id, route('platform.booking.edit', $carBooking)));
});


