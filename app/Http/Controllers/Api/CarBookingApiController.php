<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarBookingApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $status = $request->get('status');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if ($applications) {
            return response()->json(['applications' => $applications], 200);
        } else {
            return response()->json(['message' => 'No applications.'], 400);
        }
    }
}
