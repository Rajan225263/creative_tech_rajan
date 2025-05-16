<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Library Manageemnt API",
 *     version="1.0.0",
 *     description="Library Manageemnt API for Swagger integration",
 *     @OA\Contact(
 *         name="Rajan Bhatta (+88 0162119979, aobak63@gmail.com)",
 *         email="aobak63@gmail.com",

 *     ),

 * )
 *
 * @OA\Get(
 *     path="/api/hello",
 *     summary="Say Hello",
 *     tags={"Test"},
 *     @OA\Response(
 *         response=200,
 *         description="Success"
 *     )
 * )
 */
class TestSwaggerController extends Controller
{
    public function hello()
    {
        return response()->json(['message' => 'Hello from Swagger, Developer: Rajan Bhatta, Contact: +88 01621199769, Email: aobak63@gmail.com!']);
    }
}
