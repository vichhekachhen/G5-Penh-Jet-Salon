<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingServiceListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "service"=> [
                "service_name"=> $this->service->service_name,
                "price"=> $this->service->price,
                "image"=> $this->service->image ?: null,
                "category"=> $this->service->category->name,
            ],
        ];
    }
}
