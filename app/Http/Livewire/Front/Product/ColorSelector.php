<?php

namespace App\Http\Livewire\Front\Product;

use App\Models\ProductColor;
use Livewire\Component;

class ColorSelector extends Component
{

    public $product;
    public $colors;
    public $selectedColorName;
    public $defaultColor = false;
    public function mount()
    {
        $this->colors = ProductColor::where('product_id', $this->product)
            ->where('available_in_stock','>',0)
            ->where('status',1)->get();
        $hasDefaultColor = collect($this->colors)->where('default', 1);

        if ($hasDefaultColor->isNotEmpty()) {
            $defaultColorName = collect($this->colors)->where('default', 1)->first();
            $this->selectedColorName = $defaultColorName->color_name;
            $this->defaultColor = true;
        } else {
            $this->defaultColor = false;
        }
    }

    public function radioClick($color)
    {
        if ($this->defaultColor == true) {
            $this->defaultColor = false;
        }
    }

    public function selectColor($color)
    {

        $name = ProductColor::where(['product_id' => $this->product, 'color_id' => $color])
            ->select('color_name','id','price_increase')->first();
        $this->selectedColorName = $name->color_name;

        $this->emitTo(AddToCart::class,'selectedColor', $name);

        // dd($name);
        ////// to fire event in parent component //////
        // $this->emitUp('chooseColor',$color);

        ////// to fire event on specific component //////
        // chooseColor is event name
        // SingleProduct component class name on this way
        // use SingleProduct::class
        // $color is parameter
        // $this->emitTo(SingleProduct::class,'chooseColor', $color);


    }

    public function render()
    {
        return view('livewire.front.product.color-selector')
            ->with(['colors' => $this->colors]);
    }
}
