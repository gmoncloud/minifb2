<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Resources\LikeResource;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    /**
     * Get like status
     *
     * @param int $userId
     * @param int $postId
     * @return boolean
     */
    protected function getUserPostLike(int $userId, int $postId): bool {
        return Like::select('like')->where('post_id', $postId)
            ->where('user_id', $userId)
            ->first()->like ?? 0;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): Response
    {
        $isLiked = $this->getUserPostLike($request->user_id, $request->post_id);
        $like = Like::updateOrCreate([
                'post_id' => $request->post_id,
                'user_id' => $request->user_id
            ],
            [
                'post_id' => $request->post_id,
                'user_id' => $request->user_id,
                'like'    => !$isLiked
            ]
        );

        return response([
            'like'    => new LikeResource($like),
            'message' => 'Success',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like): Response
    {
        $like->update($request->all());

        return response([
            'comment' => new LikeResource($like),
            'message' => 'Success',
        ], 200);
    }

    /**
     * Count Post Likes
     *
     * @param  int $postId
     * @return \Illuminate\Http\Response
     */
    public function countLikes(int $postId): Response
    {
        $countLikes = Like::where('post_id', $postId)
            ->where('like', 1)->count();

        return response([
            'likes'   => $countLikes,
            'message' => 'Success',
        ], 200);
    }
}
