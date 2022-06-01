<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\ImageUpload;

class PostController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('comments', 'likes', 'user')
            ->withCount([
            'comments',
            'likes' => function (Builder $query) {
                $query->where('like', 1);
            }
        ])->orderBy('posts.created_at', 'desc')
            ->orderBy('posts.id', 'asc')
            ->paginate(10);

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
            $filePath = $this->uploadImage($image, 'posts');
            $input['post_image'] = $filePath;
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
        $input['post_image'] = $post->post_image;

        if ($image = $request->file('post_image')) {
            $filePath = $this->uploadImage($image, 'posts');
            $input['post_image'] = $filePath;
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
        return response(['message' => 'Post deleted'], 200);
    }

    public function viewUserPost($user_id)
    {
        $posts = Post::with('comments.user', 'likes', 'user')
            ->withCount([
                'comments',
                'likes' => function (Builder $query) {
                    $query->where('like', 1);
                }
            ])
            ->where('user_id', $user_id)
            ->orderBy('posts.created_at', 'desc')
            ->paginate(5);

        return response([ 'posts' => $posts,
            'message' => 'Success'], 200);

    }
}
