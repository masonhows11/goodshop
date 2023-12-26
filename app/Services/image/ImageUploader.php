<?php


namespace App\Services\image;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    public static function upload($image, $path, $disk)
    {
        if(!is_null($image)){
            Storage::disk($disk)->put($path, File::get($image));
        }

    }

    public static function uploadMany(array $images, $path, $disk = 'public_storage')
    {
        $images_path = [];
        foreach ($images as $key => $image) {
            $fullPath = $path . $key . '_' . $image->getClientOriginalName();
            Storage::disk($disk)->put($fullPath, File::get($image));
            $images_path += [ $key => $fullPath];
        }
        return $images_path;
    }
}
