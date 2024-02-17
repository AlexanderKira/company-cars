<?php

namespace App\Orchid\Layouts\Car;

use App\Models\Car;
use App\Models\ComfortCategory;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CarListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'cars';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id'),
            TD::make('model', __('Model')),
            TD::make('chauffeur', __('Chauffeur')),
            TD::make('booking_status', __('Booking status'))
                ->render(function (Car $car) {
                    return $car->booking_status ? 'booked' : 'available';
                }),
            TD::make('comfort_category_id', __('Comfort category'))
                ->filter(
                    Select::make()
                        ->empty('(no selected)')
                        ->fromModel(ComfortCategory::class, 'title')
                )
                ->render(function (Car $car) {
                    return $car->comfortCategory->title ?? '-';
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->canSee(Auth::user()->hasAccess('platform.cars.write'))
                ->render(function (Car $car) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->canSee(Auth::user()->hasAccess('platform.cars.write'))
                        ->list([
                            Link::make(__('Edit'))
                                ->icon('pencil')
                                ->route('platform.cars.edit', $car),
                            Button::make(__('Remove'))
                                ->icon('trash')
                                ->confirm(__('Confirm action'))
                                ->method('remove', [
                                    'id' => $car->id,
                                ]),
                        ]);
                }),
        ];
    }
}
