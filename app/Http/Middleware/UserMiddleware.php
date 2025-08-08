<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponse;

class UserMiddleware
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('api')->user();

        // Check if user is authenticated
        if (!$user) {
            return $this->unauthorizedResponse();
        }

        // Check if user type is 'user'
        if ($user->user_type !== 'user') {
            return $this->userUnauthorizedResponse();
        }

        return $next($request);
    }
}
