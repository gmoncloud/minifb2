<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Traits\ImageUpload;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    use ImageUpload;

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request): Response
    {
        $input = $request->all();

        if ($image = $request->file('profile_image')) {
            $filePath = $this->uploadImage($image, 'profiles');
            $input['profile_image'] = $filePath;
        }

        $profile = Profile::create($input);

        return response([
            'profile' => $profile,
            'message' => 'Success',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): Response
    {
        $profile = Profile::where('user_id', $id)->first();

        return response([
            'profile' => $profile,
            'message' => 'Success',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ProfileRequest $request
     * @param int                               $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, int $id): Response
    {
        $profileData = Profile::where('user_id', $id)->first();

        $input = $request->all();

        if ($image = $request->file('profile_image')) {
            $filePath = $this->uploadImage($image, 'profiles');
            $input['profile_image'] = $filePath;
        }else{
            unset($input['profile_image']);
        }

        $profile = Profile::find($profileData->id)
            ->update([
                'display_name'  => $request->display_name,
                'profile_image' => !empty($input['profile_image']) ? $input['profile_image'] : $profileData->profile_image,
                'education'     => $request->education,
                'current_city'  => $request->current_city,
                'hometown'      => $request->hometown,
                'work'          => $request->work
            ]);

        return response([
            'profile' => $profile,
            'message' => 'Success',
        ], 200);
    }
}
