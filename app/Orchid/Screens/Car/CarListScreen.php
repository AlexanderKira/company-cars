<?php

namespace App\Orchid\Screens\Car;

use App\Models\Car;
use App\Orchid\Layouts\Car\CarListLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class CarListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'cars' => Car::filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'CarListScreen';
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
                ->route('platform.cars.create'),
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
            CarListLayout::class
        ];
    }

    public function remove(Request $request): void
    {
        Car::findOrFail($request->get('id'))->delete();

        Toast::info(__('Car was removed'));
    }
}
