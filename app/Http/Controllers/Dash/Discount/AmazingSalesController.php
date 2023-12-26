<?php

namespace App\Http\Controllers\Dash\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\AmazingSaleRequest;
use App\Models\AmazingSales;
use App\Models\Product;
use Illuminate\Http\Request;

class AmazingSalesController extends Controller
{
    public function index()
    {
        return view('dash.amazing_sales.index');
    }

    public function create()
    {

        $products = Product::select('id','title_persian')->get();
        return view('dash.amazing_sales.create',['products'=>$products]);

    }

    public function store(AmazingSaleRequest $request)
    {

        $timeStart = substr($request->start_date, 0, 10);
        $startDate = date("Y-m-d H:i:s", (int)$timeStart);

        $timeEnd = substr($request->end_date, 0, 10);
        $endDate = date("Y-m-d H:i:s", (int)$timeEnd);

        try {
            AmazingSales::create([
                'product_id' => $request->product,
                'status' => $request->status,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'percentage' => $request->percentage,
            ]);
            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->route('admin.amazing.sale.index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }

    }

    public function edit(AmazingSales $amazingSale)
    {

        $products = Product::select('id','title_persian')->get();
        return view('dash.amazing_sales.edit')
            ->with(['sale' => $amazingSale , 'products' => $products ]);
    }

    public function update(AmazingSaleRequest $request)
    {

       // dd($request);
        $timeStart = substr($request->start_date, 0, 10);
        $startDate = date("Y-m-d H:i:s", (int)$timeStart);

        $timeEnd = substr($request->end_date, 0, 10);
        $endDate = date("Y-m-d H:i:s", (int)$timeEnd);
        try {
            AmazingSales::where('id', $request->amazing_sale_id)->update([
                'product_id' => $request->product,
                'status' => $request->status,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'percentage' => $request->percentage,

            ]);
            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.amazing.sale.index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }

    }
}
