<?php

namespace App\Http\Controllers\Dash\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\GenerateToken;
use App\Services\Message\Email\EmailService;
use App\Services\Message\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    //
    public function loginForm()
    {
        return view('auth_admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'exists:admins,email'],
        ], $messages = [
            'email.required' => 'ایمیل خود را وارد کنید',
            'email.exists' => 'کاربری با ایمیل وارد شده وجود ندارد',
        ]);

        try {
            $code = GenerateToken::generateAdminToken();
            $admin = Admin::where('email', $request->email)->first();
            $admin->code = $code;
            $admin->save();
            // l.v 1
            $emailService = new EmailService();
            $details = [
                'title' => 'کد  ورود به پنل میدیریت',
                'body' => $admin->code,
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('goodshop@gmail.com','goodShopSupport');
            $emailService->setSubject('کد ورود به پنل میدیریت');
            $emailService->setTo($admin->email);
            // l.v 2
            $messageService = new MessageService($emailService);
            $messageService->send();

            session()->flash('success', 'کد فعال سازی به ایمیل ارسال شد');
            return redirect()->route('admin.validate.email.form');
        } catch (\Exception $ex) {
            return view('errors_custom.login_error',['error'=>$ex->getMessage()]);
        }

    }

    public function logOut(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->code = null;
        $admin->email_verified_at = null;
        $admin->remember_token = null;
        $admin->save();
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login.form');
    }

}
