@extends('front.layouts.master_payment')
@section('page_title')
    {{ __('messages.payment') }}
@endsection
@section('checkout-step')
    <div class="col-12">
        <ul class="checkout-steps">
            @php
                $currentRoute = 'payment';
            @endphp
            <li class="is-completed-extra">
                <a href="#" class="checkout-steps-active  active-link-shopping">اطلاعات ارسال</a>
            </li>
            <li class="is-completed">
                @if( $currentRoute == request()->route()->getName() )
                    <a href="#" class="checkout-steps-active active-link-shopping">پرداخت</a>
                @else
                    <a href="#" class="checkout-steps-item  active-link">پرداخت</a>
                @endif
            </li>
            <li class="is-active">
                <a href="#" class="checkout-steps-item  active-link">اتمام خرید و ارسال</a>
            </li>
        </ul>
    </div
@endsection
@section('main_content')
    <div class="container">

        <div class="row">
            <main>
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-lg-9 customer-info">


                            <div class="cart-content">
                                <form action="{{ route('payment.submit') }}" id="payment-submit" method="post">
                                    @csrf

                                    <p class="font-14"> انتخاب شیوه پرداخت</p>

                                    <div class="row content-wrapper">
                                        <div class="col-10">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="radio1" value="1" name="paymentType">
                                                <i class="fa fa-credit-card font-20 align-middle text-muted"></i>
                                                <p class="font-12 d-inline-block ms-2"> پرداخت اینترنتی ( آنلاین با تمامی کارت‌های بانکی ) </p>
                                                <label class="form-check-label" for="radio1"></label>
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex align-items-center justify-content-end">
                                            <img src="{{ asset('front/images/dpay.png') }}" class="dpay">
                                        </div>
                                    </div>

                                    <div class="row mt-4 content-wrapper">
                                        <div class="col-10">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="radio2" value="2" name="paymentType">
                                                <i class="fa fa-credit-card font-20 align-middle text-muted"></i>
                                                <p class="font-12 d-inline-block ms-2"> افزایش اعتبار و پرداخت از کیف پول </p>
                                                <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex align-items-center justify-content-end">
                                            <img src="{{ asset('front/images/dpay.png') }}" class="dpay">
                                        </div>
                                    </div>

                                    <div class="row mt-4 content-wrapper">
                                        <div class="col-10 content-wrapper-pay-on-spot">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="payment-on-spot" value="3" name="paymentType">
                                                <i class="fa fa-credit-card font-20 align-middle text-muted"></i>
                                                <p class="font-12 d-inline-block ms-2"> پرداخت در محل</p>
                                                <label class="form-check-label" for="payment-on-spot"></label>
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex align-items-center justify-content-end">
                                            <img src="{{ asset('front/images/dpay.png') }}" class="dpay">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10">
                                            @error('paymentType')
                                            <div class="text-danger mt-2 ms-3 font-13">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                </form>
                            </div>

                            <div class="cart-content">
                                <p class="font-14"> کد تخفیف {{ __('messages.site_name') }}</p>
                                <form action="{{ route('coupon-discount') }}" method="post">
                                    @csrf
                                    <div class="row px-2">
                                        <div class="col">
                                            <input type="text" name="code" id="code" class="form-control" placeholder="کد تخفیف را وارد کنید">
                                            @error('code')
                                            <div class="alert alert-danger font-12 mt-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <input type="submit" value="اعمال کد" class="btn btn-info font-13">
                                        </div>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-between mt-5">
                                    <a href="{{ route('check.address') }}" class="text-info font-12"><i class="fa fa-arrow-right align-middle me-1"></i>بازگشت به مرحله قبل</a>
                                    <a href="#" class="text-info font-12">تایید و ادامه ثبت سفارش <i class="fa fa-arrow-left align-middle ms-1"></i></a>
                                </div>
                            </div>
                        </div>

                        @php
                            $totalProductPrice = 0;
                            $totalDiscount = 0;
                        @endphp
                        @if( count($cartItems) > 0)
                            @foreach( $cartItems as $cartItem )
                                @php
                                    $totalProductPrice += $cartItem->cartItemProductPriceWithOutNumber() * $cartItem->number;
                                    $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->number;
                                @endphp
                            @endforeach
                            <div class="col-lg-3">
                                <div class="cart-content">
                                    <div class="product-seller-row">
                                        <span>{{ __('messages.seller') }}</span>
                                        <span>{{ __('messages.good_shopping_online_store') }}</span>
                                    </div>
                                    @php
                                        $cartItemsCount = null;
                                         foreach( $cartItems as $item )
                                          {
                                              $cartItemsCount += $item->number;
                                          }
                                    @endphp
                                    <div class="product-seller-row">
                                        <span>{{ __('messages.quantity') }}</span>
                                        <span> {{ $cartItemsCount }} عدد </span>
                                    </div>
                                    <div class="product-seller-row">
                                        <span>{{ __('messages.total_price') }}  </span>
                                        <span class="text-danger"> {{ priceFormat($totalProductPrice) }} {{ __('messages.toman') }} </span>
                                    </div>

                                    @if( $totalDiscount != 0)
                                        <div class="product-seller-row">
                                            <span>{{ __('messages.order_discount_amazing_amount') }}  </span>
                                            <span class="text-danger">{{  priceFormat($totalDiscount ) }} {{ __('messages.toman') }}</span>
                                        </div>
                                    @endif

                                    @if( $order->commonDiscount != null)
                                        <div class="product-seller-row">
                                            <span>{{ __('messages.common_discount_amount') }}  </span>
                                            <span class="text-danger">{{  priceFormat($order->commonDiscount->percentage ) }}  {{ __('messages.percentage') }}</span>
                                        </div>
                                    @endif
                                    @if( $order->coupon != null)
                                        <div class="product-seller-row">
                                            <span>{{ __('messages.coupon_discount_amount') }}  </span>
                                            @if(  $order->coupon->amount_type == 0)
                                                <span class="text-danger">{{  $order->coupon->amount }}  {{ __('messages.percentage') }}</span>
                                            @else
                                                <span class="text-danger">{{  priceFormat($order->coupon->amount ) }}  {{ __('messages.toman') }}</span>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="product-seller-row">
                                        <span>{{ __('messages.final_price_cart_with_discount') }}</span>
                                        <span class="text-danger"> {{ priceFormat( $order->order_final_amount - $order->delivery->amount   ) }} {{ __('messages.toman') }}</span>
                                    </div>

                                    @if( $order->delivery != null)
                                        <div class="product-seller-row">
                                            <span>{{ __('messages.delivery_amount') }}</span>
                                            <span class="text-danger">{{ priceFormat($order->delivery->amount) }} {{ __('messages.toman') }}</span>
                                        </div>
                                    @endif

                                    <div class="product-seller-row">
                                        <span>{{ __('messages.the_amount_payable') }}</span>
                                        <span class="text-danger"> {{ priceFormat( $order->order_final_amount   ) }} {{ __('messages.toman') }}</span>
                                    </div>

                                    <button type="button" onclick="document.getElementById('payment-submit').submit();" class="btn btn-danger add-cart-btn">ادامه پرداخت
                                    </button>
                                    <p class="font-12 text-muted mt-3 line-height text-center">
                                        {{ __('messages.register_the_goods_in_your_basket_are_not_reserved_complete_the_next_steps_to_place_an_order') }}
                                    </p>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </main>


        </div>
    </div>
@endsection
@push('custom_scripts')
    <script>
        $(document).ready(function () {

          $('#payment-on-spot').click(function () {

              var newDiv = document.createElement('div');
              newDiv.innerHTML = `
              <div class="mb-3">
                <input type="text" name="cash_receiver" class="form-control" id="cash_receiver" form="payment-submit" placeholder="{{ __('messages.full_name_receiver') }}">
              </div> `;
                document.getElementsByClassName('content-wrapper-pay-on-spot')[0].appendChild(newDiv);

          })


        })

    </script>
@endpush
