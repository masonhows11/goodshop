@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_delivery') }}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.delivery.edit',$delivery->title) }}
@endsection

@section('dash_main_content')

    <div class="container-fluid">



        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.delivery.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.delivery_types') }}</a>
            </div>
        </div>


        <form action="{{ route('admin.delivery.update') }}" method="post">
            @csrf


            <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">
            <div class="row product-stock-list mt-5 py-5 bg-white">

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for=title" class="form-label">{{ __('messages.delivery_title') }}</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $delivery->title }}">
                    </div>
                    @error('title')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for=delivery_amount" class="form-label">{{ __('messages.delivery_amount') }}</label>
                        <input type="text" class="form-control" id="delivery_amount" name="delivery_amount" value="{{ floatval($delivery->amount) }}">
                    </div>
                    @error('delivery_amount')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for=delivery_time" class="form-label">{{ __('messages.delivery_time') }}</label>
                        <input type="text" class="form-control" id="delivery_time" name="delivery_time" value="{{ $delivery->delivery_time }}">
                    </div>
                    @error( 'delivery_time')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for=delivery_time_unit" class="form-label">{{ __('messages.delivery_time_unit') }}</label>
                        <select name="delivery_time_unit" class="form-select" id="delivery_time_unit">
                            <option></option>
                            <option {{ $delivery->delivery_time_unit == 'ساعت' ? 'selected' : '' }} value="ساعت">ساعت</option>
                            <option  {{ $delivery->delivery_time_unit == 'روز' ? 'selected' : '' }} value="روز">روز</option>
                            <option {{ $delivery->delivery_time_unit == 'ماه' ? 'selected' : '' }} value="ماه">ماه</option>
                            <option {{ $delivery->delivery_time_unit == 'سال' ? 'selected' : '' }} value="سال">سال</option>
                        </select>

                    </div>
                    @error('delivery_time_unit')
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

