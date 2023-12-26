<?php

namespace App\Http\Controllers\Front\Cart;

use App\Models\CartItems;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{


    public function checkoutCart()
    {

        if (Auth::check()) {
            return view('front.cart.cart',['user' => Auth::id()]);

        } else {
            return redirect()->route('auth.login.form');
        }

    }


}
