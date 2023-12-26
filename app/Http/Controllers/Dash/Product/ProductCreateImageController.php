<?php

namespace App\Http\Controllers\Dash\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;


class ProductCreateImageController extends Controller
{


    public function create($product = null)
    {
        try {
            Product::findOrFail($product);
            return view('dash.product.create.create_images')->with('product', $product);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }


}
