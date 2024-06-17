<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditBrand extends Component
{
    use WithFileUploads;

    public $logo;
    public $title_persian;
    public $title_english;
    public $seo_desc;
    public $is_active;
    public $edit_id;
    public $brand_logo;
    public $brand_title;
    public $image_extension;

    public function mount($id)
    {

        $this->edit_id = $id;
        $model = DB::table('brands')->where('id', $id)->first();
        $this->brand_title = $model->title_persian;

        $this->title_persian = $model->title_persian;
        $this->title_english = $model->title_english;
        $this->seo_desc = $model->seo_desc;
        $this->is_active = $model->is_active;
        $this->brand_logo = $model->logo_path;


    }

    protected $rules = [
        'logo' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1999'],
        'title_english' => ['required', 'min:2', 'max:30', 'alpha_dash'],
        'title_persian' => ['required', 'min:2', 'max:30'],
        'is_active' => ['required'],
        'seo_desc' => ['required'],
    ];

    protected $messages = [
        'logo.mimes' => 'فایل انتخاب شده معتبر نمی باشد',
        'logo.max' => 'حداکثز حجم فایل ۲ مگابایت',
        'logo.min_width' => 'حداقل عرض تصویر ۵۰۰ پیکسل',
        'logo.max_height' => 'حداقل ارتفاع تصویر ۵۰۰ پیکسل',

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


    public function update()
    {

        $this->validate();

        try {

            $brand = Brand::findOrFail($this->edit_id);

            if ($this->logo != null) {

                $this->image_extension = $this->logo->getClientOriginalExtension();
                // create image name
                $image_path = 'UIMG' . date('YmdHis') . uniqid('', true) . '.' . $this->image_extension;
                // save image with given name
                $this->logo->storeAs('images', $image_path, 'public');

                if ($brand->logo_path != null) {
                    if (Storage::disk('public')->exists('images/' . $brand->logo_path)) {
                        Storage::disk('public')->delete('images/' . $brand->logo_path);
                    }
                }
                $brand->logo_path = $image_path;
            }

            $brand->title_persian = $this->title_persian;
            $brand->title_english = $this->title_english;
            $brand->is_active = $this->is_active;
            $brand->seo_desc = $this->seo_desc;
            $brand->save();

            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->to('/admin/brand/index');
        } catch (\Exception $ex) {
            session()->flash('error', __('messages.An_error_occurred'));
        }
        return null;
    }

    public function render()
    {
        return view('livewire.admin.brand.admin-edit-brand')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['brand_title' => $this->brand_title]);
    }
}
