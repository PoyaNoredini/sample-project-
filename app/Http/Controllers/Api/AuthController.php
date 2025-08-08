<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiResponseController;
use App\Contracts\Services\Contracts\IAuthService;
use App\Contracts\Services\Contracts\IOtpService;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends ApiResponseController
{
    protected IAuthService $authService;
    protected IOtpService $otpService;

    public function __construct(IAuthService $authService, IOtpService $otpService)
    {
        $this->authService = $authService;
        $this->otpService  = $otpService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());
        return $this->successResponse($result, 'User registered successfully', 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());
        return $this->successResponse($result, 'Login successful');
    }
    public function sendOTP(Request $request): JsonResponse
    {
        $result = $this->otpService->sendOTP($request->phone_number);
        return $this->successResponse($result, 'OTP sent successfully');
    }
    public function forgotPassword(ForgetPasswordRequest $request): JsonResponse
    {
        $result = $this->authService->forgotPassword($request->validated());
        return $this->successResponse($result, 'OTP sent successfully for password reset');
    }
}
