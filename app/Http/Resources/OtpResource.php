<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OtpResource extends JsonResource
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
            'userId'     => $this->user_id,       // user_id → userId
            'code'       => $this->otp,           // otp → code
            'type'       => $this->type,
            'verifiedAt' => $this->verified_at?->toDateTimeString(),
            'createdAt'  => $this->created_at?->toDateTimeString(),
            'updatedAt'  => $this->updated_at?->toDateTimeString(),
        ];
    }
}
