<?php

namespace App\Orchid\Screens\ComfortCategory;

use App\Http\Requests\ComfortCategory\ComfortCategoryRequest;
use App\Models\ComfortCategory;
use App\Orchid\Layouts\ComfortCategory\ComfortCategoryEditLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ComfortCategoryEditScreen extends Screen
{

    public ?ComfortCategory $comfortCategory = null;
    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ComfortCategoryEditLayout::class
        ];
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(ComfortCategory $comfortCategory): iterable
    {
        return [
            'comfort_category' => $comfortCategory
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ComfortCategoryEditScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return array_filter([
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ]);
    }

    public function save(ComfortCategoryRequest $request, ComfortCategory $comfortCategory): RedirectResponse
    {
        $validated = $request->validated();

        $data = $validated['comfort_category'];

        $comfortCategory->fill($data)->save();

        Toast::info('Comfort category created successfully');

        return redirect()->back();
    }


}
