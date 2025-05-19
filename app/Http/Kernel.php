<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // middleware global, jika ada
    ];

    protected $middlewareGroups = [
        'web' => [
            // daftar middleware untuk web
        ],

        'api' => [
            // daftar middleware untuk api
        ],
    ];

    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        // middleware route lainnya
    ];
}
