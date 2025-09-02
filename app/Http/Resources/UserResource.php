<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'           => $this->name,
            'email'          => $this->email,
            'mobile'         => $this->mobile,
            'userTypeId'     => $this->user_type_id,        // user_type_id → userTypeId
            'emailVerifiedAt'=> $this->email_verified_at?->toDateTimeString(),
            'otpVerifiedAt'  => $this->otp_verified_at?->toDateTimeString(),
            'lastLoginAt'    => $this->last_login_at?->toDateTimeString(),
            'fcmToken'       => $this->fcm_token,           // fcm_token → fcmToken
            'active'         => (bool) $this->is_active,    // is_active → active

            // ⚠️ Exclude password for security reasons
            'createdAt'      => $this->created_at?->toDateTimeString(),
            'updatedAt'      => $this->updated_at?->toDateTimeString(),
        ];
    }
}
