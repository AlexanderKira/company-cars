<?php

namespace App\Orchid\Layouts\ComfortCategory;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class ComfortCategoryEditLayout extends Rows
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
            Input::make('comfort_category.title')
                ->type('text')
                ->title('Title')
                ->placeholder('title')
                ->required(),
            Input::make('comfort_category.description')
                ->type('text')
                ->title('Description')
                ->placeholder('description')
                ->required(),
            Button::make(__('Save'))
                ->icon('check')
                ->type(Color::DEFAULT())
                ->method('save'),
        ];
    }
}
