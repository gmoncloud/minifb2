<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\FriendResource;
use Illuminate\Http\Response;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $friends = Friend::select(
            'friends.id',
            'friends.friend_id',
            'users.name',
            'profiles.education',
            'profiles.display_name',
            'profiles.profile_image',
            'profiles.current_city',
            'profiles.hometown',
            'profiles.work')
            ->join('users', 'users.id', '=', 'friends.friend_id')
            ->join('profiles', 'profiles.user_id', '=', 'friends.friend_id')
        ->orderBy('friends.friend_id')
        ->paginate(10);

        return response([
            'friends' => $friends,
            'message' => 'Success',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): Response
    {
        $friend = Friend::create($request->all());

        return response([
            'friend'  => new FriendResource($friend),
            'message' => 'Success',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $userId
     * @return \Illuminate\Http\Response
     */
    public function show(int $userId): Response
    {
        $friends = Friend::select(
            'friends.id',
            'friends.friend_id',
            'users.name',
            'profiles.education',
            'profiles.display_name',
            'profiles.profile_image',
            'profiles.current_city',
            'profiles.hometown',
            'profiles.work')
            ->join('users', 'users.id', '=', 'friends.friend_id')
            ->join('profiles', 'profiles.user_id', '=', 'friends.friend_id')
            ->where('friends.user_id', $userId)
            ->orderBy('friends.user_id')
            ->paginate(10);

        return response([
            'friends' => $friends,
            'message' => 'Success',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend): Response
    {
        $friend->delete();

        return response([
            'message' => 'Friend deleted',
        ], 200);
    }

    /**
     * Get friends ids
     *
     * @param  int $userId
     * @return array
     */
    protected function getFriendIds(int $userId): array
    {
        return Friend
            ::select('users.id')
            ->join('users', 'users.id', '=', 'friends.friend_id')
            ->where('friends.user_id', $userId)
            ->orderBy('friends.user_id')
            ->get()
            ->map(function ($user) {
                return $user->id;
            })->toArray();
    }

    /**
     * Display user list excluding self
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function findFriends(int $userId): Response
    {
        $users = User::select(
                'users.id',
                'users.name',
                'profiles.profile_image'
            )
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->whereNotIn('users.id', $this->getFriendIds($userId))
            ->where('users.id', '!=', $userId)
            ->orderBy('users.name')
            ->paginate(10);

        return response([
            'users'   => $users,
            'message' => 'Success',
        ], 200);
    }
}
