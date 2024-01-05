<?php

namespace App\Http\Livewire\Front\Product;

use App\Http\Livewire\Front\Cart\CartHeader;
use App\Models\CartItems;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddToCart extends Component
{

    public $product;
    public $colors;
    public $defaultPriceByColor;
    public $price;
    public $newPriceByColor;
    public $changePrice = false;
    public $hasWarranty = false;
    public $warrantyPrice;
    // properties for add to cart
    public $final_product_id;
    public $final_color_id_for_cart;
    public $warranty_id_for_cart;
    public $number = 1;


    public function mount($productId)
    {

        $this->product = Product::where('id', $productId)->select(['origin_price', 'available_in_stock', 'id'])->first();
        $this->colors = ProductColor::where('product_id', $productId)->where('status', 1)->where('available_in_stock','>',0)->get();
        $hasDefaultColor = collect($this->colors)->where('default', 1);

        if ($hasDefaultColor->isNotEmpty()) {
            $colorPrice = collect($this->colors)->where('default', 1)->first();
            $this->defaultPriceByColor = $colorPrice->price_increase + $this->product->origin_price;
            // for add to cart
            $this->final_product_id = $this->product->id;
            $this->final_color_id_for_cart = $colorPrice->id;
        }else{
            $this->final_product_id = $this->product->id;
        }
    }

    // event for  change price product by change color
    protected $listeners = [
        'selectedColor' => 'setPriceByColor',
        'selectedWarranty' => 'setPriceByWarranty'
    ];

    public function setPriceByColor($name)
    {
        $this->changePrice = true;
        $this->defaultPriceByColor = null;
        $priceColor = collect($name); // convert to collection
        $this->price = $priceColor['price_increase']; // this is collection
        $this->newPriceByColor = $this->price + $this->product->origin_price;
        // for add to cart
        $this->final_product_id = $this->product->id;
        $this->final_color_id_for_cart = $priceColor->get('id');


    }

    public function setPriceByWarranty($warrantyId)
    {
        $this->hasWarranty = true;
        $warrantyPrice = DB::table('guarantees')
            ->where('id', $warrantyId)
            ->select(['id', 'price_increase'])->first();
        $this->warrantyPrice = $warrantyPrice->price_increase;
        // for add to cart
        $this->warranty_id_for_cart = collect($warrantyPrice)->get('id');
    }

    public function addToCart($product)
    {
        if (Auth::check()) {
            $this->number;

            if ($this->warranty_id_for_cart == null) {
                $this->warranty_id_for_cart = null;
            }
            $cartItems = CartItems::where('product_id', $this->final_product_id)->where('user_id', auth()->user()->id)->get();
            $cartCollect = collect($cartItems);
            if ($cartCollect->isNotEmpty())
            {
                $product = $cartCollect->where('product_color_id', $this->final_color_id_for_cart)
                    ->where('guarantee_id', $this->warranty_id_for_cart)
                    ->first();
                if ($product != null ) {
                    $product->increment('number', 1);
                } else {
                    $inputs = [];
                    $inputs['user_id'] = Auth::id();
                    $inputs['product_id'] = $this->final_product_id;
                    $inputs['product_color_id'] = $this->final_color_id_for_cart;
                    $inputs['guarantee_id'] = $this->warranty_id_for_cart;
                    $inputs['number'] = $this->number;
                    CartItems::create($inputs);
                }

            } else {
                $inputs = [];
                $inputs['user_id'] = Auth::id();
                $inputs['product_id'] = $this->final_product_id;
                $inputs['product_color_id'] = $this->final_color_id_for_cart;
                $inputs['guarantee_id'] = $this->warranty_id_for_cart;
                $inputs['number'] = $this->number;
                CartItems::create($inputs);
            }
            $this->emitTo(CartHeader::class, 'addToCart', $this->number);
        } else {
            return redirect()->route('auth.login.form');
        }

    }

    public function render()
    {
        return view('livewire.front.product.add-to-cart')
            ->with(['product' => $this->product , 'amazingSale' => $this->product->activeAmazingSale()]);
    }
}
