<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CenterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'points_factor' => $this->points_factor,
            'location' => $this->location,
            'photo' => $this->photo,
            'books' => BookResource::collection($this->books),

        ];
    }
}
