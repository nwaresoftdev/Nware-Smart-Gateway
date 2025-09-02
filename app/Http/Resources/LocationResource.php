<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'line1'      => $this->address1,   // address1 → line1
            'line2'      => $this->address2,   // address2 → line2
            'city'       => $this->city,
            'state'      => $this->state,
            'country'    => $this->country,
            'postalCode' => $this->pincode,    // pincode → postalCode
            'createdAt'  => $this->created_at?->toDateTimeString(),
            'updatedAt'  => $this->updated_at?->toDateTimeString(),
        ];
    }
}
