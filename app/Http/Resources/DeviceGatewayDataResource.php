<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceGatewayDataResource extends JsonResource
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
            'id'             => $this->id ?? '',
            'deviceCode'     => $this->device_id ?? '',
            'startDate'      => $this->start_unit_date ?? '',
            'startUnit'      => $this->device_start_unit ?? '',
            'tariff'         => $this->tariff_per_unit ?? '',
            'newSetup'       => (bool) $this->is_new_setup ?? '',
            'consumed'       => $this->consumed_unit ?? '',
            'remaining'      => $this->remaining_unit ?? '',
            'createdAt'      => $this->created_at?->toDateTimeString() ?? '',
        ];
    }
}
