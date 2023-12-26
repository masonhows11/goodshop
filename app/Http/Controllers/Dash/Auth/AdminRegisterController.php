<?php

namespace App\Http\Controllers\Dash\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\AdminAuthNotification;
use App\Rules\MobileRule;
use App\Services\GenerateToken;
use Illuminate\Http\Request;

class AdminRegisterController extends Controller
{
    //
    public function registerForm()
    {
        return view('auth_admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'unique:admins', new MobileRule()],
            'name' => ['required', 'unique:admins', 'min:1', 'max:50'],
            'first_name' => ['required', 'min:1', 'max:50'],
            'last_name' => ['required', 'min:1', 'max:50'],
            'email' => ['required', 'unique:admins', 'email']
        ], $messages = [
            'mobile.required' => 'شماره موبایل خود را وارد کنید.',
            'mobile.unique' => 'شماره موبایل وارد شده تکراری است.',

            'name.required' => 'نام کاربری را وارد کنید.',
            'name.min' => 'حداقل ۱ کاراکتر وارد کنید.',
            'name.max' => 'حداکثر ۵۰ کاراکتر.',
            'name.unique' => 'نام کاربری وارد شده تکراری است.',

            'first_name.required' => 'نام خود را وارد کنید.',
            'first_name.min' => 'حداقل ۱ کاراکتر وارد کنید.',
            'first_name.max' => 'حداکثر ۵۰ کاراکتر',

            'last_name.required' => 'نام خانوادگی خود را وارد کنید.',
            'last_name.min' => 'حداقل ۱ کاراکتر وارد کنید.',
            'last_name.max' => 'حداکثر ۵۰ کاراکتر',

            'email.required' => 'ایمیل خود را وارد کنید.',
            'email.email' => 'فرمت ایمیل وارد شده صحبح نمی باشد. ',
            'email.unique' => 'ایمیل وارد شده تکراری است.',

        ]);

        try {
            $token = GenerateToken::generateToken();
            $admin = Admin::create([
                'name' => $request->name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'token' => $token,
            ]);


            session(['admin_mobile' => $admin->mobile]);

           // $admin->notify(new AdminAuthorizeNotify($admin));
            $request->session()
                ->flash('success', 'کد فعال سازی به شماره موبایل ارسال شد.');
            return view('auth_admin.validate_token');

        } catch (\Exception $ex) {

            return view('errors_custom.login_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }
}
