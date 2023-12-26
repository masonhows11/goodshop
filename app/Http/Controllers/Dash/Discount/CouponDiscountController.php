<?php

namespace App\Http\Controllers\Dash\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\User;


class CouponDiscountController extends Controller
{
    public function index()
    {
        return view('dash.coupon_discount.index');
    }

    public function create()
    {

        $users = User::all();
        return view('dash.coupon_discount.create', ['users' => $users]);

    }

    public function store(CouponRequest $request)
    {

        $timeStart = substr($request->start_date, 0, 10);
        $startDate = date("Y-m-d H:i:s", (int)$timeStart);

        $timeEnd = substr($request->end_date, 0, 10);
        $endDate = date("Y-m-d H:i:s", (int)$timeEnd);

        $user_id = null;
        try {

            $coupon = new Coupon();

            if ($request->coupon_type == 0) {

                $coupon->user_id = null;
            }

            $coupon->code = $request->code;
            $coupon->user_id = $request->user_id;
            $coupon->amount = $request->amount;
            $coupon->amount_type = $request->amount_type;
            $coupon->discount_ceiling = $request->discount_ceiling;
            $coupon->type = $request->coupon_type;
            $coupon->status = $request->status;
            $coupon->start_date = $startDate;
            $coupon->end_date = $endDate;
            $coupon->save();

            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->route('admin.coupons.index');
        } catch (\Exception $ex) {

            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }

    }

    public function edit(Coupon $coupon)
    {

        $users = User::all();
        return view('dash.coupon_discount.edit')
            ->with(['coupon' => $coupon, 'users' => $users]);
    }

    public function update(CouponRequest $request)
    {

        // dd($request);
        $timeStart = substr($request->start_date, 0, 10);
        $startDate = date("Y-m-d H:i:s", (int)$timeStart);

        $timeEnd = substr($request->end_date, 0, 10);
        $endDate = date("Y-m-d H:i:s", (int)$timeEnd);

         $user_id = null;
        try {

            $coupon = Coupon::findOrFail($request->coupon_id);

            if ($request->coupon_type == 0) {

                $coupon->user_id = null;
            }

            $coupon->code = $request->code;
            $coupon->user_id = $request->user_id;
            $coupon->amount = $request->amount;
            $coupon->amount_type = $request->amount_type;
            $coupon->discount_ceiling = $request->discount_ceiling;
            $coupon->type = $request->coupon_type;
            $coupon->status = $request->status;
            $coupon->start_date = $startDate;
            $coupon->end_date = $endDate;
            $coupon->save();

            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.coupons.index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }

    }
}
