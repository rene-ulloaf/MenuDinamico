<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler {
    protected $dontReport = [
        \Illuminate\Database\QueryException::class,
        /*
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
        */
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception) {
        parent::report($exception);
    }

    public function render($request, Throwable $exception) {
        /*if ($exception->getStatusCode() == 404) {
            //return Response::view('/error/400.blade.php', [], 404);
            //return Response::view('error.404', [], 404);
        }
        
        if ($exception->getStatusCode() == 500) {
            return response()->view('error.500', [], 500);
        }*/
        
        return parent::render($request, $exception);
    }
}