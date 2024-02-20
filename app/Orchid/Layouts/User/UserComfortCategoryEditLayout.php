<?php

namespace App\Orchid\Layouts\User;

use App\Models\ComfortCategory;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class UserComfortCategoryEditLayout extends Rows
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
            Select::make('user.comfort_categories_id.')
                ->fromModel(ComfortCategory::class, 'title', 'id')
                ->multiple()
                ->title(__('Comfort categories'))
                ->help('Specify which car comfort categories are available to the user'),
        ];
    }
}
