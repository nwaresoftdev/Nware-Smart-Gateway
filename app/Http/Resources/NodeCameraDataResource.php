<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NodeCameraDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id'         => $this->id,
            'nodeId'     => $this->node_id,          // node_id → nodeId
            'status'     => $this->node_on_off,      // node_on_off → status
            'timestamp'  => $this->data_timestamp,   // data_timestamp → timestamp
            'createdAt'  => $this->created_at?->toDateTimeString(),
            'updatedAt'  => $this->updated_at?->toDateTimeString(),
        ];
    }
}
