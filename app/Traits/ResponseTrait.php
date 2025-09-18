<?php

namespace App\Traits;

use App\Services\Api\V1\HybridCryptoEncService;
use Carbon\Carbon;

trait ResponseTrait
{
    protected $token = null;
    private bool $encrypter = false;
    private bool $appendRequestedData = true;


    private function envelope($error = false, $data = [], $message = 'Success', $status = 200, $withToken = true, $encrypted = true, $appendRequestedData = false)
    {
        $requestTime = Carbon::createFromTimestamp($_SERVER['REQUEST_TIME']);
        $now = Carbon::now();
        $time = auth('api')->factory()->getTTL() * config('session.lifetime');
        $token = $this->token; // ?? auth('api')->setTTL($time)->login($this->authUser);

        $response = [
            'status' => !$error,
            'message' => $message,
        ];

        if ($appendRequestedData) {
            $response['requestedData'] = $this->requestedData;
        } if ($error) {
            $response['errors'] = $data;
        } else {
            $response['data'] = $data;
        }
        if ($withToken) {
            $response['access_token'] = $token;
            $response['token_type'] = 'bearer';
            $response['expires_in'] = $time;
        }
        if ($encrypted) {
            $response = HybridCryptoEncService::encryption($response);
        }
        return response()->json($response, $status);
//        return $response;
    }

    public function successWithTokenResponse($data = [], $message = 'Success', $status = 200): \Illuminate\Http\JsonResponse
    {
//        $requestTime = Carbon::createFromTimestamp($_SERVER['REQUEST_TIME']);
//        $now = Carbon::now();
//        $time = auth('api')->factory()->getTTL() * config('session.lifetime');
////        $token = request()->bearerToken();
////        $token = auth('api')->setTTL($time)->login($this->authUser);
//        $token = $this->token;
//
//        $response = [
//            'status' => true,
//            'message' => $message,
//            'data' => $data,
//            'access_token' => $token,
//            'token_type' => 'bearer',
//            'expires_in' => $time,
//        ];
//        if ($this->encrypter) {
//            $response = HybridCryptoEncService::encryption($response);
//        }
//        return response()->json($response, $status);
        return $this->envelope(false, $data, $message, $status, true, $this->encrypter);
    }

    public function successResponse($data = [], $message = 'Success', $status = 200): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];
        if ($this->encrypter) {
            $response = HybridCryptoEncService::encryption($response);
        }
//        return response()->json($response, $status);
        return $this->envelope(false, $data, $message, $status, false, $this->encrypter, $this->appendRequestedData);
    }

    public function errorResponse($message = 'Something went wrong', $status = 400, $errors = []): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ];

        if ($this->encrypter) {
            $response = HybridCryptoEncService::encryption($response);
        }
//        return response()->json($response, $status);
        return $this->envelope(true, $errors, $message, $status, false, $this->encrypter, $this->appendRequestedData);
    }

    public function errorWithTokenResponse($message = 'Something went wrong', $status = 400, $errors = []): \Illuminate\Http\JsonResponse
    {
        $time = auth('api')->factory()->getTTL() * config('session.lifetime');
        $token = auth('api')->setTTL($time)->login($this->authUser);

        $response = [
            'status' => false,
            'message' => $message,
            'errors' => $errors,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $time,
        ];

        if ($this->encrypter) {
            $response = HybridCryptoEncService::encryption($response);
        }
//        return response()->json($response, $status);
        return $this->envelope(true, $errors, $message, $status, true, $this->encrypter);
    }

    public static function success($data = [], $message = 'Success', $status = 200): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data
        ];
        $response = HybridCryptoEncService::encryption($response);
        return response()->json($response, $status);
//        return response()->json([
//            'status' => true,
//            'message' => $message,
//            'data' => $data
//        ], $status);
    }

    public static function error($message = 'Something went wrong', $status = 400, $errors = []): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ];
        $response = HybridCryptoEncService::encryption($response);
        return response()->json($response, $status);
//        return response()->json([
//            'status' => false,
//            'message' => $message,
//            'errors' => $errors
//        ], $status);
    }
}
