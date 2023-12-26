<?php

namespace App\Http\Livewire\Admin;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $first_name;
    public $last_name;
    public $email;
    public $image_path;

    public function mount()
    {
        $info = Auth::guard('admin')->user();
        $this->name = $info->name;
        $this->first_name = $info->first_name;
        $this->last_name = $info->last_name;
        $this->email = $info->email;

    }

    protected function rules()
    {
        return [
            'image_path' =>
                ['nullable','mimes:png,jpg,jpeg', 'max:1999', 'dimensions:min_width=300,min_height=300'],
            'name' =>
                ['required', 'min:3', 'max:20', Rule::unique('admins')
                    ->ignore(Auth::guard('admin')->id())],
            'first_name' =>
                ['required', 'min:3', 'max:20', Rule::unique('admins')
                    ->ignore(Auth::guard('admin')->id())],
            'last_name' =>
                ['required', 'min:3', 'max:20', Rule::unique('admins')
                    ->ignore(Auth::guard('admin')->id())],
            'email' =>
                ['nullable','email', Rule::unique('admins')
                    ->ignore(Auth::guard('admin')->id())],
        ];
    }


    protected $messages =
        [
            'image_path.mimes' => 'فایل انتخاب شده معتبر نمی باشد',
            'image_path.max' => 'حداکثز حجم فایل ۲ مگابایت',
            'image_path.min_width' => 'حداقل عرض تصویر ۵۰۰ پیکسل',
            'image_path.max_height' => 'حداقل ارتفاع تصویر ۵۰۰ پیکسل',

            'name.required' => 'نام کاربری الزامی است',
            'name.min' => 'حداقل ۳ کاراکتر',
            'name.max' => 'حداکثر ۲۰ کاراکتر',

            'first_name.required' => 'نام الزامی است',
            'first_name.min' => 'حداقل ۳ کاراکتر',
            'first_name.max' => 'حداکثر ۲۰ کاراکتر',

            'last_name.required' => 'نام خانوادگی الزامی است',
            'last_name.min' => 'حداقل ۳ کاراکتر',
            'last_name.max' => 'حداکثر ۲۰ کاراکتر',

            'email.email' => 'ایمیل وارد شده معتبر نمی باشد',
            'email.unique' => 'ایمیل وارد شده تکراری است',
        ];
    public function update()
    {
        $this->validate();
        $admin = Auth::guard('admin')->user();

        if($this->image_path != null){
            // create image name
            $image_name_save = 'UIMG' . date('YmdHis') . uniqid('', true) . '.jpg';
            // save image with given name
            $this->image_path->storeAs('admin', $image_name_save, 'public');
            if ($admin->image_path != null) {
                if (Storage::disk('public')->exists('admin/' . $admin->image_path)) {
                    Storage::disk('public')->delete('admin/' . $admin->image_path);
                }
            }
            $admin->image_path = $image_name_save;
        }

        $admin->name = $this->name;
        $admin->first_name = $this->first_name;
        $admin->last_name = $this->last_name;
        $admin->email = $this->email;
        $admin->save();
        session()->flash('success','بروز رسانی با موفقیت انجام شد.');
        return redirect()->to('/admin/profile');


    }

    public function render()
    {
        return view('livewire.admin.admin-profile')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['admin'=>Auth::user()]);
    }
}
