<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Admin\Field\Domain\Dto\FieldCollectionDto;
use Admin\Dropdown\Domain\Dto\DropdownCollectionDto;

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
