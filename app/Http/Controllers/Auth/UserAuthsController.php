<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\UserAuthsRequest;
use App\Http\Requests\LoginRequest;

class UserAuthsController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  App\Http\Requests\UserAuthsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserAuthsRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->save();

        $token = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'token' => $token]);
    }

    /**
     * Login User.
     *
     * @param  App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $data = $request->all();

        if(!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. Please try again.']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
