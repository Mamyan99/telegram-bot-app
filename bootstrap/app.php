<?php

use App\Exceptions\BusinessLogicException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $exception) {
            $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $details = [
                'message' => $exception->getMessage(),
            ];

            if ($exception instanceof ValidationException) {
                $httpCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                $details['message'] = $exception->getMessage();

                foreach ($exception->errors() as $key => $error) {
                    $details['errors'][$key] = $error[0] ?? 'Unknown error';
                }
            }

            $data = [
                'errors' => $details,
            ];

            if (str_starts_with($httpCode, 5) && !config('app.debug')) {
                $data['errors'] = [
                    'message' => 'Server error',
                ];
            }

            return response()->json($data, $httpCode);
        });

    })->create();
