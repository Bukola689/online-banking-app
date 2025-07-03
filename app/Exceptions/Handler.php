<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstrainedViolationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Sympfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Illuminate\Http\Request;

use Sympfony\Component\HttpKernel\Exception\NotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

     public function render($request, $e): Response
    {
        if ($request->expectsJson() || Str::contains($request->path(), 'api')) {
            Log::error($e);
             if ($e instanceof AuthenticationException) {
                 $statusCode = Response::HTTP_AUTHORIZED;
                    return  $this->apiResponse([
                       'message' => 'UnAuthorized or expire token, Try to Login Again',
                       'success' => false,
                       'exception' => $e,
                       'error_code' =>  $statusCode,
               ], $statusCode());
            }

             if ($e instanceof NotFoundHttpException) {
                    return  $this->apiResponse([
                       'message' => $e->getMessage(),
                       'success' => false,
                       'exception' => $e,
                       'error_code' =>  $getStatusCode,
               ], $e->getStatusCode());
            }

             if ($e instanceof ValidationException) {
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                    return  $this->apiResponse([
                       'message' => "Validation Fail",
                       'success' => false,
                       'exception' => $e,
                       'error_code' =>  $statusCode,
                       'error' => $e->errors(),
               ], $statusCode);
            }

             if ($e instanceof ModelNotFoundException) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                    return  $this->apiResponse([
                       'message' => "Resource Could Not Be Found",
                       'success' => false,
                       'exception' => $e,
                       'error_code' =>  $statusCode,
               ], $statusCode);
            }

            if ($e instanceof UniqueConstraintViolationException) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                    return  $this->apiResponse([
                       'message' => "Duplicate Entry Found",
                       'success' => false,
                       'exception' => $e,
                       'error_code' =>  $statusCode,
               ]);
            }

              if ($e instanceof QueryException) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                    return  $this->apiResponse([
                       'message' => "Could Not Execute Query",
                       'success' => false,
                       'exception' => $e,
                       'error_code' => $statusCode,
               ]);
            }

               if ($e instanceof MethodNotAllowedException) {
                $statusCode = Response::HTTP_BAD_REQUEST;
                    return  $this->apiResponse([
                       'message' => $e->getMessage(),
                       'success' => false,
                       'exception' => $e,
                       'error_code' => $statusCode,
                    ], Response::HTTP_BAD_REQUEST);
            }

               if ($e instanceof PinNotSetException) {
                $statusCode = Response::HTTP_BAD_REQUEST;
                    return  $this->apiResponse([
                       'message' => $e->getMessage(),
                       'success' => false,
                       'exception' => $e,
                       'error_code' => $statusCode,
               ],  Response::HTTP_BAD_REQUEST );
            }

             if ($e instanceof InvalidPinLengthException) {
                $statusCode = Response::HTTP_BAD_REQUEST;
                    return  $this->apiResponse([
                       'message' => $e->getMessage(),
                       'success' => false,
                       'exception' => $e,
                       'error_code' => $statusCode,
               ],  Response::HTTP_BAD_REQUEST );
            }

             if ($e instanceof PinHasAlreadyBeenSetException ) {
                $statusCode = Response::HTTP_BAD_REQUEST;
                    return  $this->apiResponse([
                       'message' => $e->getMessage(),
                       'success' => false,
                       'exception' => $e,
                       'error_code' => $statusCode,
               ],  Response::HTTP_BAD_REQUEST );
            }


             if ($e instanceof \Exception) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                    return  $this->apiResponse([
                       'message' => "We could not handle your request",
                       'success' => false,
                       'exception' => $e,
                       'error_code' => $statusCode,
               ]);
            }

             if ($e instanceof \Error) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                    return  $this->apiResponse([
                       'message' => "Could Not Execute Query",
                       'success' => false,
                       'exception' => $e,
                       'error_code' => $statusCode,
               ]);
            }
        }

       return parent::render($request, $e);
    }
}
