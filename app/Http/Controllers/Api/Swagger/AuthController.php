<?php

namespace App\Http\Controllers\Api\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 *
 * @OA\Compontents(
 *      @OA\SecurityScheme(
 *          securityScheme="bearerAuth",
 *          type="http",
 *          scheme="bearer"
 *      )
 *  )
 *
 * @OA\Post(
 *         path="/api/auth/login",
 *         summary="get admin access token(sample).",
 *         tags={"Auth"},
 *
 *         @OA\RequestBody(
 *             @OA\JsonContent(
 *                 allOf={
 *                     @OA\Schema(
 *                         @OA\Property(property="email", type="string", example="admin@admin.com"),
 *                         @OA\Property(property="password", type="string", example="password"),
 *                     )
 *                 }
 *             )
 *         ),
 *
 *         @OA\Response(
 *             response=201,
 *             description="Сopy the access token into the authorization.",
 *             @OA\JsonContent(
 *                 @OA\Property(property="access_token", type="bearer", example="access_token"),
 *             )
 *         ),
 *     ),
 */

class AuthController extends Controller
{
    //
}
