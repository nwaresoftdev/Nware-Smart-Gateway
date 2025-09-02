<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentPlanResource extends JsonResource
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
            'id'              => $this->id,
            'name'            => $this->payment_plan_name,  // payment_plan_name → name
            'details'         => $this->description,        // description → details
            'subscriptionType'=> $this->subscription_type,  // subscription_type → subscriptionType
            'createdAt'       => $this->created_at?->toDateTimeString(),
            'updatedAt'       => $this->updated_at?->toDateTimeString(),
        ];
    }
}
