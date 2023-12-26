<?php

namespace App\Http\Controllers\Dash\Comments;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class AdminCommentController extends Controller
{
    //
    public function productIndexComments()
    {
        $products = Product::paginate(15);
        return view('dash.comments.product_comments_list')
            ->with('products',$products);
    }


    public function productComments(Request $request)
    {

        $product_id = $request->product;
        $product = Product::where('id',$request->product)->select('title_persian')->first();
        return view('dash.comments.product_comments')
            ->with(['product' => $product,'product_id' => $product_id]);
    }


}
