<?php

namespace App\Http\Livewire\Front\Compare;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompareProducts extends Component
{
    public $product_id;
    public $product;
    public $user;

    public function deleteConfirmation($id)
    {
        $this->user = Auth::user();
        $this->product_id = $id;
        $this->product = Product::findorfail($id);
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {
            $userCompareList  = $this->user->compare;
            $this->product->compares()->toggle([$userCompareList->id]);
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
        return view('livewire.front.compare.compare-products')
            ->with(['compare_products' => auth()->user()->compare->products]);
    }
}
