<?php

namespace App\Http\Livewire\Front\Product;

use App\Models\Warranty;
use Livewire\Component;

class WarrantySelector extends Component
{
    public $product;
    public $warranties;

    public function mount($product)
    {
        $this->warranties = Warranty::where('product_id', $product)->where('status', 1)->get();

    }

    public function selectWarranty($warrantyId){

        $this->emitTo(AddToCart::class,'selectedWarranty', $warrantyId);
    }

    public function render()
    {
        return view('livewire.front.product.warranty-selector')
            ->with(['warranties' => $this->warranties]);
    }
}
