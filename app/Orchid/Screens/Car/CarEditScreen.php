<?php

namespace App\Orchid\Screens\Car;

use App\Http\Requests\Car\CarRequest;
use App\Models\Car;
use App\Orchid\Layouts\Car\CarEditLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class CarEditScreen extends Screen
{

    public ?Car $car = null;

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CarEditLayout::class
        ];
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Car $car): iterable
    {
        return [
            'car' => $car
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'CarEditScreen';
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
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Confirm action'))
                ->method('remove')
                ->canSee($this->car->exists),
        ]);
    }

    public function save(CarRequest $request, Car $car): RedirectResponse
    {
        $validated = $request->validated();

        $data = $validated['car'];

        $car->fill($data)->save();

        Toast::info('Car created successfully');

        return redirect()->back();
    }

    public function remove(Car $car): RedirectResponse
    {
        $car->delete();

        Toast::info(__('Car was removed'));

        return redirect()->route('platform.cars');
    }


}
