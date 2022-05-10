<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'profile_url' => $this->profile_url,
            'education' => $this->education,
            'current_city' => $this->current_city,
            'hometown' => $this->hometown,
            'work' => $this->work,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
