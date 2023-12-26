<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProductImages extends Component
{

    //  $this->dispatchBrowserEvent('show-result',
    //  ['type' => 'success',
    //   'message' => __('messages.New_record_saved_successfully')]);

    use WithFileUploads;


    public $product_id;
    public $photo;
    public $delete_id;
    public $image_id;
    public $image_active = true;
    public $image_path;
    public $image_extension;


    public function mount($product)
    {

        $this->product_id = $product;

    }

    protected $rules = [
        'photo' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2000'],//, 'dimensions:min_width=300,min_height=300'],
    ];


    protected $messages = [
        'photo.mimes' => 'فایل انتخاب شده معتبر نمی باشد',
        'photo.max' => 'حداکثز حجم فایل ۲ مگابایت',
        'photo.dimensions.min_width' => 'حداقل عرض تصویر ۳۰۰ پیکسل',
        'photo.dimensions.max_height' => 'حداقل ارتفاع تصویر ۳۰۰ پیکسل',

    ];

    public function active($id)
    {
        $this->image_id = $id;

        try {
            $image = ProductImage::findOrFail($id);
            if ($image->is_active == 0) {
                $image->is_active = 1;
                $this->image_active = true;
                $image->save();
            } else {
                $image->is_active = 0;
                $this->image_active = false;
                $image->save();
            }
        } catch (\Exception $ex) {
            return view('errors_custom.general_error');
        }
        return null;

    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteImage',
    ];

    public function deleteImage()
    {
        try {

            $image = ProductImage::findOrFail($this->delete_id);
            Storage::disk('public')->delete('/images/product/gallery/' . $image->image_path);
            $image->delete();
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => __('messages.The_deletion_was_successful')]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return null;
    }

    public function save()
    {
        $this->validate();


        if (ProductImage::where('product_id', $this->product_id)->count() == 4) {
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => __('messages.You_can_choose_up_to_4_images')]);
        } else {
            try {

                if ($this->photo) {
                    $this->image_extension = $this->photo->getClientOriginalExtension();
                    $this->image_path = 'UIMG' . '_' . date('YmdHis') . '_' . uniqid('img', true) . '.' . $this->image_extension;
                    $this->photo->storeAs('images/product/gallery', $this->image_path, 'public');

                    ProductImage::create([
                        'product_id' => $this->product_id,
                        'image_path' => $this->image_path,
                        'is_active' => 1,
                    ]);
                    $this->photo = null;
                    session()->flash('success', __('messages.New_record_saved_successfully'));
                    return redirect()->route('admin.product.create.images', $this->product_id);

                }
            } catch (\Exception $ex) {
                return view('errors_custom.model_store_error');
            }
            return null;
        }


    }

    public function render()
    {
        return view('livewire.admin.create-product.create-product-images')
            ->with(['images' => ProductImage::where('product_id', $this->product_id)->get(),
                    'product' => $this->product_id,
                    'title'=> Product::where('id',$this->product_id)->select('title_persian')->first()]);

    }



}
