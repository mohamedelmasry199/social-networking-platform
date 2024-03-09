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
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                return $this->handleApiException($request, $e);
            }
        });
    }

    protected function handleApiException($request, $exception)
    {
        $statusCode = $this->getStatusCode($exception);

        return response()->json([
            'error' => [
                'message' => $exception->getMessage(),
                'status_code' => $statusCode
            ]
        ], $statusCode);
    }

    protected function getStatusCode($exception)
    {
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException ||
            $exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return 404;
        } elseif ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return 401;
        }

        return 400;
    }
}
