<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

Trait ApiResponseTrait
{
    private function parseGivenData(array $data = [], int $statusCode = 200, array $headers = []): array
    {
        //success, message, result,errors,'exception',status, 'error_code

        $responseStructure = [
            'success' => $data['success'] ?? false,
            'message' => $data['message'] ?? null,
            'result' => $data['result'] ?? null
        ]; 

        if (isset($data['errors'])) {
            $responseStructure['errors'] = $data['errors'];
        }

        if (isset($data['status'])) {
            $statusCode = $data['status'];
        }

        if (isset($data['exception']) && ($data['exception'] instanceof \Error || $data['exception'] instanceof \Exception)) {
            if (config('app.env') !== 'production') {
                $responseStructure['exception'] = [
                    'message' => $data['exception']->getMessage(),
                    'file' => $data['exception']->getFile(),
                    'line' => $data['exception']->getLine(),
                    'code' => $data['exception']->getCode(),
                    'trace' => $data['exception']->getTrace()
                ];
            }

            if($statusCode == 200) {
                $statusCode = 500;
            }
        }

        if($data['success'] === false) {
            if(isset($data['error_code'])) {
                $responseStructure['error_code'] = $data['error_code'];
            } else {
               $responseStructure['error_code'] = 1;   
            }
        }
        return ['content' => $responseStructure, 'statusCode' =>$statusCode, 'headers' => $headers ];
    }

    public function apiResponse(array $data = [], int $statusCode = 200, array $headers = [])
    {
        $result = $this->parseGivenData($data, $statusCode, $headers);

        return response()->json($result['content'], $result['statusCode'], $result['headers']);
    }

    public function sendSuccess($data, string $message = ''): JsonResponse 
    {
       return $this->apiResponse([
            'success' => true,
            'result' => $data,
            'message' => $message
        ]);
    }  

     public function sendUnauthorized(string $message = 'unauthorized') {
         return $this->sendError($message);
    }

      public function sendForbidden(string $message = 'forbidden'): JsonResponse {

         return $this->sendForbidden($message);

    }

      public function sendInternalServerError(string $message = 'Internal Server Error'): JsonResponse {

         return $this->sendError($message);

    }

      public function sendValidationError(ValidationException $exception): JsonResponse {

         return  $this->apiResponse([
            'success' => false,
            'message' => $exception->getMessage(),
            'error' => $exception->errors(),
        ]);

    }
}