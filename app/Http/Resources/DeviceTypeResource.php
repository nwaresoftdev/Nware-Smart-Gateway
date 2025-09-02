<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceTypeResource extends JsonResource
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
            'id'        => $this->id ?? '',
            'name'      => $this->device_name ?? '',
            'details'   => $this->description ?? '',
            'createdAt' => $this->created_at?->toDateTimeString() ?? '',
            'updatedAt' => $this->updated_at?->toDateTimeString() ?? '',
        ];
    }

}
