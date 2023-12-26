@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.amazing_sale_edit') }}
@endsection
@push('dash_custom_style')
    <link rel="stylesheet" href="{{ asset('dash/plugins/jalalidatepicker/dist/css/persian-datepicker.min.css') }}">
@endpush
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.amazing.sale.edit') }}
@endsection

@section('dash_main_content')

    <div class="container-fluid">


        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.amazing.sale.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.amazing_sales_list') }}</a>
            </div>
        </div>


        <form action="{{ route('admin.amazing.sale.update') }}" method="post">
            @csrf
            <input type="hidden" name="amazing_sale_id" value="{{ $sale->id }}">

            <div class="row product-stock-list my-5 py-5 bg-white">
                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="product" class="form-label">{{ __('messages.product_name') }}</label>
                        <select  class="form-control" id="product" name="product">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id === $sale->product_id ? 'selected' : '' }} > {{ $product->title_persian }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('product')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- percentage --}}
                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="percentage" class="form-label">{{ __('messages.percentage_discount') }}</label>
                        <input type="text" class="form-control" id="percentage" name="percentage"
                               value="{{ $sale->percentage }}">
                    </div>
                    @error('percentage')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                {{--  start date  --}}
                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="start_date" class="form-label">{{ __('messages.start_date') }}</label>
                        <input type="text" class="form-control d-none" id="start_date" name="start_date" >
                        <input type="text" id="start_date_view"  class="form-control form-check-sm" value="{{ $sale->start_date }}">
                    </div>
                    @error('start_date')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{--  end date  --}}
                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="end_date" class="form-label">{{ __('messages.end_date') }}</label>
                        <input type="text" class="form-control d-none" id="end_date" name="end_date" >
                        <input type="text" id="end_date_view" class="form-control form-check-sm" value="{{ $sale->end_date }}">
                    </div>
                    @error('end_date')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                {{--  status  --}}
                <div class="col-12">
                    <div class="mt-3">
                        <label for="status" class="form-label">{{ __('messages.status') }}</label>
                        <select  class="form-control" id="status" name="status">
                            <option value="0" {{ $sale->status == 0 ? 'selected' : '' }} >{{ __('messages.deactivate') }}</option>
                            <option value="1" {{ $sale->status == 1 ? 'selected' : ''}} >{{ __('messages.active') }}</option>
                        </select>
                    </div>

                    @error('status')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-12 discount-common-save">
                    <div class="mt-3">
                        <input type="submit" class="btn btn-success" value="{{ __('messages.save') }}">
                    </div>
                </div>

            </div>


        </form>


    </div>
@endsection

@push('dash_custom_script')
    <script type="text/javascript"
            src="{{ asset('dash/plugins/jalalidatepicker/assets/persian-date.min.js')  }}"></script>
    <script type="text/javascript"
            src="{{ asset('dash/plugins/jalalidatepicker/dist/js/persian-datepicker.min.js')  }}"></script>
    <script>
        $(document).ready(function () {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date'
            })
            $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date'
            })
        })
    </script>
@endpush
