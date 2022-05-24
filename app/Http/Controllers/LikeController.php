<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Resources\LikeResource;
use Ramsey\Uuid\Type\Integer;

class LikeController extends Controller
{
    /**
     * Get like status
     *
     * @param  $user_id int, $post_id int
     * @return boolean
     */
    public function getUserPostLike($user_id, $post_id): bool {
        return Like::select('like')->where('post_id', $post_id)
            ->where('user_id', $user_id)
            ->first()->like ?? 0;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $getLike = $this->getUserPostLike($request->user_id, $request->post_id);
        $like = Like::updateOrCreate(
            [
                'post_id' =>  $request->post_id,
                'user_id' =>  $request->user_id

            ],
            [
                'post_id' =>  $request->post_id,
                'user_id' =>  $request->user_id,
                'like' => !$getLike
            ]
        );

        return response(['like' => new
        LikeResource($like),
            'message' => 'Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        $like->update($request->all());
        return response(['comment' => new
        LikeResource($like), 'message' => 'Success'], 200);
    }

    /**
     * Count Post Likes
     *
     * @param  Integer $post_id
     * @return \Illuminate\Http\Response
     */
    public function countLikes($post_id) {
        $countLikes = Like::where('post_id', $post_id)
            ->where('like', 1)->count();

        return response(['likes' => $countLikes, 'message' => 'Success'], 200);
    }
}
