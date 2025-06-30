<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstrainedViolationException;
use Illuminate\Support\Facades\Log;
use Sympfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Http\Request;
use Sympfony\Component\HttpKernel\Exception\NotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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

     public function render($request, $e)
    {
        if ($request->expectsJson()) {
            Log::error($e);
             if ($e instanceof ValidationException) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                    return  $this->apiResponse([
                       'message' => "Validation Fail",
                       'success' => false,
                       'exception' => $e,
                       'error_code' =>  $statusCode,
               ]);
            }

             if ($e instanceof ModelNotFoundException) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                    return  $this->apiResponse([
                       'message' => "Resource Could Not Be Found",
                       'success' => false,
                       'exception' => $e,
                       'error_code' =>  $statusCode,
               ]);
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

             if ($e instanceof \Exception) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                    return  $this->apiResponse([
                       'message' => "An Error Occur Please Try Again Later",
                       'success' => false,
                       'exception' => $e,
                       'error_code' => $statusCode,
               ]);
            }

             if ($e instanceof Error) {
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
