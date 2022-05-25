<?php

namespace App\Traits;

trait ImageUpload
{
    /**
     * @var string
     */
    protected $uploadPath = 'images';

    /**
     * @var string
     */
    protected $folderName;

    public function uploadImage($imageFile, $folderName): String
    {
        $destinationPath = $this->uploadPath . DIRECTORY_SEPARATOR . $folderName . DIRECTORY_SEPARATOR;
        $filename = date('YmdHis') . "." . $imageFile->getClientOriginalExtension();
        $imageFile->move($destinationPath, $filename);
        return $filename;
    }
}
