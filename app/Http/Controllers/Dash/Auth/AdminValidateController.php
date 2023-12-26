<?php

namespace App\Http\Controllers\Dash\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\ValidateUserAdminService\ValidateAdminEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminValidateController extends Controller
{
    //
    public function validateEmailForm()
    {
        return view('auth_admin.validate_email');
    }
    public function validateEmail(Request $request)
    {

        $request->validate([
            'email' => ['required', 'exists:admins'],
            'code' => ['required', 'digits:6']
        ], $messages = [
            'email.exists' => 'کاربری با ایمیل وارد شده وجود ندارد',
            'email.required' => 'ایمیل خود را وارد کنید',

            'code.required' => 'کد فعال سازی را وارد کنید',
            'code.digits' => 'کد فعال سازی  معتبر نمی باشد',
        ]);

        $validated = ValidateAdminEmail::checkAdminToken($request->code, $request->email);
        if ($validated == false) {
            session()->flash('error', 'کد فعال سازی معتبر نمی باشد');
            return redirect()->route('admin.login.form');
        }
        if ($admin = Admin::where(['email' => $request->email, 'code' => $request->code])->first()) {
            Auth::guard('admin')->login($admin, $request->remember);
            session()->flash('success', 'ورود موفقیت آمیز بود.');
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login.form');
    }

}
