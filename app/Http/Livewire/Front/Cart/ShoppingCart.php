<?php

namespace App\Http\Livewire\Front\Cart;

use App\Models\CartItems;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShoppingCart extends Component
{


    public $user_id;
    public $item_id;
    public $cartNumber = 1;
    public $changeNumber = false;
    public $disabled = false;

    public function mount()
    {
        $this->user_id = Auth::id();

    }

    public function increaseItem($itemId)
    {

        CartItems::where('id', $itemId)->increment('number', 1);
        $this->emitTo(CartHeader::class, 'addToCart', $this->cartNumber);
    }

    public function decreaseItem($itemId)
    {

        
        $count = CartItems::where('id', $itemId)->where('number', '=', 1)->first();
        if ($count) {
            $this->disabled = true;
            die();
        } else {
            CartItems::where('id', $itemId)->decrement('number', 1);
            $this->emitTo(CartHeader::class, 'removeFromCart', $this->cartNumber);

        }


    }

    public function deleteConfirmation($id)
    {
        $this->item_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {

        try {
            $model = CartItems::findOrFail($this->item_id);

            if ($model->user_id === Auth::id()) {
                $model->delete();

                $this->emitTo(CartHeader::class, 'removeFromCart', $this->cartNumber);

                $this->dispatchBrowserEvent('show-result',
                    ['type' => 'success',
                        'message' => __('messages.The_deletion_was_successful')]);
            }
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'error',
                    'message' => __('messages.An_error_occurred')]);
        }


    }

    public function render()
    {
        return view('livewire.front.cart.shopping-cart')
            ->with('cartItems', CartItems::where('user_id', $this->user_id)->get());
    }
}