<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\Contracts\IUserService;
use App\Http\Controllers\ApiResponseController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Requests\UpdateUserRequest;

class UserController extends ApiResponseController
{
    protected IUserService $userService;

    public function __construct(IUserService $userService)
    {

        $this->userService = $userService;
        $this->middleware(AdminMiddleware::class)->only([ 'destroy','index']);
        $this->middleware(AuthMiddleware::class)->only(['completeProfile']);
    }

    public function index()
    {
        return $this->successResponse($this->userService->index());
    }

    public function show(int $id)
    {
        return $this->successResponse($this->userService->show($id));
    }

    public function completeProfile(UpdateUserRequest $request)
    {
        $user=auth('api')->user();
        $validatedData = $request->validated();
        $result= $this->userService->update($user->id, $validatedData);
        return $this->successResponse($result);
    }

    public function destroy(int $id)
    {
        $result = $this->userService->delete($id);
        return $this->successResponse($result);
    }
}
