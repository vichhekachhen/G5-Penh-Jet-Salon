<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'service_name' => $this->service_name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'discount' => $this->discount,
            'category_id' => $this->category_id,
            'image' => $this->image,
           'created_at' => $this->created_at->format('d-m-Y'),
        ];
    }
}
