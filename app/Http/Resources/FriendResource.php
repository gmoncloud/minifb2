<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
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
            'id' => $this->id,
            'friend_id' => $this->friend_id,
            'name' => $this->name,
            'profile_image' => $this->profile_image,
            'education' => $this->education,
            'current_city' => $this->current_city,
            'work' => $this->work
        ];
    }
}
