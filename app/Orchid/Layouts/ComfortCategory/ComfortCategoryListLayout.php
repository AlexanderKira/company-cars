<?php

namespace App\Orchid\Layouts\ComfortCategory;

use App\Models\ComfortCategory;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ComfortCategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'comfort_category';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id'),
            TD::make('title', __('Title')),
            TD::make('description', __('Description')),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->canSee(Auth::user()->hasAccess('platform.cars.write'))
                ->render(function (ComfortCategory $comfortCategory) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->canSee(Auth::user()->hasAccess('platform.cars.write'))
                        ->list([
                            Link::make(__('Edit'))
                                ->icon('pencil')
                                ->route('platform.comfortCategories.edit', $comfortCategory),
                            Button::make(__('Remove'))
                                ->icon('trash')
                                ->confirm(__('Confirm action'))
                                ->method('remove', [
                                    'id' => $comfortCategory->id,
                                ]),
                        ]);
                }),
        ];
    }
}
