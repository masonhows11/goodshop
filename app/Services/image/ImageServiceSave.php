<?php


namespace App\Services\image;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ImageServiceSave
{


    public function savePublicPath($file, $width, $height)
    {

        $imageFile = $file;

        $fileNameWithExt = $imageFile->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $imageFile->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

        if (!file_exists('images')) {
            mkdir(public_path('/images'), 666, false);
        }

        $publicPath = public_path('images/' . $fileNameToStore);
        $savePublicPath = '/public/images/' . $fileNameToStore;

        $image = Image::make($imageFile->getRealPath());
        $image->fit($width, $height);
        $image->save($publicPath, 90, null);

        return $savePublicPath;
    }

    public function customSavePublicPath($file, $path)
    {
        $imageFile = $file;

        $fileNameWithExt = $imageFile->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $imageFile->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;


        // for main directory image in public path
        if (!file_exists('images')) {
            mkdir(public_path('/images'), 666, true);
        }

        // for custom directory
        if (!file_exists('images/' . $path)) {
            mkdir(public_path('/images/' . $path), 666, true);
        }

        $publicPath = public_path('images/' . $path . '/' . $fileNameToStore);
        $savePublicPath = '/images/' . $path . '/' . $fileNameToStore;

        $image = Image::make($imageFile->getRealPath());
        $image->save($publicPath, 90, null);

        return $savePublicPath;
    }

    public function saveStoragePath($file, $width, $height)
    {
        $imageFile = $file;
        $fileNameWithExt = $imageFile->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $imageFile->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

        $storagePath = Storage::path('/public/images/' . $fileNameToStore);
        $saveStorePath = '/images/' . $fileNameToStore;

        $image = Image::make($imageFile->getRealPath());
        $image->resize($width, $height);
        $image->save($storagePath, 90, null);
        return $saveStorePath;
    }


    public function customSaveStoragePath($file, $path, $name, $width, $height)
    {

        $imageFile = $file;

        // $fileNameWithExt = $imageFile->getClientOriginalName();
        // $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        $extension = $imageFile->getClientOriginalExtension();
        $fileNameToStore = $name . '_' . time() . '.' . $extension;

        $customPath = trim($path, '/\\');
        $storageDirectories = Storage::directories('public/' . $customPath);
        if (!in_array($customPath, $storageDirectories)) {

            Storage::makeDirectory('public/' . $customPath);

        }
        $storagePath = Storage::path('/public/' . $customPath . '/' . $fileNameToStore);
        $saveStorePath = '/' . $customPath . '/' . $fileNameToStore;

        $image = Image::make($imageFile->getRealPath());
        $image->resize($width, $height);
        $image->save($storagePath, 90, null);

        return $saveStorePath;

    }


    public function deleteOldStorageImage($file, $path = null)
    {

        if (Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }

    }

    public static function deleteOldPublicImage($file, $path = null)
    {
        if (file_exists(public_path() . $file)) {
            unlink(public_path() . $file);
        }
    }

}
