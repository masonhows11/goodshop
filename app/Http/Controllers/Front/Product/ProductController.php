<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function show(Product $product)
    {

        $product_id = $product->id;
        $productCategories = $product->categories()->get(['title_persian']);
        $relatedProducts = Product::with('tags')->whereHas('tags',function ($q) use ($product){
            $q->whereIn('tag_id',$product->tags()->select('tag_id'));
        })->where('status', 1)
          ->where('available_in_stock', '>', 0)
          ->select(['id', 'title_persian', 'origin_price', 'thumbnail_image', 'slug'])
          ->take(4)->get()->except($product->id);
        $colors = ProductColor::where('product_id', $product_id)->where('status', 1)->get();
        $images = ProductImage::where('product_id', $product_id)->where('is_active', 1)->get();
        $categories = $productCategories->implode('title_persian', ' - ');


        return view('front.product.product')
            ->with(['product' => $product,
                'categories' => $categories,
                'product_id' => $product_id,
                'colors' => $colors,
                'images' => $images,
                'relatedProducts' => $relatedProducts,
                'productCategories' => $productCategories]);
    }

    public function addToFavoriteProducts(Request $request)
    {

        $product = Product::findOrFail($request->product);
        if (Auth::check()) {
            $product->user()->toggle([Auth::id()]);
            if ($product->user->contains(Auth::id())) {
                return response()->json(['status' => 1], 200);
            } else {
                return response()->json(['status' => 2], 200);
            }
        } else {
            return response()->json(['status' => 3], 200);
        }
    }

    public function addToCompareProducts(Request $request)
    {

        $product = Product::findOrFail($request->product);
        if (Auth::check()) {
            $user = Auth::user();
            if($user->compare()->count() > 0){
                $userCompareList  = $user->compare;
            }else{
                $userCompareList = Compare::create(['user_id' => $user->id]);
            }
            $product->compares()->toggle([$userCompareList->id]);
            if ($product->compares->contains($userCompareList->id)) {
                return response()->json(['status' => 1], 200);
            } else {
                return response()->json(['status' => 2], 200);
            }
        } else {
            return response()->json(['status' => 3], 200);
        }
    }


}
