<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    protected function respond(mixed $data, int $statusCode = 200, array $headers = []): JsonResponse
    {
        return response()->json($data, $statusCode, $headers);
    }

    protected function respondCreated(mixed $data): JsonResponse
    {
        return $this->respond($data, 201);
    }
}
