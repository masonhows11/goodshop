<?php


namespace App\Services\OrderNumber;


use App\Models\Order;

class OrderNumberServices
{
    public static function  generateNumber()
    {
        define("PREFIX" ,"GDSH");
        $number = PREFIX  . mt_rand(111111, 999999);

        if (self::existNumber($number)) {

            return  $number = $number = PREFIX  . mt_rand(111111, 999999);
        }
        return $number;

    }

    public static function existNumber($number)
    {
        return Order::where('order_number', $number)->exists();
    }
}
