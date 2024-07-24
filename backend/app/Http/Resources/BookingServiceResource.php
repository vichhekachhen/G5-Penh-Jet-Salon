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
            'service_id' => $this->service_id,
            'service_image' => $this->service->image,
            'booking_id' => $this->booking_id,
            'price' => $this->service->price,
            'discount' => $this->service->discount,
            'duration' => $this->service->duration,
        ];
    }
}
