<?php

namespace App\Orchid\Screens\ComfortCategory;

use App\Models\ComfortCategory;
use App\Orchid\Layouts\ComfortCategory\ComfortCategoryListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ComfortCategoryListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'comfort_category' => ComfortCategory::filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ComfortCategoryListScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return array_filter([
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.comfortCategories.create'),
        ]);
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ComfortCategoryListLayout::class
        ];
    }

    public function remove(Request $request): void
    {
        ComfortCategory::findOrFail($request->get('id'))->delete();

        Toast::info(__('Car was removed'));
    }
}
