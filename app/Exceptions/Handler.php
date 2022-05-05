<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if(strpos($request->getRequestUri(), '/api/', 0) == 0 &&
        get_class($exception) == NotFoundHttpException::class)
        {
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'PageNotFound',
                    'message' => 'Page does not exists.'
                ],
                'meta' => ''
            ], 400);
        }

        if($exception instanceof ValidationException){
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'ValidationError',
                    'message' => $exception->validator->errors()
                ],
                'meta' => ''
            ], 400);
        }

        return parent::render($request, $exception);
    }
}
