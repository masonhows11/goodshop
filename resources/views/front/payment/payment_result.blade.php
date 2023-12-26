@extends('front.layouts.master_payment')
@section('page_title')
    {{ __('messages.payment_status') }}
@endsection
@section('checkout-step')
    <div class="col-12">
        <ul class="checkout-steps">
            @php
                $currentRoute = 'payment.result';
            @endphp
            <li class="is-completed-extra">
                <a href="#" class="checkout-steps-active  active-link-shopping">اطلاعات ارسال</a>
            </li>
            <li class="is-completed-extra">
                <a href="#" class="checkout-steps-active active-link-shopping">پرداخت</a>
            </li>
            <li class="is-active">
                @if( $currentRoute == request()->route()->getName() )
                    <a href="#" class="checkout-steps-active  active-link-shopping">اتمام خرید و ارسال</a>
                @endif
            </li>
        </ul>
    </div
@endsection
@section('main_content')
    <div class="container">

        <div class="row mt-3">

            <div class="col-lg-12 customer-info">

                <div class="cart-content">

                    <div class="order-check">
                        @if( $order->order_status == 1)
                            <i class="fa fa-multiply icon-failed"></i>
                        @elseif( $order->order_status == 2)
                            <i class="fa fa-check icon-success"></i>
                        @endif

                        @if( $order->order_status == 2 )
                            <p class="font-13 mt-4">سفارش <span class="order-code">{{ $order->order_number }}</span> با
                                موفقیت در سیستم ثبت شد. </p>
                            <p class="font-13 line-height">پرداخت با موفقیت انجام شد. سفارش شما در زمان تعیین شده برای
                                شما
                                ارسال خواهد شد.
                                از اینکه خرید خوب را برای خرید انتخاب کردید از شما سپاسگزاریم.
                            </p>
                        @elseif( $order->order_status == 1)
                            <p class="font-13 mt-4">سفارش <span class="order-code">{{ $order->order_number }}</span> در
                                سیستم ثبت نشد. </p>
                            <p class="font-13 line-height">پرداخت با موفقیت انجام نشد. کاربر گرامی لطفا مراحل پرداخت
                                دوباره انجام دهید
                                از اینکه خرید خوب را برای خرید انتخاب کردید از شما سپاسگزاریم.
                            </p>
                        @endif
                    </div>

                    @if( $order->order_status == 2 )
                        <div class="row">
                            <div class="col-lg-9 col-md-8 col-sm-6">
                                <p class="font-14"> کد سفارش : {{ $order->order_number }}</p>
                                <p class="font-13 line-height"> سفارش شما با موفقیت در سیستم ثبت شد و هم اکنون <span
                                        class="order-code">در حال پردازش</span> است.جزئیات این سفارش را می توانید با
                                    کلیک بر
                                    روی دکمه <a href="#" class="text-info">پیگیری سفارش</a> مشاهده نمایید. </p>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <a href="{{ route('all.orders') }}"
                                   class="btn btn-danger d-block font-13 mx-auto my-3 order-btn">پیگیری سفارش</a>
                            </div>
                        </div>
                    @endif

                    @if( $order->order_status == 2 )
                        <div class="row mt-3 mx-1">
                                    @if( $order->payment_type == 0 or $order->payment_type == 1)
                                        <div class="col-6  bg-light"><p class="font-13 mt-3"> نام تحویل گیرنده : {{ $order->user->first_name . ' ' . $order->user->last_name }}</p></div>
                                    @elseif( $order->payment_type == 2)
                                         <div class="col-6  bg-light"><p class="font-13 mt-3"> نام تحویل گیرنده : {{ $order->cashPayment->cash_receiver != null ? $order->cashPayment->cash_receiver :  $order->user->first_name . ' ' . $order->user->last_name }}</p></div>
                                    @endif


                                    @if( $order->payment_type == 0 or $order->payment_type == 1)
                                        <div class="col-6  bg-light"><p class="font-13 mt-3"> شماره تماس : {{ $order->user->mobile }}</p></div>
                                    @elseif( $order->payment_type == 2 )
                                            <div class="col-6  bg-light"><p class="font-13 mt-3">شماره تماس : {{  $order->address->mobile != null ? $order->address->mobile : $order->user->mobile   }}</p></div>
                                    @endif

                                    <div class="col-6 "><p class="font-13 mt-3">تعداد مرسوله : 1</p></div>
                                    <div class="col-6"><p class="font-13 mt-3">مبلغ کل : {{ priceFormat($order->order_final_amount) }} {{ __('messages.toman') }} </p></div>

                                    @if( $order->payment_type == 0 )
                                        <div class="col-6  bg-light"><p class="font-13 mt-3"> وضعیت پرداخت : {{ __('messages.online_pay') }} </p></div>
                                    @elseif( $order->payment_type == 1)
                                        <div class="col-6  bg-light"><p class="font-13 mt-3"> وضعیت پرداخت :{{ __('messages.offline_pay') }} </p></div>
                                    @elseif( $order->payment_type == 2 )
                                        <div class="col-6  bg-light"><p class="font-13 mt-3"> وضعیت پرداخت : {{ __('messages.cash_pay') }} </p></div>
                                    @endif

                            <div class="col-6  bg-light"><p class="font-13 mt-3">وضعیت سفارش : در حال انجام</p></div>
                        </div>
                        <div class="row">
                            <div class="col ms-2">
                                <p class="font-13 mt-3">آدرس : {{ $order->address->province->name }}- {{ $order->address->city->name }} - {{ $order->address->address_description }}</p>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
