<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        return $this->returnValidationResponse($request, $exception);
    }

    private function returnValidationResponse($request, Throwable $exception): object
    {
        if ($this->checkIsRequestApi($request) && $exception instanceof ValidationException) {
            return response()->json(
                $exception->errors(),
                $exception->status
            );
        }
        
        return parent::render($request, $exception);
    }
    private function checkIsRequestApi($request): bool
    {
        return $request->is("api/*");
    }
}
