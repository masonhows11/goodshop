<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Str;

class GenerateToken
{


    //// admin token
    public static function generateAdminToken()
    {
        $activation_token = mt_rand(111111, 999999);

        if (self::adminToken($activation_token)) {

            return mt_rand(111111, 999999);
        }
        return $activation_token;
    }
    public static function adminToken($code)
    {
        return Admin::where('code', $code)->exists();
    }
    //// user token
    public static function generateUserToken()
    {
        $activation_token = mt_rand(111111, 999999);
        if (self::userToken($activation_token)) {

            return mt_rand(111111, 999999);
        }
        return $activation_token;
    }
    public static function userToken($token)
    {
        return User::where('token', $token)->exists();
    }
    //// user token-guid
    public static function generateUserTokenGuid()
    {
        $activation_token = str::random(60);
        if (self::userTokenGuid($activation_token)) {

            return str::random(60);
        }
        return $activation_token;
    }
    public static function userTokenGuid($token)
    {
        return User::where('token_guid', $token)->exists();
    }
}
