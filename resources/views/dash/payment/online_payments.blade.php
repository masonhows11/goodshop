@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.online_payments') }}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.online.payments') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid bg-white">

        <div class="row d-flex justify-content-start my-4">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4 text-center">
                    <h3> {{ __('messages.online_payments') }}</h3>
                </div>
            </div>
        </div>
        <div class="row product-stock-list ">
            <div class=" my-5">
                <table class="table table-striped">
                    <thead>
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.user_name') }}</th>
                        <th>{{ __('messages.amount') }}</th>
                        <th>{{ __('messages.transaction_code') }}</th>
                        <th>{{ __('messages.payment_gateway') }}</th>
                        <th>{{ __('messages.payment_status') }}</th>
                        <th>{{ __('messages.payment_type') }}</th>
                      {{--  <th>{{ __('messages.operation') }}</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr class="text-center">
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->user->name }}</td>
                            <td>{{ number_format( $payment->amount)  }}</td>
                            <td>{{ $payment->paymentable->transaction_id ?? '-' }}</td>
                            <td>{{ $payment->paymentable->gateway ?? '-' }}</td>
                            <td> @if( $payment->status == 0 ) {{ __('messages.unpaid')}} @elseif ( $payment->status == 1 ) {{ __('messages.paid') }} @elseif ( $payment->status == 2 )  {{ __('messages.pay_canceled') }} @else {{ __('messages.pay_returned') }} @endif</td>
                            <td> @if( $payment->type == 0 ) {{ __('messages.online_pay')}} @elseif( $payment->type == 1 ) {{ __('messages.offline_pay') }} @else {{ __('messages.cash_pay') }} @endif  </td>
                           {{-- <td>
                                <a href="#" class="btn btn-sm btn-success"></a>
                                <a href="#" class="btn btn-sm btn-warning me-2"></a>
                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center list-stock-paginate">
            <div class="col-lg-2 col-md-2 ">
                {{ $payments->links() }}
            </div>
        </div>

    </div>
@endsection



