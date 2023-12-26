<?php

namespace App\Http\Controllers\Dash\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductWarrantyController extends Controller
{

    public function create(Request $request)
    {

        return view('dash.product.create.create_warranty')->with('product',$request->product);

    }
}
