<?php

namespace App\Http\Controllers\Dash\Product;

use App\Models\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCreateColorController extends Controller
{
    //
    public function create(Request $request)
    {

        $product =  Product::where('id', $request->product)->select(['id', 'title_persian'])->first();
        return view('dash.product.create.create_colors')->with('product',$product);

    }
}
