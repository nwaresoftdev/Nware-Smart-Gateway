<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NodeResource extends JsonResource
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
            'id'            => $this->id,
            'ownerId'       => $this->user_id,                // user_id → ownerId
            'typeId'        => $this->node_type_id,           // node_type_id → typeId
            'modelId'       => $this->node_model_id,          // node_model_id → modelId
            'gatewayId'     => $this->device_gateway_data_id, // device_gateway_data_id → gatewayId
            'locationId'    => $this->location_id,
            'name'          => $this->node_name,              // node_name → name
            'status'        => $this->node_on_off,            // node_on_off → status
            'imei'          => $this->imei,
            'serial'        => $this->serial_number,          // serial_number → serial
            'wifiSsid'      => $this->ssid,                   // ssid → wifiSsid
            'sku'           => $this->sku,
            'active'        => (bool) $this->is_active,       // is_active → active
            'firmware'      => $this->firmware_version,
            'protocol'      => $this->connectivity_protocol,
            'version'       => $this->version,
            'favourite'     => (bool) $this->is_favourite,
            'createdAt'     => $this->created_at?->toDateTimeString(),
            'updatedAt'     => $this->updated_at?->toDateTimeString(),
        ];
    }
}
