<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Profile;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('comments', 'likes')
            ->get();

        return response([ 'posts' => $posts,
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
        $input = $request->all();
        $input['post_image'] = null;

        if ($image = $request->file('post_image')) {
            $destinationPath = 'images/posts/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['post_image'] = "$postImage";
        }

        $post = Post::create($input);
        return response(['post' => new
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
        $input = $request->all();
        $input['profile_image'] = $post->post_image;

        if ($image = $request->file('post_image')) {
            $destinationPath = 'images/posts/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['post_image'] = "$postImage";
        }else{
            unset($input['post_image']);
        }

        $post->update($input);
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
