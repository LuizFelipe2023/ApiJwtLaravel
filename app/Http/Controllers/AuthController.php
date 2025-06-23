<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Exception;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->login($request->validated());

            return response()->json([
                'status' => 'success',
                'user' => new UserResource($result['user']),
                'authorization' => [
                    'token' => $result['token'],
                    'type' => 'bearer',
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => new UserResource($result['user']),
            'authorization' => [
                'token' => $result['token'],
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh(): JsonResponse
    {
        $result = $this->authService->refresh();

        return response()->json([
            'status' => 'success',
            'user' => new UserResource($result['user']),
            'authorization' => [
                'token' => $result['token'],
                'type' => 'bearer',
            ]
        ]);
    }
}
