@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.order_details') }}
@endsection
@section('left_profile_content')

    <div class="profile-card">
        <div class="profile-card">
            <p class="font-13">جزئیات سفارش |<span class="order-code ms-1">{{ $order->order_number }}</span></p>

            <div class="row">
                <div class="col-md-6">

                    @if( $order->payment_type == 0 or $order->payment_type == 1)
                        <p class="font-13"> نام تحویل گیرنده
                            : {{ $order->user->first_name . ' ' . $order->user->last_name }}</p>
                    @elseif(  $order->payment_type == 2)
                        <p class="font-13"> نام تحویل گیرنده
                            : {{ $order->cashPayment->cash_receiver != null ? $order->cashPayment->cash_receiver :  $order->user->first_name . ' ' . $order->user->last_name  }}</p>
                    @endif


                    @if( $order->payment_type == 0 or $order->payment_type == 1)
                        <p class="font-13"> شماره تماس : {{ $order->user->mobile }}</p>
                    @elseif( $order->payment_type == 2 )
                        <p class="font-13 ">شماره تماس
                            : {{  $order->address->mobile != null ? $order->address->mobile : $order->user->mobile   }}</p>
                    @endif

                    @if( $order->address() != null)
                        <p class="font-13">آدرس : {{ $order->address->province->name }}
                            - {{ $order->address->city->name }} - {{ $order->address->address_description }}</p>
                    @else
                        <p class="font-13">آدرس : بدون آدرس</p>
                    @endif

                </div>
                <div class="col-md-6">
                    <p class="font-13"> نحوه ارسال : {{ $order->delivery->title }}</p>
                    <p class="font-13"> وضعیت : <span class="text-success">{{ $order->delivery_status_value }}</span>
                    </p>
                    <p class="font-13"> مبلغ کل مرسوله
                        : {{ priceFormat($order->order_final_amount) }} {{ __('messages.toman') }}</p>
                </div>
            </div>

            <div class="row mt-4">

                @if( count($order_items) > 0)
                    @foreach( $order_items as $item)
                        <div class="col-lg-3 col-6 mb-3">
                            <a href="#">
                                <div class="card custom-card">
                                    <img src="{{ asset('storage/' . $item->product->thumbnail_image) }}" alt="product-image - {{ $item->product->thumbnail_image }}" class="slider-pic">
                                    <div class="card-body">
                                        <a href="#" class="product-title">{{ $item->product->title_persian }}</a>
                                    </div>
                                    <div class="card-body">
                                        <p class="font-12"> تعداد : {{ $item->number }}</p>
                                        <p  class="font-12"> قیمت : {{ priceFormat($item->final_product_price) }} {{ __('messages.toman') }}</p>
                                        <p  class="font-12"> گارانتی : {{ $item->warranty != null ? $item->warranty->guarantee_name : 'بدون گارانتی' }}</p>
                                        <p  class="font-12"> رنگ : {{ $item->color != null ? $item->color->color_name : 'بدون رنگ' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-3 col-6 mb-3">
                        <p class="text-center"> {{ __('messages.product_not_found') }}</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

