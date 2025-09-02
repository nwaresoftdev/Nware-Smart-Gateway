<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Otp;
use App\Models\User;
use App\Services\Api\V1\HybridCryptoEncService;
use App\Traits\BhashSmsTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;

class LoginController extends Controller
{
    use BhashSmsTrait, \App\Traits\ResponseTrait;


    public function getLoginOtp(Request $request)
    {
//        $credentials = request(['mobile', 'userName']);
        $response = $request->toArray();
        $credentials = HybridCryptoEncService::decryption($response);
        $user = User::with('otps')->whereIn('mobile', $credentials)->first();

        if (!$user) {
            return $this->errorResponse('User Not Found');
        }
        if (!$user->is_active) {
            return $this->errorResponse('User Not Active');
        }
        $otp = $this->generateOtp();
        $user->otps()->create(
            ['type' => 'login', 'otp' => $otp, 'created_at' => null, 'verified_at' => null]
        );

        $mobile = $user->mobile_no;

        // TODO:: Remove [true] for sending sms
        if (true || $this->sendSms($mobile, $otp, $user->name, "Login")) {
            $response = ['status' => true, 'message' => 'SMS SENT', 'otp' => $otp];
//            return response()->json([HybridCryptoEncService::enc($response),HybridCryptoEncService::dec(HybridCryptoEncService::enc($response))], 200);
            return $this->successResponse(['otp' => $otp], 'SMS SENT');
        } else {
            return $this->errorResponse('SMS Not SENT');
        }
    }

    public function login(Request $request)
    {
//        $credentials = request(['userName', 'mobile']);
        $response = $request->toArray();
        $credentials = HybridCryptoEncService::decryption($response);

        $user = $this->authUser = User::with(['roles', 'otps'])->whereIn('mobile', [$credentials['mobile']])->first();

        if (!$user) {
            return $this->errorResponse('User Not Found', 401);
        }
        $otp = Otp::whereIn('otp', [$credentials['OTP']])->where(['user_id' => $user->id, 'type' => 'login'])->latest()->first();

        if (is_null($otp)) {
            return $this->errorResponse('OTP IS Not Found');
        } elseif ($otp->verified_at) {
            return $this->errorResponse('OTP IS Already Used');
        } elseif ($this->timeDiffenceInMinutes($otp->created_at) > env('OPT_EXPIRE')) {
            return $this->errorResponse('OTP IS Expired');
        }

        if ($otp && in_array($otp->otp, [$credentials['OTP']])) {
//            $time = auth('api')->factory()->getTTL() * config('session.lifetime');
//            $token = auth('api')->setTTL($time)->login($user);
            Otp::updateOptVerifiedAt($otp);
            User::updateInformation($user);
            $data = [
                'user' => User::with('roles')->where('id', auth('api')->id())->first(),
            ];
            $now = Carbon::now();
            $user = new UserResource($user);

            return $this->successWithTokenResponse(collect($user)->except(['roles', 'devices']));
//            return response()->json(HybridCryptoEncService::enc([
//                'userDetail' => collect($user)->except(['roles', 'devices']),
//                'access_token' => $token,
//                'token_type' => 'bearer',
//                'expires_in' => $time,
//            ]));
        }
        return $this->errorResponse('You Have Entered Wrong OTP', 401);
    }

    public function logout()
    {
        auth()->logout();

        return $this->successResponse('Successfully logged out');
    }

    /*END::CLASS*/
}
