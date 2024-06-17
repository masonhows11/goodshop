<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminCategoryEdit extends Component
{
    use WithFileUploads;

    public $title_persian;
    public $title_english;
    public $parent;
    public $show_in_menu;
    public $image_path;
    public $status;
    public $image_extension;
    public $path;
    public $category;
    public $category_title;
    public $category_image;
    public $edit_id;



    public function mount($id)
    {
        $this->edit_id = $id;
        $this->category = Category::findOrFail($id);
        $this->category_title = $this->category->title_persian;
        $this->category_image = $this->category->image_path;
        if ($this->category->parent_id == null) {
            $this->title_persian = $this->category->title_persian;
            $this->title_english = $this->category->title_english;
            $this->status = $this->category->status;
            $this->show_in_menu = $this->category->show_in_menu;
            $this->parent = null;
        } else {
            $this->title_persian = $this->category->title_persian;
            $this->title_english = $this->category->title_english;
            $this->status = $this->category->status;
            $this->show_in_menu = $this->category->show_in_menu;
            $this->parent = $this->category->parent_id;
        }
    }

    protected function rules()
    {
        return [
            'title_persian' => ['required', Rule::unique('categories')->ignore($this->edit_id), 'min:2', 'max:30'],
            'title_english' => ['required', Rule::unique('categories')->ignore($this->edit_id), 'min:2', 'max:30', 'alpha_dash'],
            'show_in_menu' => ['required'],

            'status' => ['required'],
            'image_path' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2000'],
        ];
    }
    protected $messages = [
        'title_english.required' => 'عنوان دسته بندی را به انگلیسی وارد کنید.',
        'title_english.min' => 'حداقل ۲ کارکتر.',
        'title_english.max' => 'حداکثر ۵۰ کاراکتر.',
        'title_english.unique' => 'عنوان وارد شده تکراری است.',
        'title_english.alpha_dash' => ' فقط حروف ، خط فاصله ، زیر خط و به انگلیسی وارد کنید.',
        'title_persian.required' => 'عنوان دسته بندی را به فارسی وارد کنید.',
        'title_persian.min' => 'حداقل ۲ کارکتر.',
        'title_persian.max' => 'حداکثر ۵۰ کاراکتر.',
        'title_persian.unique' => 'عنوان وارد شده تکراری است.',
        'show_in_menu.required' => 'نمایش در منو را انتخاب کنید.',
        'image_path.mimes' => 'فایل انتخاب شده معتبر نمی باشد',
        'image_path.max' => 'حداکثز حجم فایل ۲ مگابایت',
        'image_path.dimensions.min_width' => 'حداقل عرض تصویر ۳۰۰ پیکسل',
        'image_path.dimensions.max_height' => 'حداقل ارتفاع تصویر ۳۰۰ پیکسل',
    ];


    public function updateCategory()
    {
        $this->validate();

        try {
            if ($this->edit_id === $this->parent) {
                $this->dispatchBrowserEvent('show-result',
                    ['type' => 'warning',
                        'message' => __('messages.A_category_cannot_be_its_own_parent')]);
                return null;
            }
            if ($this->image_path) {
                $this->image_extension = $this->image_path->getClientOriginalExtension();
                // create image name
                $this->path = 'UIMG' . '_' . date('YmdHis') . '_' . uniqid('img', true) . '.' . $this->image_extension;
                // save image with given name
                $this->image_path->storeAs('images/category/', $this->path, 'public');
                if ($this->category->image_path != null) {
                    if (Storage::disk('public')->exists('images/category/' . $this->category->image_path)) {
                        Storage::disk('public')->delete('images/category/' . $this->category->image_path);
                    }
                }
                $this->category->image_path = $this->path;
            }

            if ($this->parent != null) {
                $this->category->title_persian = $this->title_persian;
                $this->category->title_english = $this->title_english;
                $this->category->status = $this->status;
                $this->category->show_in_menu = $this->show_in_menu;
                $this->category->parent_id = $this->parent;
            } else {
                $this->category->title_persian = $this->title_persian;
                $this->category->title_english = $this->title_english;
                $this->category->status = $this->status;
                $this->category->show_in_menu = $this->show_in_menu;
            }
            $this->category->save();
            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->to('/admin/category/index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }

    public function render()
    {
        return view('livewire.admin.category.admin-category-edit')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['categories' => Category::all(),
                'category' => $this->category ,
                'category_title'=>$this->category_title]);
    }


}
