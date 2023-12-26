<?php


namespace App\Services;


class ImagePath
{

    public static function imageName($request)
    {
        return  $image = str_ireplace('http://store.test/storage/images/','',$request);

    }
}
