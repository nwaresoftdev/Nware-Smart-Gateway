<?php

namespace App\Traits;

use App\Services\Api\V1\HybridCryptoEncService;

trait ResponseTrait
{
    protected $authUser;
    private bool $encrypter = true;


    public function successWithTokenResponse($data = [], $message = 'Success', $status = 200): \Illuminate\Http\JsonResponse
    {
        $time = auth('api')->factory()->getTTL() * config('session.lifetime');
        $token = auth('api')->setTTL($time)->login($this->authUser);
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $time,
        ];
        if($this->encrypter) {
            $response = HybridCryptoEncService::encryption($response);
        }
        return response()->json($response, $status);
    }

    public function successResponse($data = [], $message = 'Success', $status = 200): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];
        if($this->encrypter) {
            $response = HybridCryptoEncService::encryption($response);
        }
        return response()->json($response, $status);
    }

    public function errorResponse($message = 'Something went wrong', $status = 400, $errors = []): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ];

        if($this->encrypter) {
            $response = HybridCryptoEncService::encryption($response);
        }
        return response()->json($response, $status);
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

        if($this->encrypter) {
            $response = HybridCryptoEncService::encryption($response);
        }
        return response()->json($response, $status);
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
