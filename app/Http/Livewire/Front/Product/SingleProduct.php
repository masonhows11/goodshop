<?php

namespace App\Http\Livewire\Front\Product;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\Warranty;
use Livewire\Component;

class SingleProduct extends Component
{
    public $product;
    public $product_id;
    public $colors;
    public $warranties;
    public $images;
    public $relatedProducts;
    public $productCategories;
    public $categories;


    public $colorSelectedName;
    public $product_color;


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->product_id = $product->id;
        $this->productCategories =
            $product->categories()->get(['title_persian']);
        $this->relatedProducts =
            Product::where('status', 1)->where('marketable_number', '>', 0)->select(['id', 'title_persian', 'origin_price', 'thumbnail_image', 'slug'])->get();
        $this->colors =
            ProductColor::where('product_id', $this->product->id)->get();
        $this->warranties =
            Warranty::where('product_id', $this->product->id)->where('status', 1)->get();
        $this->images =
            ProductImage::where('product_id', $this->product->id)->where('is_active', 1)->get();
        $this->categories =
            $this->productCategories->implode('title_persian', ' - ');

    }

        protected $listeners = ['chooseColor'];

        public function chooseColor($color)
        {

            $name = ProductColor::where('product_id', $this->product->id)->
            where('color_id', $color)->select('color_name')->first();
            $this->colorSelectedName = $name->color_name;
        }

            ///// run listener with similar name with event name /////
            //    protected $listeners = ['chooseColor'];
            //    public function chooseColor($color)
            //    {
            //        dd($color);
            //        // $name = ProductColor::where(['product_id' => $this->product->id,'color_id' => $color])->select('color_name')->first();
            //
            //    }

            ///// run listener with different name /////
            //    protected $listeners = ['chooseColor' => 'selectedColor'];
            //    public function selectedColor($color)
            //    {
            //        dd($color);
            //       // $name = ProductColor::where(['product_id' => $this->product->id,'color_id' => $color])->select('color_name')->first();
            //
            //    }






    public function render()
    {
        return view('livewire.front.product.single-product')
            ->extends('front.layouts.master_front')
            ->section('main_content')
            ->with(['product' => $this->product,
                'categories' => $this->categories,
                'product_id' => $this->product_id,
                'colors' => $this->colors,
                'warranties' => $this->warranties,
                'images' => $this->images,
                'relatedProducts' => $this->relatedProducts,
                'productCategories' => $this->productCategories]);
    }
}
