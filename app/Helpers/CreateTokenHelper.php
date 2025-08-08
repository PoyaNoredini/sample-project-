<?php

namespace App\Helpers;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateTokenHelper
{
    /**
     * Create an access token for the user
     */
    public static function createAccessToken(User $user): string
    {
        return JWTAuth::fromUser($user);
    }

    /**
     * Create a refresh token for the user
     * Note: JWT typically uses the same token that can be refreshed
     */
    public static function createRefreshToken(User $user): string
    {
        // For JWT, you typically use the same token that can be refreshed
        // If you need different behavior, you might need to add custom claims
        return JWTAuth::fromUser($user);
    }

    /**
     * Refresh an existing token
     */
    public static function refreshToken(string $token): string
    {
        return JWTAuth::refresh($token);
    }
}
