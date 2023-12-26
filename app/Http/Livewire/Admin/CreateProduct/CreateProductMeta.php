<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateProductMeta extends Component
{

    // session()->flash('success', __('messages.New_record_saved_successfully'));
    public $product;
    public $product_id;
    public $meta_id;
    public $meta_key;
    public $meta_value;
    public $edit_mode = false;

    public function mount($product)
    {
        $this->product_id = $product;
        $this->product = Product::where('id', $product)->select(['id', 'title_persian'])->first();

    }

    protected $rules = [
        'meta_key' => ['required', 'min:2', 'max:30', 'string'],
        'meta_value' => ['required', 'min:2', 'max:30', 'string'],
    ];


    public function save()
    {
        $this->validate();

        try {
            if ($this->edit_mode == false) {
                DB::table('product_meta')->insert([
                    'product_id' => $this->product_id,
                    'meta_key' => $this->meta_key,
                    'meta_value' => $this->meta_value
                ]);
                $this->dispatchBrowserEvent('show-result',
                    ['type' => 'success',
                        'message' => __('messages.New_record_saved_successfully')]);
                $this->meta_key = '';
                $this->meta_value = '';

            } elseif ($this->edit_mode == true) {

                DB::table('product_meta')
                    ->where('id', $this->meta_id)
                    ->update(['meta_key' => $this->meta_key,
                        'meta_value' => $this->meta_value]);
                $this->meta_key = '';
                $this->meta_value = '';
                $this->edit_mode = false;

                $this->dispatchBrowserEvent('show-result',
                    ['type' => 'success',
                        'message' => __('messages.The_update_was_completed_successfully')]);
            }

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
        return null;
    }

    public function edit($id)
    {
        $this->meta_id = $id;
        try {
            $this->edit_mode = true;
            $meta = ProductMeta::findOrFail($id);
            $this->meta_key = $meta->meta_key;
            $this->meta_value = $meta->meta_value;
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return null;

    }


    public function deleteConfirmation($id)
    {
        $this->meta_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {

            $model = ProductMeta::findOrFail($this->meta_id);
            $model->delete();
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => __('messages.The_deletion_was_successful')]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return null;
    }

    public function render()
    {
        return view('livewire.admin.create-product.create-product-meta')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['product' => $this->product,
                    'metas' => ProductMeta::where('product_id', $this->product_id)->get()]);
    }
}
