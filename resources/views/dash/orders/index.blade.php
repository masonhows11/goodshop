@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ $page_title == null ? 'test' : $page_title  }}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render($breadcrumbs == null ? 'admin.orders.index' : $breadcrumbs ) }}
@endsection
@section('dash_main_content')

    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ $body_title == null ? 'test' : $body_title }}</h3>
                </div>
            </div>
        </div>

        <div class="row  order-list bg-white">
            <div class=" my-5">
                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.order_final_amount') }}</th>
                        <th>{{ __('messages.order_discount_amount') }}</th>
                        <th>{{ __('messages.order_total_products_discount_amount') }}</th>
                        <td>{{ __('messages.final_amount') }}</td>
                        <th>{{ __('messages.payment_status') }}</th>
                        <th>{{ __('messages.payment_type') }}</th>
                        <th>{{ __('messages.payment_gateway') }}</th>
                        <th>{{ __('messages.delivery_status') }}</th>
                        <th>{{ __('messages.shipment_type') }}</th>
                        <th>{{ __('messages.order_status') }}</th>
                      {{--  <th>{{ __('messages.operation') }}</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="text-center">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_final_amount }}</td>
                            <td>{{ $order->order_discount_amount }}</td>
                            <td>{{ $order->order_total_products_discount_amount   }}</td>
                            <td>{{ $order->order_final_amount - $order->order_discount_amount }}</td>


                          {{--  <td> @if ( $order->payment_status == 0) {{ __('messages.unpaid') }}
                                @elseif( $order->payment_status == 1 ) {{ __('messages.paid') }}
                                @elseif($order->payment_status == 2) {{ __('messages.pay_canceled') }}
                                @elseif ( $order->payment_status == 3) {{ __('messages.pay_returned') }} @endif </td>--}}
                            <td>{{ $order->payment_status_value }}</td>

                           {{-- <td> @if ( $order->payment_type == 0) {{ __('messages.online_pay') }}
                                @elseif ( $order->payment_type == 1 ) {{ __('messages.offline_pay') }}
                                @else {{ __('messages.payment_on_the_spot') }} @endif </td>--}}
                            <td>{{ $order->payment_type_value }}</td>

                            <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>

                            {{--<td> @if ( $order->delivery_status == 0) {{ __('messages.order_not_sent') }}
                                @elseif( $order->delivery_status == 1 ) {{ __('messages.order_sending') }}
                                @elseif( $order->delivery_status == 2) {{ __('messages.order_sent') }}
                                @elseif( $order->delivery_status == 3) {{ __('messages.order_delivered') }} @endif </td>--}}
                            <td>{{ $order->delivery_status_value }}</td>

                            <td>{{ $order->delivery->name }}</td>

                          {{--  <td> @if ( $order->order_status == 0)  {{ __('messages.order_not_checked') }}
                                @elseif( $order->order_status == 1 ) {{ __('messages.order_wait_for_confirmed') }}
                                @elseif( $order->order_status == 2 ) {{ __('messages.order_not_confirmed') }}
                                @elseif( $order->order_status == 3 ) {{ __('messages.order_confirmed') }}
                                @elseif( $order->order_status == 4 ) {{ __('messages.order_canceled') }}
                                @elseif( $order->order_status == 5 ) {{ __('messages.order_returned') }}
                                @endif</td>--}}
                            <td>{{ $order->order_status_value }}</td>

                          {{--  <td>
                                <a href="#"  class="btn btn-sm btn-success">{{ __('messages.display_factor')  }}</a>
                                <a href="#" class="btn btn-sm btn-info">{{ __('messages.change_shipment_status') }}</a>
                                <a href="#" class="btn btn-sm btn-info ms-2">{{ __('messages.change_order_status') }}</a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger ms-2">{{ __('messages.cancel_order') }}</a>
                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center list-stock-paginate">
            <div class="col-lg-2 col-md-2 ">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

@endsection
@push('dash_custom_script')
    <script type="text/javascript">
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
            });
        })
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        window.addEventListener('show-result', ({detail: {type, message}}) => {
            Toast.fire({
                icon: type,
                title: message
            })
        })
        @if( session()->has('warning') )
        Toast.fire({
            icon: 'warning',
            title: '{{ session()->get('warning') }}'
        })
        @elseif( session()->has('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
        @endif
    </script>
@endpush


