<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $comments = Comment::all();

        return response([
            'comments' => CommentResource::collection($comments),
            'message'  => 'Success',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request): Response
    {
        $comment = Comment::create($request->all());

        return response([
            'comment' => new CommentResource($comment),
            'message' => 'Success',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment): Response
    {
        return response([
            'post'    => new CommentResource($comment),
            'message' => 'Success',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment): Response
    {
        $comment->update($request->all());

        return response([
            'comment' => new CommentResource($comment),
            'message' => 'Success',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment): Response
    {
        $comment->delete();

        return response([
            'message' => 'Comment deleted',
        ], 200);
    }
}
