<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileComplete
{

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // below condition user logged in with email & mobile must verify
        if ( !empty($user->email) && !empty($user->email_verified_at) && empty($user->mobile)) {
            session()->flash('error',__('messages.complete_your_user_information_before_proceeding_with_payment'));
            return  redirect()->route('user.profile');
        }

        // below condition user logged in with mobile & email must verify
        if ( !empty($user->mobile) && !empty($user->mobile_verified_at) && empty($user->email)) {
            session()->flash('error',__('messages.complete_your_user_information_before_proceeding_with_payment'));
            return  redirect()->route('user.profile');
        }

        if (empty($user->first_name) || empty($user->last_name) || empty($user->national_code)) {

            session()->flash('error',__('messages.complete_your_user_information_before_proceeding_with_payment'));
            return  redirect()->route('user.profile');
        }


        return $next($request);
    }
}
