<?php

use App\Services\Api\V1\HybridCryptoEncService;
use App\Services\EncryptDecryptCryptoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::shouldUse('api');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test', function (Request $request) {
   return "1231232312";
});

// Encrypt response for client
Route::get('/enc', function (Request $request) {
    $data = [
        'status' => 'success',
        'amount' => 5000,
        'currency' => 'INR'
    ];
    $crypto = new EncryptDecryptCryptoService();
    $encrypted = $crypto->encryptWithPublicKey($data);

    return response()->json(['payload' => $encrypted]);
});


// Encrypt response for client
Route::get('/enc1', function (Request $request) {

    $service = new HybridCryptoEncService();

    $payload = [
        'user' => 'Arun',
        'role' => 'guest',
        'timestamp' => now()->toDateTimeString(),
    ];

    // Encrypt the payload
    $encrypted = $service->encrypt($payload);

    // Decrypt the payload
    $decrypted = $service->decrypt($encrypted);
    return response()->json(['payload' => $decrypted, 'encrypted' => $encrypted]);
});

Route::get('/decry', function (Request $request) {

    $crypto = new EncryptDecryptCryptoService();
    $encryptedPayload = $request->input('payload');
    $encryptedPayload = "EWmI1Wner3VLdRknzwM+7uIC+2j17TNdHmJTZaJcEnlFPxqwGelgI+s7tAyfZMgbAxyj28MKnKaUnsYrS1oAjDRKBit1Y3+XwZLVOs9\/kgxxdH2o7f+hSJ5MG+ADloI09TZR8TntluYgh95GXI7KCl9b2oHnIrgjYCMwnhOMLuOetw6ED+nmra6XSHRCEGUwg6HwWR3vTl8RdW87i\/aaEUeZ\/LPYKGgSl0APoQyL8fzscKgMXx5zjdoySFe6Sy1hasTATgmNaUr5BpgntwTUHP6SkBSpQFMbuDWAV4M6Y+vfg1jT9X6MRLC4KoQN+EYjyFIKmw6xMU8X37mKwOlqXcIS+a61I14QoODa3JplKn8XLxOV1WSYBLhMVnd3+bc+yUbWc+plVvyypa\/z50bpej4+uSQVripaV2vqoPN+DacYybXT7TEUyKBRoKDEv0GjnV0HEexRoPTvpx1C0StJ1pc+scIGXrgciO+KH06Hhhbt5nc2Ggt6PxD68OxX3oNEoQymvRfQHMrOcZt+vpJpjrg+DUtQgFGyAsNBFs1vRIT2Sn9VCu4S30RRuj0YqcgxP878BAz49QjLroGC7RWxC\/7nNRYNSV5WRHbJzp0lf4NhN9hoWddFx2uNEFD9iom61USvlE6Z3ppaVYGsHm6j6sx\/8JgnDyB0zn+MjzmgYTc=";

    $decrypted = $crypto->decryptWithPrivateKey($encryptedPayload);

    return response()->json([
        'status' => 'decrypted_ok',
        'data'   => $decrypted,
    ]);
});

// API Start
Route::group(["prefix" => 'v1'], function () {
    //TODO:: Testing API for Encryption and Decryption
    Route::post('test-encryption', function (Request $request) {
        $payload = $request->toArray();
        $payload = HybridCryptoEncService::encryption($payload);
        return response()->json($payload);
    });
    Route::post('test-decryption', function (Request $request) {
        $response = $request->toArray();
        $response = HybridCryptoEncService::decryption($response);
        return response()->json($response);
    });


    Route::post('get-login-otp', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'getLoginOtp']);
    Route::post('resend-otp', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'getLoginOtp']);
    Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'logout']);

    Route::post('get-gateway-details', [\App\Http\Controllers\Api\V1\DeviceController::class, 'getGatewayDetails']);
    Route::post('gateway-on-off', [\App\Http\Controllers\Api\V1\DeviceController::class, 'gatewayOnOff']);
    Route::post('device-grouping', [\App\Http\Controllers\Api\V1\DeviceController::class, 'deviceGrouping']);
    Route::post('favourite', [\App\Http\Controllers\Api\V1\DeviceController::class, 'favourite']);

    Route::post('get-node-details', [\App\Http\Controllers\Api\V1\NodeController::class, 'getNodeDetails']);
    Route::post('node-on-off', [\App\Http\Controllers\Api\V1\NodeController::class, 'nodeOnOff']);
    Route::post('node-smart-switch-on-off', [\App\Http\Controllers\Api\V1\NodeController::class, 'nodeSmartSwitchOnOff']);

    Route::post('get-report', [\App\Http\Controllers\Api\V1\DeviceController::class, 'getReport']);
    Route::post('get-power-source', [\App\Http\Controllers\Api\V1\DeviceController::class, 'getPowerSource']);



});
