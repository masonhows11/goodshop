@extends( 'dash.include.master_dash')
@section( 'dash_page_title')
    {{ __('messages.order_factor') }}
@endsection
@section( 'breadcrumb')
     {{ Breadcrumbs::render('admin.order.factor',$order->id) }}
@endsection
@section( 'dash_main_content')
    <div class="container-fluid">


        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <a class="btn btn-sm btn-primary"
                       href="{{ route('admin.orders.index') }}">{{ __('messages.all_orders') }}</a>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.order_factor') }}</h3>
                </div>
            </div>
        </div>



        <div class="row  show-order bg-white" id="printable-section">
            <div class="my-5 d-flex flex-column">

                <div>
                    <h3 class="h3">{{ __('messages.order_specification') }}</h3>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 alert alert-primary">

                    <div>
                        <p class="my-2 h4">{{ __('messages.id') }} : {{ $order->id }}</p>
                    </div>

                    <div>
                        <a href="javascript:void(0)" class="btn btn-dark btn-sm text-white" id="print">
                            <i class="fas fa-print"></i>
                            {{ __('messages.print') }}
                        </a>
                        <a href="{{ route('admin.order.details',$order->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-book"></i>
                            {{ __('messages.details') }}
                        </a>
                    </div>

                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.customer_name') }}</h4>
                    </div>

                    <div>
                        <div class="h6 me-4">{{ $order->user->first_name . ' ' . $order->user->last_name ?? '-' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.customer_address') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">{{ $order->address->address_description ?? '-' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.recipient_first_name') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">{{ $order->address->recipient_first_name ?? '-' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.recipient_last_name') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">{{ $order->address->recipient_last_name ?? '-' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.recipient_mobile') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">{{ $order->address->mobile ?? '-' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.province') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">{{ $order->address->province->name ?? '-' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.city') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">{{ $order->address->city->name ?? '-' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.post_code') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">{{ $order->address->post_code ?? '-' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.plate_number') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">{{ $order->address->plate_number ?? '-' }}</div>
                    </div>
                </div>


                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.payment_type') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            @if ($order->payment_type == 0)
                                {{ __('messages.online_pay') }}
                            @elseif ($order->payment_type == 1)
                                {{ __('messages.offline_pay') }}
                            @else
                                {{ __('messages.payment_on_the_spot') }}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.payment_status') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            @if ($order->payment_status == 0)
                                {{ __('messages.unpaid') }}
                            @elseif($order->payment_status == 1)
                                {{ __('messages.paid') }}
                            @elseif($order->payment_status == 2)
                                {{ __('messages.pay_canceled') }}
                            @elseif ($order->payment_status == 3)
                                {{ __('messages.pay_returned') }}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.delivery_amount') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ number_format(floatval($order->delivery_amount)) . ' ' . __('messages.toman') }} </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.delivery_status') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            @if ($order->delivery_status == 0)
                                {{ __('messages.order_not_sent') }}
                            @elseif($order->delivery_status == 1)
                                {{ __('messages.order_sending') }}
                            @elseif($order->delivery_status == 2)
                                {{ __('messages.order_sent') }}
                            @elseif($order->delivery_status == 3)
                                {{ __('messages.order_delivered') }}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.delivery_date') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ jdate($order->delivery_date)->format('%B %d، %Y') }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.order_final_amount') }}</h4>
                    </div>

                    <div>
                        <div class="h6 me-4">
                            {{ number_format(floatval($order->order_final_amount)) . ' ' . __('messages.toman') }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.order_discount_amount') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ number_format(floatval($order->order_discount_amount)) . ' ' . __('messages.toman') }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.order_total_products_discount_amount') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ number_format(floatval($order->order_total_products_discount_amount)) . ' ' . __('messages.toman') }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.final_amount') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ number_format(floatval($order->order_final_amount - $order->order_discount_amount)) . ' ' . __('messages.toman') }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.payment_gateway') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ $order->payment->paymentable->gateway ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.coupon_code') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ $order->coupon->code ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.coupon_amount') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ number_format(floatval($order->order_coupon_discount_amount)) . ' ' . __('messages.toman') ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.common_discount') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ $order->commonDiscount->title ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2 bg-secondary py-4">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.order_common_discount_amount') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            {{ number_format(floatval($order->order_common_discount_amount)) . ' ' . __('messages.toman') ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div>
                        <h4 class="h5 ms-4"> {{ __('messages.order_status') }}</h4>
                    </div>
                    <div>
                        <div class="h6 me-4">
                            @if ($order->order_status == 0)
                                {{ __('messages.order_not_checked') }}
                            @elseif($order->order_status == 1)
                                {{ __('messages.order_wait_for_confirmed') }}
                            @elseif($order->order_status == 2)
                                {{ __('messages.order_not_confirmed') }}
                            @elseif($order->order_status == 3)
                                {{ __('messages.order_confirmed') }}
                            @elseif($order->order_status == 4)
                                {{ __('messages.order_canceled') }}
                            @elseif($order->order_status == 5)
                                {{ __('messages.order_returned') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@push('dash_custom_script')
    <script>
        $(document).ready(function () {

            let printBtn = document.getElementById('print');
            printBtn.addEventListener('click', function () {

                printContent('printable-section');

            });

            function printContent(el) {
                var restorePage = $('body').html();
                var printContent = $('#' + el).clone();
                $('body').empty().html(printContent);
                window.print();
                $('body').html(restorePage);
            }

        })
    </script>
@endpush
