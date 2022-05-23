<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Resources\LikeResource;
use Ramsey\Uuid\Type\Integer;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likes = Like::all();
        return response(['like' => new
        LikeResource($likes),
            'message' => 'Success'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $like = Like::updateOrCreate(
            [
                'post_id' =>  $request->post_id,
                'user_id' =>  $request->user_id

            ],
            [
                'post_id' =>  $request->post_id,
                'user_id' =>  $request->user_id,
                'like' => $request->like
            ]
        );

        return response(['like' => new
        LikeResource($like),
            'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        return response([ 'post' => new
        PostResource($like), 'message' => 'Success'], 200);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
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
