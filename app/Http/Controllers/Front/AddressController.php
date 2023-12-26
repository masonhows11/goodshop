<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressDeliveryRequest;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\CartItems;
use App\Models\City;
use App\Models\CommonDiscount;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Province;
use App\Models\User;
use App\Services\OrderNumber\OrderNumberServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    //
    public function checkAddress()
    {
        $deliveries = Delivery::where('status', 1)->get();
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->where('is_active', 1)->get();
        $cartItems = CartItems::where('user_id', $user->id)->get();
        $provinces = Province::all();

        if (empty($user->mobile) || empty($user->first_name) ||
            empty($user->last_name) || empty($user->email) ||
            empty($user->national_code)) {
            session()->flash('error', __('messages.complete_your_user_information_before_proceeding_with_payment'));
            return redirect()->route('user.profile');
        }


        return view('front.address.address')
            ->with(['cartItems' => $cartItems, 'addresses' => $addresses,
                'provinces' => $provinces, 'deliveries' => $deliveries]);
    }

    public function store(AddressRequest $request)
    {
        try {

            $postal_code = convertPerToEnglish($request->postal_code);

            Address::create([
                'user_id' => Auth::id(),
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'mobile' => $request->mobile,
                'plate_number' => $request->plate_number,
                'postal_code' => $postal_code,
                'recipient_first_name' => $request->recipient_first_name,
                'recipient_last_name' => $request->recipient_last_name,
                'address_description' => $request->address_description,
                'is_active' => 1,
            ]);

            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->route('check.address');

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')->with(['error' => $ex->getMessage()]);
        }

    }


    public function getCities(Request $request)
    {
        try {
            $cities = City::where('province_id', $request->id)->get();
            if ($cities->isNotEmpty()) {
                return response()->json(['data' => $cities, 'status' => 200], 200);
            } else {
                return response()->json(['data' => 'not found any record', 'status' => 404], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(['data' => __('messages.An_error_occurred'), 'status' => 500], 200);
        }
    }


    public function update(AddressRequest $request)
    {
        try {

            $postal_code = convertPerToEnglish($request->postal_code);

            Address::where('id', $request->address)->update([
                'user_id' => Auth::id(),
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'mobile' => $request->mobile,
                'plate_number' => $request->plate_number,
                'postal_code' => $postal_code,
                'recipient_first_name' => $request->recipient_first_name,
                'recipient_last_name' => $request->recipient_last_name,
                'address_description' => $request->address_description,
                'is_active' => 1,
            ]);

            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('check.address');

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }

    }


    // this controller add common discount to carts of current user
    public function chooseAddressDelivery(AddressDeliveryRequest $request, OrderNumberServices $numberServices)
    {
        // dd('here');
        $user = auth()->user();

        // calculate final price
        $cartItems = CartItems::where('user_id', $user->id)->get();

        $total_product_price = 0;
        $total_discount_price = 0;
        $total_final_price = 0;
        $total_final_discount_price_with_number = 0;

        foreach ($cartItems as $item) {

            $total_product_price += $item->cartItemProductPriceWithOutNumber();
            $total_discount_price += $item->cartItemProductDiscount();
            $total_final_price += $item->cartItemFinalPrice();
            $total_final_discount_price_with_number += $item->cartItemFinalDiscount();

        }

        //dd($total_product_price .' '. $total_final_price );

        $orderNumber = $numberServices->generateNumber();
        $delivery_amount = Delivery::findOrFail($request->delivery_id);
        $order = Order::updateOrCreate(
            ['user_id' => $user->id, 'order_status' => 0],
            ['order_number' => $orderNumber,
                'address_id' => $request->address_id,
                'delivery_id' => $request->delivery_id,]);


        // return $order;
        // for calculate common discount
        // if there is common discount
        // we use first discount if there is some discount
        // example 50% of the total amount of the shopping cart is considered a discount
        $commonDiscount = CommonDiscount::where([['status', 1], ['end_date', '>', now()], ['start_date', '<', now()]])->first();

        if (empty($commonDiscount)) {
            Order::where(['user_id' => $user->id, 'order_status' => 0])
                ->update(['order_final_amount' => $total_final_price + $delivery_amount->amount,
                    'order_discount_amount' => $total_discount_price,
                    'order_total_products_discount_amount' => $total_final_discount_price_with_number]);

        } else {

            if ($order->common_discount_id == null) {
                // calculate the common discount for this cart price
                $commonPercentDiscount = $total_final_price * ($commonDiscount->percentage / 100);
                // for check maximum discount ceiling
                if ($commonPercentDiscount > $commonDiscount->discount_ceiling) {
                    $commonPercentDiscount = $commonDiscount->discount_ceiling;
                }
                // for check Minimum purchase limit
                if ($commonDiscount != null and $total_final_price >= $commonDiscount->minimal_order_amount) {
                    $finalPrice = $total_final_price - $commonPercentDiscount;
                } else {
                    $finalPrice = $total_final_price;
                }

                $order_total_product_discount_amount =
                    $commonPercentDiscount + $total_final_discount_price_with_number;

                Order::where([['user_id', $user->id], ['order_status', '=', 0]])->update(
                    ['common_discount_id' => $commonDiscount->id,
                        'order_final_amount' => $finalPrice + $delivery_amount,
                        'order_discount_amount' => $total_final_discount_price_with_number,
                        'order_common_discount_amount' => $commonPercentDiscount,
                        'order_total_products_discount_amount' => $order_total_product_discount_amount]);
            }

        }
        return redirect()->route('payment');
    }


    public function delete(Address $address)
    {
        try {
            $address->delete();
            session()->flash('success', __('messages.The_deletion_was_successful'));
            return redirect()->route('check.address');
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found')
                ->with(['error' => $ex->getMessage()]);
        }
    }

    //            $commonPercentDiscount = $total_final_price * ($commonDiscount->percentage / 100);
    //            if ($commonPercentDiscount > $commonDiscount->discount_ceiling) {
    //                $commonPercentDiscount = $commonDiscount->discount_ceiling;
    //            }
    //            if ($commonDiscount != null and $total_final_price >= $commonDiscount->minimal_order_amount) {
    //                $finalPrice = $total_final_price - $commonPercentDiscount;
    //            } else {
    //                $finalPrice = $total_final_price;
    //            }
    //            $order_total_product_discount_amount =
    //                $commonPercentDiscount + $total_final_discount_price_with_number;
    //            Order::updateOrCreate(
    //                ['user_id' => $user->id, 'order_status' => 0],
    //                ['user_id' => $user->id,
    //                    'address_id' => $request->address_id,
    //                    'delivery_id' => $request->delivery_id,
    //                    'common_discount_id' => $commonDiscount->id ?? null,
    //                    'order_final_amount' => $finalPrice ?? $total_final_price,
    //                    'order_discount_amount' => $total_final_discount_price_with_number,
    //                    'order_common_discount_amount' => $commonPercentDiscount,
    //                    'order_total_products_discount_amount' => $order_total_product_discount_amount ]
    //            );
}
