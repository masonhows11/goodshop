<?php

namespace App\Http\Livewire\Front\Cart;

use App\Models\CartItems;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartHeader extends Component
{

    public $cartCount = null;
    public $cartItemsCount = null;

    public function mount(){

        $this->cartCount = CartItems::where('user_id',Auth::id())->get();

        foreach ($this->cartCount as $item){
            $this->cartItemsCount += $item->number;
        }

    }

    protected $listeners = [
        'addToCart' => 'incrementCartCount',
        'removeFromCart' => 'decrementCartCount'
    ];

    public function incrementCartCount($count){

        $this->cartItemsCount += $count;
    }

    public function decrementCartCount($count)
    {
        $this->cartItemsCount -= $count;
    }

    public function render()
    {
        return view('livewire.front.cart.cart-header')
            ->with([ 'cartCount' => $this->cartItemsCount ]);
    }
}
