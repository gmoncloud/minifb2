<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\FriendResource;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Friend::select(
            'friends.id',
            'friends.friend_id',
            'users.name',
            'profiles.education',
            'profiles.profile_url',
            'profiles.current_city',
            'profiles.hometown',
            'profiles.work')
            ->join('users', 'users.id', '=', 'friends.friend_id')
            ->join('profiles', 'profiles.user_id', '=', 'friends.friend_id')
        ->orderBy('friends.friend_id')
        ->get();

        return response([ 'friends' =>
            FriendResource::collection($friends),
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
        $friend = Friend::create($request->all());
        return response([ 'friend' => new
        FriendResource($friend),
            'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $friends = Friend::select(
            'friends.id',
            'friends.friend_id',
            'users.name',
            'profiles.education',
            'profiles.profile_url',
            'profiles.current_city',
            'profiles.hometown',
            'profiles.work')
            ->join('users', 'users.id', '=', 'friends.friend_id')
            ->join('profiles', 'profiles.user_id', '=', 'friends.friend_id')
            ->where('friends.user_id', $user_id)
            ->orderBy('friends.user_id')
            ->get();

        return response([ 'friends' =>
            FriendResource::collection($friends),
            'message' => 'Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        $friend->delete();
        return response(['message' => 'Friend deleted']);
    }

    public function findFriends($user_id) {
        $friends = Friend::select(
            'users.id')
            ->join('users', 'users.id', '=', 'friends.friend_id')
            ->where('friends.user_id', $user_id)
            ->orderBy('friends.user_id')
            ->get();

        foreach($friends as $friend){
            $friendIds[] = $friend->id;
        }

        $friendIds = !empty($friendIds) ? $friendIds : [];

        $users = User::select(
            'users.id',
            'users.name'
        )
            ->whereNotIn('id', $friendIds)
            ->where('users.id', '!=', $user_id)
            ->orderBy('users.name')
            ->get();

        return response([ 'users' => $users,
            'message' => 'Success'], 200);
    }
}
