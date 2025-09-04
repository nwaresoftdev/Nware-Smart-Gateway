<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use App\Services\Api\V1\HybridCryptoEncService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    use ResponseTrait;
    const GATEWAY_TYPE_ID = 1;

    protected $requestedData = null;

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->token = $request->bearerToken();
        $encryptedData = $request->toArray();
        $this->requestedData = HybridCryptoEncService::decryption($encryptedData);
    }

    /**
     * @param Request $request { "id": 1}
     * @return JsonResponse
     */
    public function getGatewayDetails(Request $request): JsonResponse
    {
        try {
            $user = \App\Models\User::findOrFail($this->authUser->id);

            $devices = $user->devices->where('device_type_id', self::GATEWAY_TYPE_ID);
            if ($devices) {
                $devices = DeviceResource::collection( $devices );
                return $this->successResponse($devices);
            }else{
                return $this->errorResponse('Device not found');
            }
        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param Request $request { "id": 1, "device_on_off": on | off | true | false | 1 | 0 }
     * @return JsonResponse
     */
    public function gatewayOnOff(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = \App\Models\User::findOrFail($this->authUser->id);
        $device = $user->devices->find($this->requestedData['id']);
        if ($device) {
            if ( $this->requestedData['device_on_off'] == 'on' || $this->requestedData['device_on_off'] == '1' || $this->requestedData['device_on_off'] === true) {
                $device->device_on_off = true;
            }else{
                $device->device_on_off = false;
            }
            $device->save();
            $device = new DeviceResource($device);
            return $this->successResponse($device);
        }else{
            return $this->errorResponse('Device not found');
        }
    }

    /**
     * @param Request $request {"group_id": 1, "device_ids": [1,2,3]}
     * @return JsonResponse
     */
    public function deviceGrouping(Request $request): JsonResponse
    {
        try {
            $user = \App\Models\User::findOrFail($this->authUser->id);
            $groups = $user->groups->find($this->requestedData['group_id']);
            if ($groups) {
                $devices = Device::findMany($this->requestedData['device_ids']);
                $devices = $groups->devices()->saveMany($devices);
                $devices = DeviceResource::collection($devices);
                return $this->successResponse($devices);
            } else {
                return $this->errorResponse('Group not found');
            }
        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param Request $request {"id": 1}
     * @return JsonResponse
     */
    public function favourite(Request $request): JsonResponse
    {
        try {
            $device = Device::findOrFail($this->requestedData['id']);
            $device->is_favourite = !$device->is_favourite;
            $device->save();
            $device = new DeviceResource($device);
            return $this->successResponse($device);
        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }
}
