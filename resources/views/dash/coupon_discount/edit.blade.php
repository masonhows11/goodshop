@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_coupon') }}
@endsection
@push('dash_custom_style')
    <link rel="stylesheet" href="{{ asset('dash/plugins/jalalidatepicker/dist/css/persian-datepicker.min.css') }}">
@endpush
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.coupons.edit') }}
@endsection

@section('dash_main_content')

    <div class="container-fluid">


        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.coupons.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.coupon_discount_list') }}</a>
            </div>
        </div>


        <form action="{{ route('admin.coupons.update') }}" method="post">
            @csrf


            <input type="hidden" name="coupon_id" value="{{ $coupon->id }}">

            <div class="row product-stock-list mt-5 py-5 bg-white">

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for=code" class="form-label" >{{ __('messages.coupon_code') }}</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code }}">
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
                            <option value="0" {{ $coupon->amount_type == 0 ? 'selected' : '' }} >{{ __('messages.percentage_type') }}</option>
                            <option value="1" {{ $coupon->amount_type == 1 ? 'selected' : '' }} >{{ __('messages.numeric_type') }}</option>
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
                        <input type="text" class="form-control" id="discount_ceiling" name="discount_ceiling" value="{{ $coupon->discount_ceiling }}">
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
                        <input type="text" class="form-control" id="amount" name="amount" value="{{ $coupon->amount }}">
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
                            <option value="0" {{ $coupon->type == 0 ? 'selected' : '' }} >{{ __('messages.public_coupon') }} </option>
                            <option value="1" {{ $coupon->type == 1 ? 'selected' : '' }} > {{ __('messages.private_coupon') }} </option>
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
                        <select class="form-control" id="users" name="user_id" {{ $coupon->type == 0 ? 'disabled' : '' }}>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $coupon->user_id == $user->id ? 'selected' : '' }} > {{ $user->name  }}</option>
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
                        <input type="text" class="form-control d-none" id="start_date" name="start_date" >
                        <input type="text" id="start_date_view" class="form-control form-check-sm" value="{{ $coupon->start_date }}">
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
                        <input type="text" id="end_date_view" class="form-control form-check-sm" value="{{ $coupon->end_date }}">
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
                            <option value="0"  {{ $coupon->status == 0 ? 'selected' : '' }} >{{ __('messages.deactivate') }}</option>
                            <option value="1"  {{ $coupon->status == 1 ? 'selected' : '' }} >{{ __('messages.active') }}</option>
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

            // if( $('#coupon_type').find(':selected').val() === '1'){
            //     $('#users').removeAttr('disabled');
            // }else{
            //     $('#users').attr('disabled','disabled');
            // }

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
