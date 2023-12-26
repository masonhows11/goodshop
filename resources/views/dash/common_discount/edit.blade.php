@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_common_discount') }}
@endsection
@push('dash_custom_style')
    <link rel="stylesheet" href="{{ asset('dash/plugins/jalalidatepicker/dist/css/persian-datepicker.min.css') }}">
@endpush
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.common.discount.edit') }}
@endsection

@section('dash_main_content')

    <div class="container-fluid">


        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.common.discount.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common_discount_list') }}</a>
            </div>
        </div>


        <form action="{{ route('admin.common.discount.update') }}" method="post">
            @csrf


            <input type="hidden" name="discount_id" value="{{ $discount->id }}">

            <div class="row product-stock-list my-5 py-5 bg-white">

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="percentage" class="form-label">{{ __('messages.percentage_discount') }}</label>
                        <input type="text" class="form-control" id="percentage" name="percentage" value="{{ $discount->percentage }}">
                    </div>

                    @error('percentage')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="discount_ceiling" class="form-label">{{ __('messages.discount_ceiling') }}</label>
                        <input type="text" class="form-control" id="discount_ceiling" name="discount_ceiling" value="{{ $discount->discount_ceiling }}">
                    </div>
                    @error( 'discount_ceiling')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="minimal_order_amount" class="form-label">{{  __('messages.minimal_order_amount') }}</label>
                        <input type="text" class="form-control" id="minimal_order_amount" name="minimal_order_amount" value="{{ $discount->minimal_order_amount }}">
                    </div>
                    @error('minimal_order_amount')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="title" class="form-label">{{ __('messages.title_discount') }}</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $discount->title }}">
                    </div>
                    @error('title')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="start_date" class="form-label">{{ __('messages.start_date') }}</label>
                        <input type="text" class="form-control d-none" id="start_date" name="start_date" >
                        <input type="text" id="start_date_view"  class="form-control form-check-sm" value="{{ $discount->start_date }}">
                    </div>
                    @error('start_date')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="end_date" class="form-label">{{ __('messages.end_date') }}</label>
                        <input type="text" class="form-control d-none" id="end_date" name="end_date" >
                        <input type="text" id="end_date_view" class="form-control form-check-sm" value="{{ $discount->end_date }}">
                    </div>
                    @error('end_date')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-12">
                    <div class="mt-3">
                        <label for="status" class="form-label">{{ __('messages.status') }}</label>
                        <select  class="form-control" id="status" name="status">
                           {{-- <option>{{ __('messages.choose') }}</option>--}}
                            <option value="0" {{ $discount->status == 0 ? 'selected' : '' }} >{{ __('messages.deactivate') }}</option>
                            <option value="1" {{ $discount->status == 1 ? 'selected' : ''}} >{{ __('messages.active') }}</option>
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
    <script type="text/javascript" src="{{ asset('dash/plugins/jalalidatepicker/assets/persian-date.min.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('dash/plugins/jalalidatepicker/dist/js/persian-datepicker.min.js')  }}"></script>
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
