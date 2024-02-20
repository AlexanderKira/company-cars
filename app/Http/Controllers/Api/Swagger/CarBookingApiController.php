<?php

namespace App\Http\Controllers\Api\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Company cars API",
 *     version="1.0.0",
 * ),
 *
 * @OA\Get(
 *     path="/api/car-booking/index",
 *     summary="Show all car reservations or filter by model, comfort category, date and time of reservation (access_token required).",
 *     tags={"car-booking"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         name="model",
 *         in="query",
 *         description="Audi A8, BMW 7, MERCEDES-BENZ C-CLASS, Audi A3",
 *         required=false,
 *         @OA\Schema(
 *             type="array",
 *             @OA\Items(type="string", example="Audi a8")
 *         ),
 *         style="form",
 *         explode=true,
 *         allowEmptyValue=true
 *     ),
 *
 *     @OA\Parameter(
 *         name="comfort_categories_title",
 *         in="query",
 *         description="luxury, representative, average, golf",
 *         required=false,
 *         @OA\Schema(
 *             type="array",
 *             @OA\Items(type="string", example="luxury")
 *         ),
 *         style="form",
 *         explode=true,
 *         allowEmptyValue=true
 *     ),
 *
 *     @OA\Parameter(
 *         name="start_date",
 *         in="query",
 *         description="car-booking start date",
 *         required=false,
 *         example="2024-02-18 08:00:00",
 *         schema={
 *             "type": "string",
 *             "format": "date-time"
 *         }
 *     ),
 *
 *     @OA\Parameter(
 *         name="end_date",
 *         in="query",
 *         description="car-booking end date",
 *         required=false,
 *         example="2024-02-30 18:00:00",
 *         schema={
 *             "type": "string",
 *             "format": "date-time"
 *         }
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Filtering by status and date we get a list of applications.",
 *         @OA\JsonContent(
 *             @OA\Property(property="cars", type="object",
 *                 @OA\Property(property="id", type="integer", example="10"),
 *                 @OA\Property(property="model", type="string", example="Audi A8"),
 *                 @OA\Property(property="chauffeur", type="string", example="Prof. Brant Lehner"),
 *                 @OA\Property(property="comfort_category", type="string", example="Audi A8"),
 *                 @OA\Property(property="booking_status", type="string", example="available"),
 *                 @OA\Property(property="start_date_booking", type="string", example="2024-02-18 00:00:00"),
 *             ),
 *         )
 *     ),
 * )
 */




class CarBookingApiController extends Controller
{
    //
}
