<?php

namespace App\Http\Controllers\Front\Payment;

use App\Http\Controllers\Controller;
use App\Models\CartItems;
use App\Models\CashPayment;
use App\Models\Coupon;
use App\Models\OfflinePayment;
use App\Models\OnlinePayment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Services\Payment\PaymentServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //

    public function payment(Request $request)
    {
        $user = auth()->user()->id;
        $cartItems = CartItems::where('user_id', $user)->get();
        $order = Order::where('user_id', '=', $user)->where('order_status', '=', 0)->first();
        return view('front.payment.payment', ['cartItems' => $cartItems, 'order' => $order]);
    }

    public function couponDiscount(Request $request)
    {

        $request->validate([
            'code' => ['required'],
        ], $messages = [
            'code' => 'کد تخفیف الزامی است',
        ]);

        $coupon = Coupon::where([['code', '=', $request->code],
            ['status', '=', 1],
            ['end_date', '>', now()],
            ['start_date', '<', now()]])->first();

        //// check  coupon is exists or not
        if ($coupon == null) {
            session()->flash('error', __('messages.coupon_not_exists'));
            return redirect()->back();
        }

        //// check for coupon is belong to current user or not
        if ($coupon->user_id != null) {

            $coupon = Coupon::where([['code', '=', $request->code],
                ['status', '=', 1],
                ['end_date', '>', now()],
                ['start_date', '<', now()], ['user_id', '=', Auth::id()]])->first();

            if ($coupon == null) {
                session()->flash('error', __('messages.coupon_not_exists'));
                return redirect()->back();
            }
        }

        // This query says that there should not be an order with the current discount code.
        // If there is not, continue working.
        // If this order exists with this discount code, display a message to the user
        $order = Order::where('user_id', '=', Auth::id())
            ->where('order_status', '=', 0)
            ->where('coupon_id', '=', null)->first();

        $couponDiscountAmount = null;
        if ($order) {

            //// coupon type is percent
            if ($coupon->amount_type == 0) {

                $couponDiscountAmount = $order->order_final_amount * ($coupon->amount / 100);

                if ($couponDiscountAmount > $coupon->discount_ceiling) {
                    $couponDiscountAmount = $coupon->discount_ceiling;
                }
                //// coupon type is number
            } else {
                $couponDiscountAmount = $coupon->amount;
            }

            // for fill the current order
            $order_final_amount = $order->order_final_amount - $couponDiscountAmount;
            $final_discount = $order->order_total_products_discount_amount + $couponDiscountAmount;
            $order->update(
                ['coupon_id' => $coupon->id,
                    'order_final_amount' => $order_final_amount,
                    'order_coupon_discount_amount' => $couponDiscountAmount,
                    'order_total_products_discount_amount' => $final_discount]
            );
            session()->flash('success', __('messages.discount_coupon_applied'));
            return redirect()->back();
        } else {
            session()->flash('error', __('messages.the_discount_coupon_has_already_been_used'));
            return redirect()->back();
        }
    }

    public function paymentSubmit(Request $request, PaymentServices $paymentServices)
    {
        $request->validate([
            'paymentType' => 'required'
        ], $messages = [
            'paymentType.required' => 'نوع پرداخت را انتخاب کنید',
        ]);

        $user = auth()->user()->id;
        $order = Order::where('user_id', '=', $user)->where('order_status', '=', 0)->first();
        $cartItems = CartItems::where('user_id', $user)->get();
        $cash_receiver = null;

        // lv 1
        switch ($request->paymentType) {
            case '1':
                $targetModel = OnlinePayment::class;
                $paymentable = OnlinePayment::updateOrCreate(
                    ['user_id' => $user, 'order_id' => $order->id],
                    ['amount' => $order->order_final_amount,
                    'user_id' => $user,
                    'order_id' => $order->id,
                    'gateway' =>  __('messages.zarrinpal') ,
                    'transaction_id' => '',
                    'bank_first_response' => '',
                    'bank_second_response' => '',
                    'status' => 1
                ]);
                $type = 0;
                break;
            case '2' :
                $targetModel = OfflinePayment::class;
                $paymentable = OfflinePayment::updateOrCreate(
                    ['user_id' => $user, 'order_id' => $order->id],
                    ['amount' => $order->order_final_amount,
                    'user_id' => $user,
                    'order_id' => $order->id,
                    'pay_date' => now(),
                    'gateway' =>  __('messages.zarrinpal')  ,
                    'transaction_id' => '',
                    'bank_first_response' => '',
                    'status' => 1
                ]);
                $type = 1;
                break;
            case  '3':
                $targetModel = CashPayment::class;
                $paymentable = CashPayment::updateOrCreate(
                    ['user_id' => $user, 'order_id' => $order->id],
                    ['amount' => $order->order_final_amount,
                    'user_id' => $user,
                    'order_id' => $order->id,
                    'pay_date' => now(),
                    'cash_receiver' => $request->cash_receiver ? $request->cash_receiver : null,
                    'status' => 1
                ]);
                $type = 2;
                break;
            default :
                return redirect()->back()->withErrors(['error' => __('messages.An_error_occurred')]);
        }


        // lv2
         Payment::create([
            'user_id' => $user,
            'amount' => $order->order_final_amount,
            'pay_date' => now(),
            'type' => $type,
            'paymentable_id' => $paymentable->id,
            'paymentable_type' => $targetModel,
            'status' => 1,
        ]);


        // lv 3
        // send user to bank gateway for pay order
        if ($request->paymentType == 1) {

            session()->flash('warning',__('messages.internet_pay_is_being_prepared'));
            return redirect()->back();
            $paymentServices->zarinpal($order->order_final_amount, $order, $paymentable);

        }

        DB::transaction(function () use ($user, $request, $cartItems, $type, $order) {
            // lv 4
            if ($request->paymentType == 2) {

                $order->update(
                    ['order_status' => 2,
                        'payment_status' => 1,
                        'payment_type' => $type]
                );

            } elseif ($request->paymentType == 3) {

                $order->update(
                    ['order_status' => 2,
                        'payment_status' => 0,
                        'payment_type' => $type]
                );

            }
            // lv 5
            foreach ($cartItems as $cartItem) {

                // create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'user_id' => $user,
                    'product_id'=> $cartItem->product_id,
                    'amazing_sale_id' => $cartItem->product->activeAmazingSale()->id ?? null,
                    'amazing_sale_discount_amount' => empty( $cartItem->product->activeAmazingSale()) ? 0 :
                        $cartItem->cartItemProductPriceWithOutNumber() * (  $cartItem->product->activeAmazingSale()->precentage / 100),
                    'product_color_id' => $cartItem->product_color_id ,
                    'guarantee_id' => $cartItem->guarantee_id ,
                    'number' => $cartItem->number ,
                    'final_product_price' => empty( $cartItem->product->activeAmazingSale()) ? $cartItem->cartItemProductPriceWithOutNumber() :
                       ( $cartItem->cartItemProductPriceWithOutNumber() -
                         $cartItem->cartItemProductPriceWithOutNumber() * (  $cartItem->product->activeAmazingSale()->precentage / 100)),

                    'final_total_price' =>   empty( $cartItem->product->activeAmazingSale()) ? $cartItem->cartItemProductPriceWithOutNumber() * ($cartItem->number) :
                        ( $cartItem->cartItemProductPriceWithOutNumber() -
                            $cartItem->cartItemProductPriceWithOutNumber() * (  $cartItem->product->activeAmazingSale()->precentage / 100))  * ($cartItem->number),
                ]);

                // increase number of products from stock product
                // and stock color product
                if( $cartItem->product_color_id != null )
                {
                    $cartItem->color()->decrement('available_in_stock',$cartItem->number);
                    DB::table('products')->where('id',$cartItem->product_id)
                        ->decrement('available_in_stock',$cartItem->number);

                }elseif ($cartItem->product_color_id == null){
                    DB::table('products')->where('id',$cartItem->product_id)
                        ->decrement('available_in_stock',$cartItem->number);
                }
                $cartItem->delete();
            }
        }, 1);


        session()->flash('success', __('messages.your_order_has_been_successfully_placed'));
        return redirect()->route('payment.result', ['orderNumber' => $order->order_number]);
    }

    // lv.2
    public function paymentCallback(Order $order, OnlinePayment $onlinePayment, PaymentServices $paymentServices)
    {

        $user = auth()->user()->id;
        $amount = $onlinePayment->amount * 10;
        $result = $paymentServices->zarinpalVerify($amount, $onlinePayment);
        $cartItems = CartItems::where('user_id', $user )->get();


        if ($result['success']) {


            DB::transaction(function () use ($user, $order, $cartItems) {

                foreach ($cartItems as $cartItem) {

                    // create order item
                    OrderItem::create([
                        'order_id' => $order->id,
                        'user_id' => $user,
                        'product_id'=> $cartItem->product_id,
                        'amazing_sale_id' => $cartItem->product->activeAmazingSale()->id ?? null,
                        'amazing_sale_discount_amount' => empty( $cartItem->product->activeAmazingSale()) ? 0 :
                            $cartItem->cartItemProductPriceWithOutNumber() * (  $cartItem->product->activeAmazingSale()->precentage / 100),
                        'product_color_id' => $cartItem->product_color_id ,
                        'guarantee_id' => $cartItem->guarantee_id ,
                        'number' => $cartItem->number ,
                        'final_product_price' => empty( $cartItem->product->activeAmazingSale()) ? $cartItem->cartItemProductPriceWithOutNumber() :
                            ( $cartItem->cartItemProductPriceWithOutNumber() -
                                $cartItem->cartItemProductPriceWithOutNumber() * (  $cartItem->product->activeAmazingSale()->precentage / 100)),

                        'final_total_price' =>   empty( $cartItem->product->activeAmazingSale()) ? $cartItem->cartItemProductPriceWithOutNumber() * ($cartItem->number) :
                              ( $cartItem->cartItemProductPriceWithOutNumber() -
                                $cartItem->cartItemProductPriceWithOutNumber() * (  $cartItem->product->activeAmazingSale()->precentage / 100))  * ($cartItem->number),
                    ]);
                    // increase number of products from stock product
                    // and stock color product
                    if( $cartItem->product_color_id != null )
                    {
                        $cartItem->color()->decrement('available_in_stock',$cartItem->number);
                        DB::table('products')->where('id',$cartItem->product_id)
                            ->decrement('available_in_stock',$cartItem->number);

                    }elseif ($cartItem->product_color_id == null){
                        DB::table('products')->where('id',$cartItem->product_id)
                            ->decrement('available_in_stock',$cartItem->number);
                    }

                    $cartItem->delete();
                }

                $order->update(
                    ['order_status' => 2,
                        'payment_status' => 1,
                        'payment_type' => 0]
                );

            }, 1);


            $order = Order::where('user_id',$user)
                ->where('order_status', 2)
                ->where('order_number', $order->order_number)->first();

            session()->flash('success', __('messages.payment_successfully'));
            return redirect()->route('payment.result', ['orderNumber' => $order->order_numer]);

        } else {

            foreach ($cartItems as $cartItem) {

                // create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'user_id' => $user,
                    'product_id'=> $cartItem->product_id,
                    'amazing_sale_id' => $cartItem->product->activeAmazingSale()->id ?? null,
                    'amazing_sale_discount_amount' => empty( $cartItem->product->activeAmazingSale()) ? 0 :
                        $cartItem->cartItemProductPriceWithOutNumber() * (  $cartItem->product->activeAmazingSale()->precentage / 100),
                    'product_color_id' => $cartItem->product_color_id ,
                    'guarantee_id' => $cartItem->guarantee_id ,
                    'number' => $cartItem->number ,
                    'final_product_price' => empty( $cartItem->product->activeAmazingSale()) ? $cartItem->cartItemProductPriceWithOutNumber() :
                        ( $cartItem->cartItemProductPriceWithOutNumber() -
                            $cartItem->cartItemProductPriceWithOutNumber() * (  $cartItem->product->activeAmazingSale()->precentage / 100)),

                    'final_total_price' =>   empty( $cartItem->product->activeAmazingSale()) ? $cartItem->cartItemProductPriceWithOutNumber()  * ($cartItem->number) :
                           ( $cartItem->cartItemProductPriceWithOutNumber() -
                            $cartItem->cartItemProductPriceWithOutNumber() * (  $cartItem->product->activeAmazingSale()->precentage / 100))  * ($cartItem->number),
                ]);
                // increase number of products from stock product
                // and stock color product

                $cartItem->delete();
            }

            $order->update(
                ['order_status' => 1,
                    'payment_status' => 0,
                    'payment_type' => 0]
            );

            $order = Order::where('user_id', $user )
                ->where('order_status', 1)
                ->where('order_number', $order->order_number)->first();

            session()->flash('error', __('messages.payment_failed'));
            return redirect()->route('payment.result', ['orderNumber' => $order->order_numer]);
        }

    }


    public function paymentResult(Request $request, $orderNumber)
    {
        if( $orderNumber != null ){
            $order = Order::where('user_id', Auth::id())->where('order_number', $orderNumber)->first();
            return view('front.payment.payment_result', ['order' => $order]);
        }
        return redirect()->route('home');


    }
}
