<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        // Force JSON response for API routes
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'message' => 'Authentication Invalid',
                        'results' => [$e->getMessage()],
                        'code' => 401,
                        'errors' => true,
                    ], 401);
                }
            }
        });

        $this->renderable(function (RouteNotFoundException $e) {
            return response()->json([
                'message' => 'User Not Authenticated',
                'results' => [$e->getMessage()],
                'code' => 404,
                'errors' => true,
            ], 404);
        });

        $this->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'Data not found. Please double check your data.',
                'results' => [$e->getMessage()],
                'code' => 404,
                'errors' => true,
            ], 404);
        });

        $this->renderable(function (QueryException $e) {
            return response()->json([
                'message' => 'Some data does not exist. Please double check your data.',
                'results' => [$e->getMessage()],
                'code' => 404,
                'errors' => true,
            ], 404);
        });
    }
}