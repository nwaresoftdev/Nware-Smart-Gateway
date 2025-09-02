<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserHasOrganizationResource extends JsonResource
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
            'id'             => $this->id,
            'userId'         => $this->user_id,          // user_id → userId
            'organizationId' => $this->organization_id,  // organization_id → organizationId
            'createdAt'      => $this->created_at?->toDateTimeString(),
            'updatedAt'      => $this->updated_at?->toDateTimeString(),
        ];
    }
}
