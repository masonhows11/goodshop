<?php

namespace App\Http\Controllers\Dash\Product;

use App\Models\Color;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCreateColorController extends Controller
{
    //
    public function create(Request $request)
    {

        $colors  = Color::all();
        $product =  Product::where('id', $request->product)->select(['id', 'title_persian'])->first();
        return view('dash.product.create.create_colors',['product' => $product , 'colors' => $colors]);

    }
}
