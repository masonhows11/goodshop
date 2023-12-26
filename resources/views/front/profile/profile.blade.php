@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.profile') }}
@endsection
@section('left_profile_content')

    <div class="profile-card">
        <div class="row">

            <div class="col-lg-6"><!-- start personal info box -->
                <p class="font-13"> اطلاعات کاربری </p>
                <div class="card font-13 text-center">
                    <div class="row mx-0 ">
                        <div class="col-6 pt-2 border-bottom border-end"><p> {{ __('messages.full_name') }} :</p>
                            <p>{{ $user->first_name .' '.$user->last_name }}</p></div>
                        <div class="col-6 pt-2 border-bottom"><p>{{ __('messages.email') }} :</p>
                            <p class="{{ $user->email == null ? 'text-danger' : '' }}">{{ $user->email ? $user->email : __('messages.email_address_not_registered') }}</p>
                        </div>
                        <div class="col-6 pt-2 border-bottom border-end"><p>{{ __('messages.mobile') }} :</p>
                            <p class="{{ $user->mobile == null ? 'text-danger' : '' }}">{{ $user->mobile ? $user->mobile : __('messages.mobile_number_not_registered')  }}</p>
                        </div>
                        <div class="col-6 pt-2 border-bottom"><p class=""> {{ __('messages.national_code') }} :</p>
                            <p class="{{ $user->national_code == null ? 'text-danger' : '' }}">{{ $user->national_code ? $user->national_code : __('messages.national_code_not_registered') }}</p>
                        </div>
                        <div class="col-6 pt-2 border-end"><p>{{ __('messages.subscribe_to_newsletter') }} :</p>
                            <p>بله</p></div>
                        <div class="col-6 pt-2"><p>: {{ __('messages.credit_card_number') }}</p>
                            <p>-</p></div>
                    </div>
                </div>
                <a href="{{ route('user.account.information') }}" class="profile-edit-link"><i
                        class="fa fa-edit align-middle"></i> ویرایش اطلاعات شخصی</a>
            </div><!-- end personal info box -->

            <div class="col-lg-6"><!-- start recent fav list -->
                <p class="font-13">لیست آخرین علاقه‌مندی‌ها</p>
                <div class="card">
                    @forelse($products as $product)
                        <div class="profile-recent-fav">
                            <a href="{{ route('product.details',$product->slug) }}"><img src="{{ asset('storage/' . $product->thumbnail_image) }}" alt="product-image"
                                             class="profile-recent-fav-img"></a>
                            <div>
                                <a href="{{ route('product.details',$product->slug) }}">{{ \Illuminate\Support\Str::limit($product->title_persian,50) }}</a>
                                <i class="fa fa-trash font-13"></i>
                                <i class="fa fa-cart-plus font-13"></i>
                            </div>
                        </div>
                    @empty
                        <div class="profile-recent-fav"  style="height: 240px">

                        </div>
                    @endforelse
                </div>
                <a href="{{ route('favorites') }}" class="profile-edit-link"><i class="fa fa-edit align-middle"></i> ویرایش لیست علاقمندی
                    ها</a>
            </div><!-- end recent fav list -->

        </div>
    </div>

    <div class="profile-card"><!-- start recent order list -->
        <p class="font-13">آخرین سفارش‌ها </p>
        <div class="table-responsive">
            <table class="text-center table table-custom table-bordered font-13">
                <thead class="thead-custom">
                <tr>
                    <td>#</td>
                    <td>شماره سفارش</td>
                    <td>تاریخ ثبت سفارش</td>
                    <td>مبلغ قابل پرداخت</td>
                    <td>مبلغ کل</td>
                    <td>عملیات پرداخت</td>
                    <td>جزییات</td>
                </tr>
                </thead>
                <tr>
                    <td>1</td>
                    <td>DKC-57262900</td>
                    <td>1 فروردین 1402</td>
                    <td>0</td>
                    <td>4,300,000 تومان</td>
                    <td class="text-success">پرداخت موفق</td>
                    <td><i class="fa fa-chevron-left align-middle"></i></td>
                </tr>
            </table>
        </div>
    </div><!-- end recent order list -->
@endsection
