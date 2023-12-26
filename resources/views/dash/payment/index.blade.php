@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.all_payments') }}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.all.payments') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid bg-white">

        <div class="row d-flex justify-content-start my-4">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.all_payments') }}</h3>
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
                        <th>{{ __('messages.operation') }}</th>
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
                            <td>
                                <a href="{{ route('admin.payment.canceled',$payment->id) }}" class="btn btn-sm btn-danger">{{ __('messages.cancel_trans') }}</a>
                                <a href="{{ route('admin.payment.returned',$payment->id) }}" class="btn btn-sm btn-secondary ms-2">{{ __('messages.return_trans') }}</a>
                                <a href="{{ route('admin.payment.show',$payment->id) }}" class="btn btn-sm btn-info ms-2">{{ __('messages.show') }}</a>
                            </td>
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

