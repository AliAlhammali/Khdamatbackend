<?php

namespace App\Exceptions;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\Munjz\Base\Http\MunjzRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable(function (NotFoundHttpException $e, Request $request) {

            return response()->json([
                'message' => 'Page not found.'
            ], HttpStatus::HTTP_NOT_FOUND);

        });

        $this->renderable(function (RouteNotFoundException $e, Request $request) {

            return response()->json([
                'message' => $e->getMessage()
            ], HttpStatus::HTTP_NOT_FOUND);


        });
        $this->renderable(function (AuthenticationException $e, Request $request) {

            return response()->json([
                'message' => $e->getMessage()
            ], HttpStatus::HTTP_UNAUTHORIZED);


        });
        $this->renderable(function (ValidationException $e, Request $request) {

            return response()->json([
                'message' => KhadamatTeckRequest::validateRequest($e->validator)
            ], HttpStatus::HTTP_VALIDATION_ERROR);


        });
        $this->renderable(function (InternalErrorException $e, Request $request) {

            return response()->json([
                'message' => $e->getMessage()
            ], HttpStatus::HTTP_INTERNAL_SERVER_ERROR);


        });

        $this->renderable(function (QueryException $e, Request $request) {

            return response()->json([
                'message' => $e->getMessage()
            ], HttpStatus::HTTP_INTERNAL_SERVER_ERROR);


        });

    }
}
