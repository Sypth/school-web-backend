<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Authentication Exception Handler
        $exceptions->renderable(function (AuthenticationException $e) {
            return response()->json([
                'message' => 'Authentication Invalid',
                'results' => [$e->getMessage()],
                'code' => 401,
                'errors' => true,
            ], 401);
        });

        // Route Not Found Exception Handler
        $exceptions->renderable(function (RouteNotFoundException $e) {
            return response()->json([
                'message' => 'User Not Authenticated',
                'results' => [$e->getMessage()],
                'code' => 404,
                'errors' => true,
            ], 404);
        });

        // HTTP Not Found Exception Handler
        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'Data not found. Please double check your data.',
                'results' => [$e->getMessage()],
                'code' => 404,
                'errors' => true,
            ], 404);
        });

        // Query Exception Handler
        $exceptions->renderable(function (QueryException $e) {
            return response()->json([
                'message' => 'Some data does not exist. Please double check your data.',
                'results' => [$e->getMessage()],
                'code' => 404,
                'errors' => true,
            ], 404);
        });
    })->create();
