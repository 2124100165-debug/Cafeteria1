<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // Redirigir usuarios no autenticados al login
        $middleware->redirectTo(guests: '/login');
        
        // 🌟 AGREGA ESTA LÍNEA AQUÍ PARA EVITAR EL ERROR 419 EN POSTMAN:
        $middleware->validateCsrfTokens(except: [
            'productos/guardar',
            'pedidos/guardar',
            'proveedores/guardar'
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();