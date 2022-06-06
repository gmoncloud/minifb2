<?php

namespace App\Traits;
use Illuminate\Http\UploadedFile;

trait ImageUpload
{

    protected string $uploadPath = 'images';

    /**
     * Image Upload Trait
     *
     * @param \Illuminate\Http\UploadedFile $imageFile
     * @param string                        $folderName
     * @return string
     */
    public function uploadImage(UploadedFile $imageFile, string $folderName): string
    {
        $destinationPath = $this->uploadPath . DIRECTORY_SEPARATOR . $folderName . DIRECTORY_SEPARATOR;
        $filename = date('YmdHis') . "." . $imageFile->getClientOriginalExtension();
        $imageFile->move($destinationPath, $filename);
        return $filename;
    }
}
