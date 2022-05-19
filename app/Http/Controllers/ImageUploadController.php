<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        $profile = Profile::create($request->all());
        dd($profile);
        return response(['profile' => new
        ProfileResource($profile),
            'message' => 'Success'], 200);
    }

}
