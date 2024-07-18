<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'service_name' => $this->service->service_name,
            'booking_id' => $this->booking_id,
            'total' => $this->quantity * $this->service->price,
            'discount' => $this->service->discount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
