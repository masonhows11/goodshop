<?php


namespace App\Services\ValidateUserAdminService;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class ValidateUserService
{
    public static function validateEmail($email, $token)
    {
        $status = null;
        try {
            $user = User::where(['email' => $email, 'token' => $token])->first();
            if ($user) {
                $expired = Carbon::parse($user->updated_at)->addMinutes(2)->isPast();
                if ($expired == 1) {
                    return $status = 1;
                }
                $user->email_verified_at = Date::now();
                $user->save();
                return $status = 2;
            }
            return $status = 3;
        } catch (\Exception $ex) {
            return view('errors_custom.validation_error', ['error' => $ex->getMessage()]);
        }
    }

    public static function validateMobile($mobile, $token)
    {
        $status = null;
        try {
            $user = User::where(['mobile' => $mobile, 'token' => $token])->first();
            if ($user) {
                $expired = Carbon::parse($user->updated_at)->addMinutes(2)->isPast();
                if ($expired == 1) {
                    return $status = 1;
                }
                $user->mobile_verified_at = now();
                $user->save();
                return $status = 2;
            }
            return $status = 3;
        } catch (\Exception $ex) {
            return view('errors_custom.validation_error')->with(['error' => $ex->getMessage()]);
        }
    }
}
