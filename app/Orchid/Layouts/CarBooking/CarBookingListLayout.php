<?php

namespace App\Orchid\Layouts\CarBooking;

use App\Models\Car;
use App\Models\CarBooking;
use App\Models\ComfortCategory;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CarBookingListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'booking';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id'),
            TD::make('car_id', __('Model'))
                ->filter(
                    Select::make()
                        ->empty('(no selected)')
                        ->fromModel(Car::class, 'model')
                )
                ->render(function (CarBooking $carBooking) {
                    return $carBooking->car->model ?? '-';
                }),
            TD::make('start_date', __('Start date')),
            TD::make('end_date', __('End date')),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->canSee(Auth::user()->hasAccess('platform.booking.write'))
                ->render(function (CarBooking $carBooking) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->canSee(Auth::user()->hasAccess('platform.booking.write'))
                        ->list([
                            Link::make(__('Edit'))
                                ->icon('pencil')
                                ->route('platform.booking.edit', $carBooking),
                        ]);
                }),
        ];
    }
}
