<?php


use Illuminate\Support\Facades\Route;
use Morilog\Jalali\Jalalian;


function jalaliDate($date, $format = '%A , %d %B %y')
{

    return Jalalian::forge($date)->format($format);
}

function customJalaliDate($date, $format = '%d - %B - %Y')
{
  return  Jalalian::forge($date)->format($format);
}

function customJalaliDateTime($date,$time = 'H:i:s'){

    return  Jalalian::forge($date)->format($time);
}

if (!function_exists('responseOk')) {
    function responseOk($data, $status = 200)
    {
        return response()->json(['is_successful' => true, 'data' => $data], $status);
    }
}
if (!function_exists('responseError')) {
    function responseError($data, $status = 200)
    {
        return response()->json(['is_successful' => false, 'data' => $data], $status);
    }
}


function convertPerToEnglish($number)
{

    $persian = ["+", "۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
    $english = ["+", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
    return str_ireplace($persian, $english, $number);
}

function convertEngToPersian($number)
{

    $english = ["+", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
    $persian = ["+", "۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
    return str_ireplace($english, $persian, $number);
}


function priceFormat($price)
{

    $price = number_format($price, 0, '/', ',');
    $price = convertEngToPersian($price);
    return $price;

}

function validateNationalCode($nationalCode)
{
    $nationalCode = trim($nationalCode, ' .');
    $nationalCode = convertPerToEnglish($nationalCode);
    $bannedArray = ['0000000000', '1111111111', '2222222222', '3333333333', '4444444444', '5555555555', '6666666666', '7777777777', '8888888888', '9999999999'];
    if (empty($nationalCode)) {
        return false;
    } else if (count(str_split($nationalCode)) != 10) {
        return false;
    } else if (in_array($nationalCode, $bannedArray)) {
        return false;
    } else {

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {

            $sum += (int)$nationalCode[$i] * (10 - $i);
        }
        $divideRemaining = $sum % 11;
        if ($divideRemaining < 2) {
            $lastDigit = $divideRemaining;
        } else {
            $lastDigit = 11 - ($divideRemaining);
        }
        if ((int)$nationalCode[9] == $lastDigit) {
            return true;
        } else {
            return false;
        }

    }

}
