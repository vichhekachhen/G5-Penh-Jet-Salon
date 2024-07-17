<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerBookingListResource extends JsonResource
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
            'total_price'=> $this->total_price,
            'date'=> $this->date,
            'time'=> $this->time,
            'store'=> [
                'shop_name'=> $this->store->shop_name,
            ]
        ];
    }
}
