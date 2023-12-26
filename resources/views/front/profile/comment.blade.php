@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.comments') }}
@endsection
@section('main_content')


        <div class="profile-card"><!-- start comment list -->
            <p class="font-13">نظرات من</p>
            <div class="row">

                <div class="col-12 profile-comment"><!-- start comment box -->
                    <div class="card d-flex flex-row mb-3 pe-1">
                        <a href="product.html"><img src="assets/images/mobile1.jpg"  class="fav-list-pic"></a>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="product.html" class="fav-list-title">گوشی موبایل سامسونگ مدل Galaxy A21S SM-A217F/DS</a>
                                <p class="badge bg-warning m-2 text-white p-1 px-2 me-4">در انتظار تایید</p>
                            </div>
                            <p><span> پیام شما : </span>پیشنهاد میکنم گوشی رو از نیک کالا بخرید چون قیمتش از
                                همه جا بهتره و خرید گوشی هم راحت‌تره. من از خریدم راضیم و محصول با کیفیتی از نیک کالا خریدم
                            </p>
                            <i class="fa fa-trash  me-4"></i>
                        </div>
                    </div>
                </div><!-- end comment box -->

                <div class="col-12 profile-comment"><!-- start comment box -->
                    <div class="card d-flex flex-row mb-3 pe-1">
                        <a href="product.html"><img src="assets/images/mobile2.jpg"  class="fav-list-pic"></a>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="product.html" class="fav-list-title">گوشی موبایل سامسونگ مدل Galaxy A21S SM-A217F/DS</a>
                                <p class="badge bg-success m-2 text-white p-1 px-2 me-4">تایید شده</p>
                            </div>
                            <p><span> پیام شما : </span>پیشنهاد میکنم گوشی رو از نیک کالا بخرید چون قیمتش از
                                همه جا بهتره و خرید گوشی هم راحت‌تره. من از خریدم راضیم و محصول با کیفیتی از نیک کالا خریدم
                            </p>
                            <i class="fa fa-trash me-4"></i>
                        </div>
                    </div>
                </div><!-- end comment box -->

            </div>
        </div>
@endsection
