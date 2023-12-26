@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.new_common_discount') }}
@endsection
@push('dash_custom_style')
    <link rel="stylesheet" href="{{ asset('dash/plugins/jalalidatepicker/dist/css/persian-datepicker.min.css') }}">
@endpush
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.common.discount.create') }}
@endsection

@section('dash_main_content')

    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.new_common_discount') }}</h3>
                </div>
            </div>
        </div>
        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.common.discount.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common_discount_list') }}</a>
            </div>
        </div>


        <form action="{{ route('admin.common.discount.store') }}" method="post">
            @csrf
            <div class="row product-stock-list my-5 py-5 bg-white">
                <div class="col-sm-6">

                    <div class="mt-3">
                        <label for="percentage" class="form-label">{{ __('messages.percentage_discount') }}</label>
                        <input type="text" class="form-control" id="percentage" name="percentage" value="{{ old('percentage') }}">
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
                        <input type="text" class="form-control" id="discount_ceiling" name="discount_ceiling" value="{{ old('discount_ceiling') }}">
                    </div>
                    @error( 'discount_ceiling')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="minimal_order_amount"
                               class="form-label">{{  __('messages.minimal_order_amount') }}</label>
                        <input type="text" class="form-control" id="minimal_order_amount" name="minimal_order_amount" value="{{ old('minimal_order_amount') }}">
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
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
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

                        <input type="text" class="form-control d-none" id="start_date" name="start_date" value="{{ old('start_date') }}">
                        <input type="text" id="start_date_view" class="form-control form-check-sm">
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

                        <input type="text" class="form-control d-none" id="end_date" name="end_date" value="{{ old('end_date') }}">
                        <input type="text" id="end_date_view" class="form-control form-check-sm">
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
                            <option value="0" @if( old('status') == 0) selected @endif >{{ __('messages.deactivate') }}</option>
                            <option value="1" @if( old('status') == 1) selected @endif>{{ __('messages.active') }}</option>
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
