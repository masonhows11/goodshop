<?php

namespace App\Http\Controllers\Dash\Banner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductByCategory;
use Illuminate\Http\Request;

class ProductByCategorySliderController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $productByCategory = ProductByCategory::all();
        return view('dash.product_category_slider.index')
            ->with(['categories' => $categories, 'productByCategory' => $productByCategory]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'category' => ['required']
        ], $messages = [
            'category.required' => 'فیلد دسته بندی الزامی است',
        ]);

        try {

            if (Category::find($request->category)->products()->count() == 0) {
                session()->flash('warning', __('messages.there_are_no_products_for_the_selected_category'));
                return redirect()->route('admin.product.category.index');
            }
            if (ProductByCategory::count() == 1) {
                session()->flash('warning', __('messages.you_can_choose_only_one_product_group'));
                return redirect()->route('admin.product.category.index');
            }

            $category_name = Category::where('id', $request->category)
                ->select('title_persian')
                ->first();
            $description = __('messages.category_products') . ' ' . $category_name->title_persian . ' ' . __('messages.were_selected');

            $result = ProductByCategory::create([
                'category_id' => $request->category,
                'category_name' => $category_name->title_persian,
                'description' => $description,
            ]);
            if ($result !== null) {
                session()->flash('success', __('messages.New_record_saved_successfully'));
                return redirect()->route('admin.product.category.index');
            }
            session()->flash('warning', __('messages.An_error_occurred'));
            return redirect()->route('admin.product.category.index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }


    }

    public function destroy(ProductByCategory $category, Request $request)
    {

        try {
            $category->delete();
            session()->flash('success', __('messages.The_deletion_was_successful'));
            return redirect()->route('admin.product.category.index');
        } catch (\Exception $ex) {
            return view('errors_custom.general_error')->with(['error' => $ex->getMessage()]);
        }
    }

}
