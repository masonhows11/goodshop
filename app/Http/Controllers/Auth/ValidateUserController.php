<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ValidateMobileRequest;
use App\Models\User;
use App\Notifications\UserAuthNotification;
use App\Services\ValidateUserAdminService\ValidateUserService;
use App\Services\GenerateToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ValidateUserController extends Controller
{
    //

    public function validateForm()
    {
        return view('front.auth_user.validate_user');
    }

    public function validate_user(ValidateMobileRequest $request)
    {
        if ($request->has('email')) {

            $isValidated = ValidateUserService::validateEmail($request->email, $request->token);


            if ($isValidated == 1) {
                session()->flash('error', 'کد فعالسازی معتبر نمی باشد.');
                return redirect()->route('auth.validate.user.form');
            }
            if ($isValidated == 2) {
                $user = User::where(['email' => $request->email, 'token' => $request->token])->first();
                $user->activate = 1;
                $user->save();

                if ($request->has('remember')) {
                    Auth::login($user, $remember = true);
                    session()->forget(['auth_email', 'token_guid', 'token_time']);
                    return redirect()->route('home');
                }

                Auth::login($user);
                session()->forget(['auth_email', 'token_guid', 'token_time']);
                return redirect()->route('home');
            }


        } elseif ($request->has('mobile')) {

            return __('messages.dear_user_this_part_is_being_prepared_thank_you');

            //            $isValidated = ValidateUserService::validateMobile($request->mobile, $request->token);
            //
            //            if ($isValidated == 1) {
            //                session()->flash('error', 'کد فعالسازی معتبر نمی باشد.');
            //                return redirect()->route('auth.validate.user.form');
            //            }
            //
            //            if ($isValidated == 2) {
            //                $user = User::where(['mobile' => $request->mobile, 'token' => $request->token])->first();
            //                $user->activate = 1;
            //                $user->save();
            //
            //                if ($request->has('remember')) {
            //                    Auth::login($user, $remember = true);
            //                    session()->forget(['auth_mobile', 'token_guid', 'token_time']);
            //                    return redirect()->route('home');
            //                }
            //                Auth::login($user);
            //                session()->forget(['auth_mobile', 'token_guid', 'token_time']);
            //                return redirect()->route('home');
            //            }
        }

        return redirect()->route('auth.login.form');

    }

    public function resendToken(Request $request)
    {

        try {

            $user = User::where('token_guid', $request->token_guid)->first();
            $isPassed = Carbon::parse($user->updated_at)->addMinutes(1)->isPast();

            if ($isPassed == 1) {
                // send otp code / token with email
                if ($user->auth_type == 1) {

                    $token_guid = GenerateToken::generateUserTokenGuid();
                    $token = GenerateToken::generateUserToken();
                    $user->token = $token;
                    $user->token_guid = $token_guid;
                    $user->save();


                    Notification::send($user, new UserAuthNotification($user));

                    session(['auth_email' => $user->email ,
                        'token_guid' => $user->token_guid,
                        'token_time'=>$user->updated_at]);

                    session()->flash('success', __('messages.the_verification_code_has_been_sent_again'));

                    return redirect()->route('auth.validate.user.form');

                    // send otp code / token with sms
                } elseif ($user->auth_type == 2) {

                    return __('messages.dear_user_this_part_is_being_prepared_thank_you');
                //
                //                    $token_guid = GenerateToken::generateUserTokenGuid();
                //                    $token = GenerateToken::generateUserToken();
                //                    $user->token = $token;
                //                    $user->token_guid = $token_guid;
                //                    $user->save();
                //                    // send token with sms
                //
                //                    session(['auth_email' => $user->email ,
                //                        'token_guid' => $user->token_guid,
                //                        'token_time'=>$user->updated_at]);
                //
                //                    session()->flash('success', __('messages.the_verification_code_has_been_sent_again'));
                //                    return redirect()->route('auth.validate.user.form');
                }
            }
            session()->flash('error' , __('messages.the_mobile_number_or_email_entered_is_invalid'));
            return redirect()->route('auth.login.form');

        } catch (\Exception $ex) {
            return  view('errors_custom.general_error')
                ->with(['exception' => $ex->getMessage()]);
        }

    }
}
