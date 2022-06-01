<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $user_id
 * @property mixed $display_name
 * @property mixed $education
 * @property mixed $current_city
 * @property mixed $hometown
 * @property mixed $work
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class ProfileResource extends JsonResource
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
            'user_id'       => (string)$this->user_id,
            'display_name'  => $this->display_name,
            'profile_image' => !empty($this->profile_image) ? url('/images/profiles') . DIRECTORY_SEPARATOR . $this->profile_image : null,
            'education'     => $this->education,
            'current_city'  => $this->current_city,
            'hometown'      => $this->hometown,
            'work'          => $this->work,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
