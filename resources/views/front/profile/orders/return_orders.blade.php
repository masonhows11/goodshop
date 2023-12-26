@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.all_orders') }}
@endsection
@section('left_profile_content')

    <div class="profile-card"><!-- start order return box -->
        <p class="font-13">درخواست مرجوعی</p>
        <p class="font-12">برای مرجوع کردن کالایی از سفارش خود، شماره سفارش را در کادر زیر وارد نمایید.</p>
        <div class="row px-2">
            <div class="col">
                <input type="text" class="form-control" placeholder="کد سفارش">
            </div>
            <div class="col">
                <input type="submit" value="بررسی سفارش" class="btn btn-info font-13 py-2">
            </div>
        </div>
        <div class="alert alert-success mt-3">
            درخواست شما با موفقیت ثبت شد .
        </div>
        <div class="alert alert-warning mt-3">
            مرسوله قابل مرجوع برای این سفارش وجود ندارد.
        </div>
    </div><!-- end order return box -->

@endsection


