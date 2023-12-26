<?php


namespace App\Services;


class ConvertPerToEn
{

    public static function convert($mobile)
    {
        $n_pattern = "/^(\+98|0098|98|0)/i";
        $find_plus = strpos($mobile, '+');
        if ($find_plus == true) {
            $persian = ["+", "۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
            $english = ["+", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
            $number = str_ireplace($persian, $english, $mobile);
            return $n_number = preg_replace($n_pattern, "0", $number);

        }
        if ($find_plus == false)
            $persian = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
        $english = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        $number = str_ireplace($persian, $english, $mobile);
        return $n_number = preg_replace($n_pattern, "0", $number);


    }

}
