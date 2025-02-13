<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    // ...existing code...

    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e) {
            if (request()->is('api/*') || request()->wantsJson()) {
                return response()->json([
                    'message' => 'Halaman tidak ditemukan.'
                ], 404);
            }
            
            return response()->view('errors.404', [], 404);
        });
    }
}
