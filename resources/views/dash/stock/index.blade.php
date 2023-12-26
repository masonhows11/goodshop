@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.stock_management') }}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.product.stock.list') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        {{--<div class="row my-4 bg-white">
            <div class="col-lg-2 col-md-2 col-2 my-2">
                <a href="#" class="btn btn-sm btn-primary">{{ __('messages.new_stock') }}</a>
            </div>
        </div>--}}
        <div class="row product-stock-list bg-white">
            <div class=" my-5">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.name_persian') }}</th>
                        <th>{{ __('messages.thumbnail_image') }}</th>
                        <th>{{ __('messages.available_in_stock') }}</th>
                        <th>{{ __('messages.number_sold') }}</th>
                        <th>{{ __('messages.frozen_number') }}</th>
                        <th>{{ __('messages.salable_quantity') }}</th>
                        <th>{{ __('messages.operation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr class="text-center">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title_persian }}</td>
                        <td><img class="img-thumbnail" width="100" height="100" src="{{ $product->thumbnail_image ? asset('storage/'.$product->thumbnail_image) : asset('dash/images/no-image-icon-23494.png') }}" alt=""></td>
                        <td>{{ $product->available_in_stock }}</td>
                        <td>{{ $product->number_sold }}</td>
                        <td>{{ $product->frozen_number }}</td>
                        <td>{{ $product->salable_quantity }}</td>
                        <td>
                            <a href="{{ route('admin.add_to_stock.form',['product'=>$product->id]) }}" class="btn btn-sm btn-success">افزایش موجودی</a>
                            <a href="{{ route('admin.modify_stock.form',['product'=>$product->id]) }}" class="btn btn-sm btn-info me-2">اصلاح موجودی</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center list-stock-paginate">
            <div class="col-lg-2 col-md-2 ">
                {{ $products->links() }}
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
