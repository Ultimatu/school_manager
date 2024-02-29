<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

  
    // if ($e->getCode() == 404) {
    //     return response()->view('components.errors.404', [], 404);
    // }

    // if ($e->getCode() == 403) {
    //     return response()->view('components.errors.403', [], 403);
    // }

    // if ($e->getCode() == 500) {
    //     return response()->view('components.errors.500', [], 500);
    // }

    // if ($e->getCode() == 503) {
    //     return response()->view('components.errors.503', [], 503);
    // }

    // if ($e->getCode() == 401) {
    //     return response()->view('components.errors.401', [], 401);
    // }

    // if ($e->getCode() == 419) {
    //     return response()->view('components.errors.419', [], 419);
    // }

    // if ($e->getCode() == 505) {
    //     return response()->view('components.errors.505', [], 505);
    // }
}
