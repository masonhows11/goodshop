<?php


namespace App\Services;


use App\Models\Product;

class ProductCode
{


    public static function  generateToken()
    {
        $code = uniqid('GDSH');

        if (self::existToken($code)) {

            return  $code = uniqid('GDSH');
        }
        return $code;

    }

    public static function existToken($code)
    {
        return Product::where('code', $code)->exists();
    }

}
