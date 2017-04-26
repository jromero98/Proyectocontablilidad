<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'entrust-gui.admin' => \Acoustep\EntrustGui\Http\Middleware\AdminAuth::class,
        'cuentas_manuales'=> \App\Http\Middleware\cuentas_manuales::class,
        'balance'=> \App\Http\Middleware\Balance::class,
        'ver-usuario'=> \App\Http\Middleware\ver_usuario::class,
        'crear-usuario'=> \App\Http\Middleware\crear_usuario::class,
        'editar-usuario'=> \App\Http\Middleware\editar_usuario::class,
        'ver-rol'=> \App\Http\Middleware\ver_rol::class,
        'crear-rol'=> \App\Http\Middleware\crear_rol::class,
        'editar-rol'=> \App\Http\Middleware\editar_rol::class,
        'administrar-puc'=> \App\Http\Middleware\AdministraPuc::class,
        'facturar-ventas'=> \App\Http\Middleware\FacturarVentas::class,
        'facturar-compras'=> \App\Http\Middleware\FacturarCompras::class,
        'categoria'=> \App\Http\Middleware\Categoria::class,
        'articulo'=> \App\Http\Middleware\Articulo::class,
        'ver-kardex'=> \App\Http\Middleware\Kardex::class,
    ];
}
