<?php

namespace Modules\UserManagement\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Shared\Base\BaseController;
use Modules\UserManagement\Services\UserService;

class UserController extends BaseController
{
    public function __construct(protected UserService $service)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->getAll(),
            'message' => 'Users fetched successfully.',
        ]);
    }

    public function store(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->create([]),
            'message' => 'User created successfully.',
        ]);
    }

    public function show($user): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->find($user),
            'message' => 'User fetched successfully.',
        ]);
    }

    public function update($user): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->update($user, []),
            'message' => 'User updated successfully.',
        ]);
    }

    public function destroy($user): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->delete($user),
            'message' => 'User deleted successfully.',
        ]);
    }
}
