<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NodeResource;
use App\Http\Resources\NodeSmartSwitchDataResource;
use App\Models\Node;
use App\Services\Api\V1\HybridCryptoEncService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NodeController extends Controller
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

    public function getNodeDetails(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = \App\Models\User::findOrFail($this->authUser->id);
            $nodes = NodeResource::collection($user->nodes);
            return $this->successResponse($nodes);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param Request $request { "id": 1, "node_on_off": on | off | true | false | 1 | 0 }
     * @return JsonResponse
     */
    public function nodeOnOff(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = \App\Models\User::findOrFail($this->authUser->id);
            $node = $user->nodes->find($this->requestedData['id']);
            if ($node) {
                if ($this->requestedData['node_on_off'] == 'on' || $this->requestedData['node_on_off'] == '1' || $this->requestedData['node_on_off'] === true) {
                    $node->node_on_off = true;
                } else {
                    $node->node_on_off = false;
                }
                $node->save();
                $node = new NodeResource($node);
                return $this->successResponse($node);
            } else {
                return $this->errorResponse('Node not found');
            }
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param Request $request {"id": 1, "node_line_on_off": [1,1,1,1,1] }
     * @return JsonResponse
     */
    public function nodeSmartSwitchOnOff(Request $request): \Illuminate\Http\JsonResponse
    {
//        dd($this->requestedData, $request);
        try {
            $user = \App\Models\User::findOrFail($this->authUser->id);
            $nodeSmartSwitchDatas = $user->nodes->flatMap->nodeSmartSwitchDatas->firstWhere('id', $this->requestedData['id']);
            $nodeSmartSwitchDatas->node_line_on_off = Arr::join($this->requestedData['node_line_on_off'], ',');
            $nodeSmartSwitchDatas->save();
            $nodeSmartSwitchDatas = new NodeSmartSwitchDataResource( $nodeSmartSwitchDatas );
            return $this->successResponse( $nodeSmartSwitchDatas );
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
