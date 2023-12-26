<?php

namespace App\Http\Controllers\Dash\Auth;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Rules\MobileRule;
use App\Services\ConvertPerToEn;
use App\Services\GenerateToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    //


    public function profile()
    {
        $admin = Admin::where('id', Auth::guard('admin')->id())->first();
        return view('auth_admin.profile.profile')->with(['admin' => $admin]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' =>
                ['required', 'min:1', 'max:20', Rule::unique('admins')->ignore($request->id)],
            'first_name' =>
                ['required', 'min:1', 'max:20', Rule::unique('admins')->ignore($request->id)],
            'last_name' =>
                ['required', 'min:1', 'max:20', Rule::unique('admins')->ignore($request->id)],
            'email' =>
                ['nullable', 'email', Rule::unique('admins')->ignore($request->id)],
            'image_path' =>
                ['image', 'mimes:jpg,png,jpeg,webp', 'max:1024']
            // ,'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ], $message = [

        ]);
        try {
            $admin = Admin::find($request->id);
            $admin->name = $request->name;
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->email = $request->email;
            $save_path = null;
            if ($request->hasFile('image_path')) {
                // get image name
                $file = $request->file('image_path');
                $file_name = $file->getClientOriginalName();
                // save image into dir & if admin has old image delete old image
                if (($admin->image_path != null) && Storage::disk('local')->exists('public/admin_images/' . $admin->image_path)) {
                    Storage::disk('local')->delete('public/admin_images/' . $admin->image_path);
                    $save_path = Storage::putFileAs('public/admin_images', $request->file('image_path'), $file_name);
                }else{
                    $save_path = Storage::putFileAs('public/admin_images', $request->file('image_path'), $file_name);
                }
                // save image name into current admin model
                $save_path = str_replace('public/admin_images/', '', $save_path);
                $admin->image_path = $save_path;
            }
            $admin->save();
            session()->flash('success','پروفایل با موفقیت بروز رسانی شد.');
            return redirect()->route('admin.profile');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }

    public function editMobile()
    {

        $admin = Admin::where('id', Auth::guard('admin')->id())->first();
        return view('auth_admin.profile.change_mobile')->with(['admin' => $admin]);
    }

    public function updateMobile(Request $request)
    {

        $request->validate([
            'mobile' => ['required', 'unique:admins', new MobileRule()],
        ], $messages = [
            'mobile.required' => 'شماره موبایل جدید  را وارد کنید.',
            'mobile.unique' => 'شماره موبایل وارد شده تکراری است.',
        ]);
        try {
            $code = GenerateToken::generateAdminToken();
            $mobile = ConvertPerToEn::convert($request->mobile);
            $admin = Admin::where('id', Auth::guard('admin')->id())->first();
            $admin->mobile = $mobile;
            $admin->code = $code;
            $admin->save();
            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.profile');
            // session(['admin_mobile' => $admin->mobile]);
            // $user->notify(new UserAuthorizeNotify($user));
            // $request->session()->flash('success', 'کد فعال سازی به شماره موبایل ارسال شد.');
            // return view('auth_admin.validate_token');
        } catch (\Exception $ex) {
            return view('errors_custom.register_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }

}
