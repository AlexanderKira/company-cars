<?php

namespace App\Orchid\Screens\CarBooking;

use App\Http\Requests\Booking\CarBookingRequest;
use App\Models\Car;
use App\Models\CarBooking;
use App\Orchid\Layouts\CarBooking\CarBookingEditLayout;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class CarBookingEditScreen extends Screen
{
    public ?CarBooking $carBooking = null;

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CarBookingEditLayout::class
        ];
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(?CarBooking $carBooking, $carId = null): iterable
    {
        if (!$carId) {
            $carId = $carBooking->car->id;
        }

        $car = Car::find($carId);

        $start_date = $carBooking->end_date;

        if ($start_date) {
            $carBooking->start_date = Carbon::parse($start_date)->addDay();
            $carBooking->end_date = null;
        }

        return [
            'car' => $car,
            'comfort_category' => $car->comfortCategory,
            'booking' => $carBooking,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'CarBookingEditScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    public function save(CarBookingRequest $request, CarBooking $carBooking, $carId = null): RedirectResponse
    {

        $user = Auth::user();

        if (!$carId) {
            $carId = $carBooking->car->id;
        }

        $validated = $request->validated();

        $booking = $validated['booking'];

        $data = [
            'start_date' => $booking['start_date'],
            'end_date' => $booking['end_date'],
            'car_id' => $carId,
            'user_id' => $user->id
        ];

        $carBooking->fill($data);
        $carBooking->save();

        $car = Car::find($carId);
        $car->booking_status = true;
        $car->save();

        Toast::info('booking successful');

        return redirect()->route('platform.booking');
    }


}
