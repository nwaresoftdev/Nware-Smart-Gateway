<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
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
            'id'           => $this->id,
            'name'         => $this->name,
            'gstNumber'    => $this->gst_number,     // gst_number → gstNumber
            'panNumber'    => $this->pan_number,     // pan_number → panNumber
            'aadharNumber' => $this->aadhar_number,  // aadhar_number → aadharNumber

            'contact' => [
                'name'   => $this->contact_name,    // contact_name → contact.name
                'number' => $this->contact_number,  // contact_number → contact.number
                'email'  => $this->contact_email,   // contact_email → contact.email
            ],

            'address' => [
                'line1'      => $this->address1,   // address1 → address.line1
                'line2'      => $this->address2,   // address2 → address.line2
                'city'       => $this->city,
                'state'      => $this->state,
                'country'    => $this->country,
                'postalCode' => $this->pincode,    // pincode → postalCode
            ],

            'createdAt'    => $this->created_at?->toDateTimeString(),
            'updatedAt'    => $this->updated_at?->toDateTimeString(),
        ];
    }
}
