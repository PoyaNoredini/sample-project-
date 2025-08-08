<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;

class ApiResponseController extends Controller
{
    use ApiResponse;

    public function respondWithToken($token)
    {
        return response()->json([
            'status'       => 'success',
            'access_token' => $token,
            'token_type'   => 'bearer',
        ]);
    }
}
