@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.new_coupon') }}
@endsection
@push('dash_custom_style')
    <link rel="stylesheet" href="{{ asset('dash/plugins/jalalidatepicker/dist/css/persian-datepicker.min.css') }}">
@endpush
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.coupons.create') }}
@endsection

@section('dash_main_content')

    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.new_coupon') }}</h3>
                </div>
            </div>
        </div>
        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.coupons.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.coupon_discount_list') }}</a>
            </div>
        </div>


        <form action="{{ route('admin.coupons.store') }}" method="post">
            @csrf

            <div class="row product-stock-list mt-5 py-5 bg-white">

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for=code" class="form-label" >{{ __('messages.coupon_code') }}</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                    </div>
                    @error('code')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="amount_type" class="form-label">{{ __('messages.coupon_amount_type') }}</label>
                        <select class="form-control" id="amount_type" name="amount_type">
                            <option value="0" @if( old('amount_type') == 0) selected @endif >{{ __('messages.percentage_type') }}</option>
                            <option value="1" @if( old('amount_type') == 1) selected @endif >{{ __('messages.numeric_type') }}</option>
                        </select>
                    </div>
                    @error('amount_type')
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
                    @error('discount_ceiling')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="amount" class="form-label">{{ __('messages.coupon_amount') }}</label>
                        <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                    </div>
                    @error('amount')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>





            </div>


            <div class="row bg-white py-5">

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="coupon_type" class="form-label">{{ __('messages.coupon_type') }}</label>
                        <select class="form-control" id="coupon_type" name="coupon_type">
                            <option value="0" @if( old('type') == 0) selected @endif > {{ __('messages.public_coupon') }} </option>
                            <option value="1" @if( old('type') == 1) selected @endif > {{ __('messages.private_coupon') }} </option>
                        </select>
                    </div>
                    @error('coupon_type')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="user" class="form-label">{{ __('messages.user_name') }}</label>
                        <select class="form-control" id="users" name="user_id" disabled>
                            <option>{{ __('messages.choose') }}</option>
                            @foreach($users as $user)
                                <option @if( old('user_id') == $user->id) selected @endif value="{{ $user->id }}" >{{ $user->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

            </div>




            <div class="row bg-white  py-5">
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

                <div class="col-sm-12">
                    <div class="mt-3">
                        <label for="status" class="form-label">{{ __('messages.status') }}</label>
                        <select  class="form-control" id="status" name="status">
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
        $(document).ready(function () {
            $("#coupon_type").change(function () {
                if( $('#coupon_type').find(':selected').val() === '1'){
                    $('#users').removeAttr('disabled');
                }else{
                    $('#users').attr('disabled','disabled');
                }
            })
        })
    </script>

@endpush
