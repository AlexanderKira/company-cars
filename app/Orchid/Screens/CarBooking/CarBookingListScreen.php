<?php

namespace App\Orchid\Screens\CarBooking;

use App\Models\Car;
use App\Models\CarBooking;
use App\Orchid\Layouts\CarBooking\AllCarsListLayout;
use App\Orchid\Layouts\CarBooking\CarBookingListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;

class CarBookingListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $user = Auth::user();
        $comfortCategoriesId = json_decode($user->comfort_categories_id, true);

        return [
            'booking' => CarBooking::filters()
                ->where('user_id', $user->id)
                ->defaultSort('id', 'desc')
                ->paginate(),
            'cars' => Car::filters()
                ->whereIn('comfort_category_id', $comfortCategoriesId)
//                ->where('booking_status', false)->defaultSort('id', 'desc')
                    //если забронирована, то доступна на следующий день после завершения бронирования
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Cars Booking';
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

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CarBookingListLayout::class,
            AllCarsListLayout::class,
        ];
    }
}
