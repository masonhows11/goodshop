<?php

namespace App\Http\Controllers\Dash\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonDiscountRequest;
use App\Models\CommonDiscount;

class CommonDiscountController extends Controller
{

    public function index()
    {
        return view('dash.common_discount.index');
    }

    public function create()
    {

        return view('dash.common_discount.create');

    }

    public function store(CommonDiscountRequest $request)
    {

        $timeStart = substr($request->start_date, 0, 10);
        $startDate = date("Y-m-d H:i:s", (int)$timeStart);

        $timeEnd = substr($request->end_date, 0, 10);
        $endDate = date("Y-m-d H:i:s", (int)$timeEnd);
        try {
            CommonDiscount::create([
                'title' => $request->title,
                'status' => $request->status,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'percentage' => $request->percentage,
                'minimal_order_amount' => $request->minimal_order_amount,
                'discount_ceiling' => $request->discount_ceiling,

            ]);
            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->route('admin.common.discount.index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }

    }

    public function edit(CommonDiscount $discount)
    {

        return view('dash.common_discount.edit',['discount'=>$discount]);
    }

    public function update(CommonDiscountRequest $request)
    {

        $timeStart = substr($request->start_date, 0, 10);
        $startDate = date("Y-m-d H:i:s", (int)$timeStart);

        $timeEnd = substr($request->end_date, 0, 10);
        $endDate = date("Y-m-d H:i:s", (int)$timeEnd);
        try {
            CommonDiscount::where('id',$request->discount_id)->update([
                'title' => $request->title,
                'status' => $request->status,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'percentage' => $request->percentage,
                'minimal_order_amount' => $request->minimal_order_amount,
                'discount_ceiling' => $request->discount_ceiling,

            ]);
            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.common.discount.index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }

    }


}
