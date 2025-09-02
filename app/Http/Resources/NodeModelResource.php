<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NodeModelResource extends JsonResource
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
            'id'          => $this->id,
            'typeId'      => $this->node_type_id,   // node_type_id → typeId
            'name'        => $this->name,
            'details'     => $this->description,    // description → details
            'createdAt'   => $this->created_at?->toDateTimeString(),
            'updatedAt'   => $this->updated_at?->toDateTimeString(),
        ];
    }
}
