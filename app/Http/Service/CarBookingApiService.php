<?php

namespace App\Http\Service;

use App\Models\Car;
use App\Models\CarBooking;
use App\Models\ComfortCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class CarBookingApiService
{
    public function getCarsAvailableUser($user) {

        $comfortCategoriesId = json_decode($user->comfort_categories_id, true);
        return Car::whereIn('comfort_category_id', $comfortCategoriesId);
    }

    public function getCarsByModel($cars, $model) {
        if (is_array($model)) {
            $cars->whereIn('model', $model);
        } else {
            $cars->where('model', $model);
        }
        return $cars;
    }

    public function getCarsByComfortCategory($cars, $comfortCategoriesTitleGet)
    {
        $cars->whereHas('comfortCategory', function ($query) use ($comfortCategoriesTitleGet) {
            if (is_array($comfortCategoriesTitleGet)) {
                $query->whereIn('title', $comfortCategoriesTitleGet);
            } else {
                $query->where('title', $comfortCategoriesTitleGet);
            }
        });
        return $cars;
    }

    public function retrieveUsersBookedCars($cars, $startDate = null, $endDate = null)
    {
        if($startDate && $endDate){
            $carBookings = CarBooking::where('start_date', '>=', $startDate)
                ->where('end_date', '<=', $endDate)
                ->pluck('car_id');
            return $cars->whereIn('id', $carBookings)->get();
        }
        return $cars;
    }

    public function responseToCarSearch($cars, $startDate = null , $endDate = null): array
    {
        $searchCars = [];

        foreach ($cars as $car) {
            $searchCars[] = [
                'id' => $car->id,
                'model' => $car->model,
                'comfort_category' => $this->getComfortCategory($car),
                'chauffeur' => $car->chauffeur,
                'booking_status' => $car->booking_status ? 'booked' : 'available',
                'start_date_booking' => $this->getAvailableBookingDate($car, $startDate, $endDate)
            ];
        }

        return $searchCars;
    }

    protected function getComfortCategory($car)
    {
       return ComfortCategory::where('id', $car->comfort_category_id)->value('title');
    }

    protected function getAvailableBookingDate ($car, $endDateSearch = null): string
    {
       $start_date_new_booking = CarBooking::where('car_id', $car->id)->value('end_date');

       if($start_date_new_booking){
           if($start_date_new_booking <= $endDateSearch){
               return $endDateSearch;
           }else{
               return $start_date_new_booking;
           }
       }else{
           return Date::today()->now()->toDateTimeString();
       }
    }

}
