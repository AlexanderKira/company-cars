<?php

namespace App\Orchid\Layouts\CarBooking;

use App\Models\CarBooking;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateRange;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class CarBookingEditLayout extends Rows
{
    public function __construct(protected CarBooking $carBooking)
    {
    }

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     * @throws \Throwable
     */
    protected function fields(): iterable
    {

        return [
            Label::make('car.model')
                ->title('Сar model '),
            Label::make('comfort_category.title')
                ->title('Comfort category'),
            Label::make('comfort_category.description')
                ->title('Description'),
            DateTimer::make('booking.start_date')
                ->title('Start of booking')
                ->enableTime(),
            DateTimer::make('booking.end_date')
                ->title('End of booking')
                ->enableTime(),
            Button::make(__('Save'))
                ->icon('check')
                ->type(Color::DEFAULT())
                ->method('save'),
        ];
    }
}
