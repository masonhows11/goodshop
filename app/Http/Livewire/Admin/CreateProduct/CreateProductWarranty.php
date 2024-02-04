<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Product;
use App\Models\Warranty;
use Livewire\Component;


class CreateProductWarranty extends Component
{


    public $product;
    public $warranty_id;

    public $edit_mode = false;

    public $title;
    public $product_id;
    public $price_increase;
    public $status;

    public function mount($product)
    {
        $this->product = Product::where('id', $product)->first();
        $this->product_id = $this->product->id;
    }

    protected $rules = [
        'title' => ['required', 'min:3', 'max:30'],
        'price_increase' => ['required'],
        'status' => ['required']
    ];


    public function save()
    {
        $this->validate();

        try {
            if ($this->edit_mode == false) {

                Warranty::create([
                    'guarantee_name' => $this->title,
                    'product_id' => $this->product_id,
                    'price_increase' => $this->price_increase,
                    'status' => $this->status,
                ]);
                $this->title = '';
                $this->price_increase = '';
                $this->status = '';

                $this->dispatchBrowserEvent('show-result',
                    ['type' => 'success',
                        'message' => __('messages.New_record_saved_successfully')]);


            } elseif ($this->edit_mode == true) {
                Warranty::where('id', $this->warranty_id)
                    ->update([
                        'guarantee_name' => $this->title,
                        'price_increase' => $this->price_increase,
                        'status' => $this->status,]);

                $this->title = '';
                $this->price_increase = '';
                $this->status = '';
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

        $this->warranty_id = $id;

        try {
            $warranty = Warranty::findOrFail($id);
            $this->title = $warranty->guarantee_name;
            $this->price_increase = $warranty->price_increase;
            $this->status = $warranty->status;
            $this->edit_mode = true;


        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return null;

    }

    public function deleteConfirmation($id)
    {
        $this->warranty_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {

            $model = Warranty::findOrFail($this->warranty_id);
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
        return view('livewire.admin.create-product.create-product-warranty')
            ->with(['warranties' => Warranty::where('product_id', $this->product_id)->paginate(10) ,
                'product_name' => $this->product->title_persian]);
    }
}
