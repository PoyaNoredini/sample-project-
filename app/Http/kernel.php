<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * This middleware will be run during every request to your application.
     *
     * @var array<int, string>
     */
    protected $middleware = [
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

    ];

    /**
     * The application's route middleware groups.
     *
     * These middleware groups may be assigned to groups of routes as needed.
     *
     * @var array<string, array<int, string>>
     */
    protected $middlewareGroups = [
        'web' => [

            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],


        'auth.user' => [
            'auth:api',
            \App\Http\Middleware\UserMiddleware::class,
        ],

        'auth.admin' => [
            'auth:api',
            \App\Http\Middleware\AdminMiddleware::class,
        ],
        'auth' => [
            'auth:api',
            \App\Http\Middleware\AuthMiddleware::class,
        ],
        'auth.provider' => [
            'auth:api',
            \App\Http\Middleware\ProviderMiddleware::class,
        ],
        'auth.adminOrProvider' => [
            'auth:api',
            \App\Http\Middleware\AdminOrProviderMiddleware::class,
        ],

    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to individual routes.
     *
     * @var array<string, string>
     */
    protected $routeMiddleware = [
        'admin'           => \App\Http\Middleware\AdminMiddleware::class,
        'user'            => \App\Http\Middleware\UserMiddleware::class,
        'provider'        => \App\Http\Middleware\ProviderMiddleware::class,
        'auth'            => \App\Http\Middleware\AuthMiddleware::class,
        'adminOrProvider' => \App\Http\Middleware\AdminOrProviderMiddleware::class,
    ];
}
