<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return response([ 'posts' =>
            PostResource::collection($posts),
            'message' => 'Success'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        return response([ 'post' => new
        PostResource($post),
            'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Author $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response([ 'post' => new
        PostResource($post), 'message' => 'Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Author $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());
        return response([ 'post' => new
        PostResource($post), 'message' => 'Success'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response(['message' => 'Post deleted']);
    }
}
