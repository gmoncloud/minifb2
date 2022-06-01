<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $user_id
 * @property mixed $post_id
 * @property mixed $comment_text
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $id
 */
class CommentResource extends JsonResource
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
            'user_id'      => $this->user_id,
            'post_id'      => $this->post_id,
            'comment_text' => $this->comment_text,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at
        ];
    }
}
