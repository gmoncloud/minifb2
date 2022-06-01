<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $user_id
 * @property mixed $written_text
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => (string) $this->id,
            'user_id'      => (string) $this->user_id,
            'post_image'   => !empty($this->post_image) ? url('/images/posts') . DIRECTORY_SEPARATOR . $this->post_image : null,
            'written_text' => $this->written_text,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at
        ];
    }
}
