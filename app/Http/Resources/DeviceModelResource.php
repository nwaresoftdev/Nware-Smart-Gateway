<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceModelResource extends JsonResource
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
            'id'          => $this->id ?? '',
            'typeId'      => $this->device_type_id ?? '',
            'modelName'   => $this->device_model_name ?? '',
            'details'     => $this->description ?? '',
            'createdAt'   => $this->created_at?->toDateTimeString() ?? '',
            'updatedAt'   => $this->updated_at?->toDateTimeString() ?? '',
        ];
    }
}
