<?php

namespace App\Http\Controllers\Front\Profile;

use App\Http\Controllers\Controller;
use App\Models\Product;


class FavoritesController extends Controller
{
    public function favorites(){

        $products = auth()->user()->products()->paginate(10);
        return view('front.profile.favorites',[ 'products' => $products ]);

    }
    public function favoritesDelete(Product $product){
        try {
            $user = auth()->user();
            $user->products()->detach($product->id);
            session()->flash('success',__('messages.The_deletion_was_successful'));
            return redirect()->back();
        }catch (\Exception $ex){
            return view('errors_custom.general_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }
}
