<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'profile_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('profile_image')) {
            $destinationPath = 'images/profiles/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['profile_image'] = "$profileImage";
        }

        $profile = Profile::create($input);
        return response(['profile' => new
        ProfileResource($profile),
            'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::where('user_id', $id)->first();
        return response(['profile' => new
        ProfileResource($profile),
            'message' => 'Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profileData = Profile::where('user_id', $id)->first();

        $input = $request->all();

        if ($image = $request->file('profile_image')) {
            $destinationPath = 'images/profiles/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['profile_image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $profile = Profile::where("id", $profileData->id)
            ->update([
                'display_name' => $request->display_name,
                'profile_image' =>  $input['profile_image'],
                'education' => $request->education,
                'current_city' => $request->current_city,
                'hometown' => $request->hometown,
                'work' => $request->work
            ]);

        return response(['profile' => $profile, 'message' => 'Success'], 200);
    }
}
