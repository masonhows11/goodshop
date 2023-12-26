<?php

namespace App\Http\Controllers\Dash\StockProduct;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToStockRequest;
use App\Http\Requests\EditStockRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    //
    public function index()
    {
        try {
            $products = DB::table('products')
                ->select('id', 'title_persian', 'thumbnail_image', 'number_sold', 'frozen_number','available_in_stock','salable_quantity')
                ->paginate(10);
            return view('dash.stock.index', ['products' => $products]);
        }catch (\Exception $ex){
            return  view('errors_custom.model_not_found')->with(['error' => $ex->getMessage()]);
        }

    }

    public function addToStockForm(Request $request)
    {
        $product = DB::table('products')
            ->select('id','title_persian')
            ->where('id',$request->product)->first();
        return view('dash.stock.add_to_stock')->with(['product'=>$product]);
    }

    public function addToStock(AddToStockRequest $request){



        try {
            $product = Product::findOrFail($request->product_id);
            $product->available_in_stock += $request->numbers;
            $product->salable_quantity = $request->salable_quantity;
            $product->save();
             Log::info("recipient => {$request->recipient } ,  deliver => {$request->deliver },  description => {$request->description} , add_stock => {$request->numbers} ");
            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->route('admin.stock.product.index');
        }catch (\Exception $ex){

            return view('errors_custom.model_store_error')
                ->with(['error'=>$ex->getMessage()]);
        }


    }

    public function modifyStockForm(Request $request)
    {

        try {
            $product = DB::table('products')
                ->where('id',$request->product)
                ->select('id','title_persian','number_sold','frozen_number','salable_quantity','available_in_stock')
                ->first();
            return view('dash.stock.modify_stock')
                ->with( ['product'=>$product] );
        }catch (\Exception $ex){
            return  view('errors_custom.model_store_error')->with(['error' => $ex->getMessage()]);
        }
    }

    public function modifyStock(EditStockRequest $request){

        try {
            Product::where('id',$request->product_id)
                ->update(['number_sold' => $request->number_sold,
                    'frozen_number' => $request->frozen_number,
                    'available_in_stock' => $request->available_in_stock,
                    'salable_quantity' => $request->salable_quantity]);
            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.stock.product.index');
        }catch (\Exception $ex){
            return  view('errors_custom.model_store_error')->with(['error' => $ex->getMessage()]);
        }


    }

}
