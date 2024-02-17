<?php

namespace App\Orchid\Layouts\Car;

use App\Models\ComfortCategory;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class CarEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('car.model')
                ->type('text')
                ->title('model')
                ->placeholder('model')
                ->required(),
            Input::make('car.chauffeur')
                ->type('text')
                ->title('Chauffeur')
                ->placeholder('Chauffeur')
                ->required(),
            Select::make('car.comfort_category_id')
                ->title(__('Comfort category'))
                ->options(ComfortCategory::query()->get()->pluck('title', 'id'))
                ->required(),
            CheckBox::make('car.booking_status')
                ->title('Booking status')
                ->sendTrueOrFalse(),
            Button::make(__('Save'))
                ->icon('check')
                ->type(Color::DEFAULT())
                ->method('save'),
        ];
    }
}
