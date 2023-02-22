<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
//        $this->reportable(function (Throwable $e) {
//            //
//        });
        $this->renderable(function (Exception $exception, $request) {
            if (strpos($request->getPathInfo(), '/api/v') !== false) {
                if ($exception instanceof ModelNotFoundException) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Model not found'
                    ], Response::HTTP_NOT_FOUND);
                }
                if ($exception instanceof NotFoundHttpException) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Not found'
                    ], Response::HTTP_NOT_FOUND);
                }
                if ($exception instanceof MethodNotAllowedHttpException) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Method not allowed'
                    ], Response::HTTP_METHOD_NOT_ALLOWED);
                }
                if ($exception instanceof Exception) {
                    return response()->json([
                        'status' => 0,
                        'message' => $exception->getMessage()
                    ], Response::HTTP_NOT_FOUND);
                }
            }
        });
    }
}
