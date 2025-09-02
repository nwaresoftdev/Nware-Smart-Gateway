<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
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
            'id'                => $this->id ?? '',
            'type'              => $this->device_type_id ?? '',
            'model'             => $this->device_model_id ?? '',
            'group'             => $this->device_group_id ?? '',
            'organization'      => $this->orgnization_id ?? '',
            'owner'             => $this->user_id ?? '',
            'name'              => $this->device_name ?? '',
            'status'            => $this->device_on_off ?? '',
            'location'          => $this->location_id ?? '',
            'imeiNumber'       => $this->imei ?? '',
            'serial'            => $this->serial_number ?? '',
            'wifiSsid'         => $this->ssid ?? '',
            'productSku'       => $this->sku ?? '',
            'active'            => $this->is_active ?? '',
            'firmware'          => $this->firmware_version ?? '',
            'protocol'          => $this->connectivity_protocol ?? '',
            'appVersion'       => $this->version ?? '',
            'favourite'         => $this->is_favourite ?? '',
            'deviceCode'       => $this->device_id ?? '',
            'createdAt'        => $this->created_at?->toDateTimeString() ?? '',
            'updatedAt'        => $this->updated_at?->toDateTimeString() ?? '',
        ];
    }
}
