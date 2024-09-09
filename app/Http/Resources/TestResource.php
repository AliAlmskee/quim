<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'hadith_id' => $this->hadith_id,
            'audio_id' => $this->audio_id,
            'quarter_id' => $this->quarter_id,
            'mark' => $this->mark,
            'points_added' => $this->points_added,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
