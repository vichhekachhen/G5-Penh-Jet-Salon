<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreByProvinceResource extends JsonResource
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
            'shop_profile'=> $this->shop_profile ? : null,
            'created_at' => $this->created_at->format('d-m-Y'),
            'address' => [
                'address_id' => $this->address->id,
                'city' => $this->address->city,
            ],
        ];
    }
}
