<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminCreateBrand extends Component
{
    use WithFileUploads;

    public $logo;
    public $title_persian;
    public $title_english;
    public $is_active;
    public $seo_desc;
    public $image_path;
    public $image_extension;
    public $new_brand;
    public $sec_desc;

    // 'dimensions:min_width=300,min_height=300'
    protected $rules = [
        'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2000'],
        'title_english' => ['required', 'min:2', 'max:30', 'alpha_dash'],
        'title_persian' => ['required', 'min:2', 'max:30'],
        'is_active' => ['required'],
        'seo_desc' => ['required'],
    ];


    protected $messages = [
        'logo.mimes' => 'فایل انتخاب شده معتبر نمی باشد',
        'logo.max' => 'حداکثز حجم فایل ۲ مگابایت',
        'logo.dimensions.min_width' => 'حداقل عرض تصویر ۳۰۰ پیکسل',
        'logo.dimensions.max_height' => 'حداقل ارتفاع تصویر ۳۰۰ پیکسل',

        'title_english.required' => 'عنوان برند را به انگلیسی وارد کنید.',
        'title_english.min' => 'حداقل ۲ کارکتر.',
        'title_english.max' => 'حداکثر ۳۰ کاراکتر.',
        'title_english.alpha_dash' => ' فقط حروف ، خط فاصله ، زیر خط و به انگلیسی وارد کنید.',

        'title_persian.required' => 'عنوان برند را به فارسی وارد کنید.',
        'title_persian.min' => 'حداقل ۲ کارکتر.',
        'title_persian.max' => 'حداکثر ۳۰ کاراکتر.',

        'is_active.required' => 'وضعیت برند را انتخاب کنید.',
        'seo_desc' => 'توضیحات سئو را وارد کنید.',
    ];


    public function save()
    {

        $this->validate();

        try {

            $this->new_brand = new Brand();

            if ($this->logo) {

                $this->image_extension = $this->logo->getClientOriginalExtension();

                // create image name
                $this->image_path = 'UIMG' . '_' . date('YmdHis') . '_' . uniqid('img', true) . '.' . $this->image_extension;

                // save image with given name
                $this->logo->storeAs('images', $this->image_path, 'public');

                $this->new_brand->logo_path = $this->image_path;
            }

            $this->new_brand->title_persian = $this->title_persian;
            $this->new_brand->title_english = $this->title_english;
            $this->new_brand->is_active = $this->is_active;
            $this->new_brand->seo_desc = $this->seo_desc;
            $this->new_brand->save();

            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->to('/admin/brand/index');
        } catch (\Exception $ex) {
            session()->flash('error', __('messages.An_error_occurred'));
        }
        return null;
    }

    public function render()
    {
        return view('livewire.admin.admin-create-brand')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content');
    }
}
