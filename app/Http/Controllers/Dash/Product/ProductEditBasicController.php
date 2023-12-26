<?php

namespace App\Http\Controllers\Dash\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductBasicRequest;
use App\Models\Product;
use App\Repositories\ProductBasicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductEditBasicController extends Controller
{


    protected ProductBasicRepository $productBasicRepository;

    public function __construct(ProductBasicRepository $basicRepository)
    {
        $this->productBasicRepository = $basicRepository;
    }
    public function edit(Request $request)
    {

        try {
            $category_ids[] = '';
            $product = Product::findOrFail($request->product);
            $categories =  DB::table('categories')->select('id','title_persian')->get();
            foreach ($product->categories as $cat) {
                $category_ids[] = $cat->id;
            }
            $brands = DB::table('brands')->select('id','title_persian')->get();
            return view('dash.product.edit.edit_basic')
                ->with(['product' => $product,
                    'categories' => $categories,
                    'category_ids' => $category_ids,
                    'brands' => $brands]);
        } catch (\Exception $ex) {

            return view('errors_custom.model_not_found');
        }

    }

    public function update(ProductBasicRequest $request)
    {
        try {
            $this->productBasicRepository->update($request);
            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.product.index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }


}
