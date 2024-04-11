<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function response(array $data = [], int $statusCode = JsonResponse::HTTP_OK): JsonResponse
    {
        return response()->json($data, $statusCode);
    }
}
