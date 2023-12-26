@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.all_payments') }}
@endsection

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.show.payment',$payment->paymentable->transaction_id) }}
@endsection

@section('dash_main_content')
    <div class="container-fluid payment-single-section">

        <div class="row  my-3">
            <div class="col-lg-3 col-md-3 col title-payment">
                <div class="alert bg-white text-center h3">
                    {{ __('messages.show_payment') }}
                </div>
            </div>
        </div>
        <div class="row d-flex flex-column my-2  payment-wrapper bg-white">

            <div class="col comment-body-section">
                <div class="card  mt-4 mb-4 border border-2 border-secondary">
                    <div class="card-header d-flex align-items-center bg-secondary">
                        <p class="h5"> پرداخت کننده : {{ $payment->user->first_name }} {{ $payment->user->last_name }}  </p>
                    </div>
                    <div class="card-body">
                        <p class="card-text"> شماره تراکنش : {{ $payment->paymentable->transaction_id }}  </p>
                        <p class="card-text"> مبلغ تراکنش : {{ number_format($payment->paymentable->amount) }} تومان </p>
                        <p class="card-text"> تاریخ تراکنش : {{ $payment->paymentable->pay_date ? jdate($payment->paymentable->pay_date)->format('%B %d، %Y')  : __('messages.no_pay_date')   }}  </p>
                        <p class="card-text"> درگاه پرداخت : {{ $payment->paymentable->gateway ?? __('messages.no_gateway') }}  </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.payments.all.index')  }}" class="btn btn-secondary btn-sm">{{ __('messages.all_payments') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
