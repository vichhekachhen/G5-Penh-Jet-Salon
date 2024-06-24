<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'shop_name'=> $this->shop_name,
            'created_at' => $this->created_at->format('d-m-Y'),
            'address'=>new AddressResource($this->address),
            // 'address'=> $this->address,
        ];
    }
}
