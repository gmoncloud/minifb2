<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id' => (string) $this->id,
            'user_id' => (string) $this->user_id,
            'post_id' => (string) $this->post_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
