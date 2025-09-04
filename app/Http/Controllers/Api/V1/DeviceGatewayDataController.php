<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceGatewayDataResource;
use App\Models\DeviceGatewayData;
use App\Services\Api\V1\HybridCryptoEncService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class DeviceGatewayDataController extends Controller
{
    use ResponseTrait;
    protected $requestedData = null;

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->token = $request->bearerToken();
        $encryptedData = $request->toArray();
        $this->requestedData = HybridCryptoEncService::decryption($encryptedData);
    }

}
