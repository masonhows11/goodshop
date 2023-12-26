<?php

namespace App\Http\Livewire\Front\Layout;


use App\Models\Category;
use App\Models\ProductByCategory;
use Livewire\Component;


class FrontCategorySlider extends Component
{
    public $category;
    public $products;
    public $category_name;

    public function mount()
    {
        $this->category = ProductByCategory::select('category_id', 'category_name')->first();

        $this->category_name = $this->category ? $this->category->category_name : null;
        $this->products = $this->category ? Category::find($this->category->category_id)
            ->products()->take(6)
            ->get() : null;
        $this->products = collect($this->products)->where('status', 1)->all();


    }

    //    public function addToFave()
    //    {
    //        if (!Auth::check()) {
    //            return redirect()->route('auth.login.form');
    //        } else {
    //
    //        }
    //    }

    public function render()
    {
        return view('livewire.front.layout.front-category-slider')
            ->with(['products' => $this->products, 'category_name' => $this->category_name]);


    }
}
