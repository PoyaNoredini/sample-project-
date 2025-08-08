<?php

namespace App\Traits;

trait ApiResponse
{
    public function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    public function errorResponse($message = null, $code = 400)
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'data'    => null
        ], $code);
    }
    public function userUnauthorizedResponse()
    {
        return response()->json([
            'status'  => 'error',
            'message' => 'یوزر دسترسی به این بخش ندارد',
            'data'    => null
        ], 401);
    }

    public function unauthorizedResponse()
    {
        return response()->json([
            'status'  => 'error',
            'message' => 'یوزر لاگین نیست',
            'data'    => null
        ], 401);
    }
    public function notFoundUserResponse()
    {
        return response()->json([
            'status'  => 'error',
            'message' => 'یوزر یافت نشد',
            'data'    => null
        ], 404);
    }
}
