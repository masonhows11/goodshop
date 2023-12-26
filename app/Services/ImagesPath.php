<?php

namespace App\Services;

class ImagesPath
{

    public static function imageName($request){

        $img_array = [];

        array_push($img_array, $request->input('image_1'),
            $request->input('image_2'),
            $request->input('image_3'),
            $request->input('image_4'),
            $request->input('image_5')
        );


        $img_name = [];
        $array_count = count($img_array);
        for ($i = 0; $i < $array_count; $i++) {
            array_push($img_name, str_replace('http://store.test/storage/images/', '', $img_array[$i]));
        }
        return $img_name;
    }
}
