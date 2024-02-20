<?php

namespace App\Http\Controllers;

use App\Http\Service\CarBookingApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarBookingApiController extends Controller
{
    protected CarBookingApiService $carBookingApiService;

    public function __construct(CarBookingApiService $carBookingApiService)
    {
        $this->carBookingApiService = $carBookingApiService;
    }

    public function index(Request $request): JsonResponse
    {

        $user = Auth::user();
        $cars = $this->carBookingApiService->getCarsAvailableUser($user);

        $model = $request->get('model');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if ($model) {
            $this->carBookingApiService->getCarsByModel($cars, $model);
        }

        $comfortCategoriesTitleGet = $request->get('comfort_categories_title');

        if ($comfortCategoriesTitleGet) {
            $this->carBookingApiService->getCarsByComfortCategory($cars, $comfortCategoriesTitleGet);
        }

        if (!$endDate) {
            $endDate = $startDate;
        }

        $carsAvailableUser = $cars->get()->where('booking_status', false);

        $retrieveUsersBookedCars = $this->carBookingApiService->retrieveUsersBookedCars($cars, $startDate, $endDate);

        if ($carsAvailableUser) {
            $cars = $carsAvailableUser->merge($retrieveUsersBookedCars)->values()->all();
        }else{
            $cars = $carsAvailableUser;
        }

        $searchCars = $this->carBookingApiService->responseToCarSearch($cars, $endDate, $startDate);

        if ($searchCars) {
            return response()->json(['cars' => $searchCars], 200);
        } else {
            return response()->json(['message' => 'No cars available for booking'], 400);
        }
    }
}
