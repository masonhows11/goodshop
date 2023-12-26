@extends('front.layouts.master_front')
@section('main_content')
        <div class="container">

            @php
                $route = request()->route()->getName();
                $user = Auth::user();
            @endphp
            <div class="row">

                <!--  sidebar menu ----->
                <!---------------------->
                <div class="col-lg-3">
                    <div class="profile-card pb-0"><!-- start avatar box -->
                        <img src="{{ asset('front/images/avatar.jpg') }}" alt="profile-user-avatar" class="profile-avatar img-thumbnail">
                        <p class="font-13 text-center">{{ $user->first_name != null  &&  $user->last_name != null
                            ? $user->FullName : __('messages.no_name') }}</p>
                        <div class="row border-top">
                            <div class="col-6 border-end text-center">
                                <i class="fa fa-lock font-13 text-muted my-2"></i>
                                <a href="{{ route('mobile.update.form') }}" class="text-dark d-block font-12 mb-2">{{ __('messages.change_mobile_number') }}</a>
                            </div>
                            <div class="col-6 text-center">
                                <i class="fas fa-sign-out-alt font-13 text-muted my-2"></i>
                                <a href="{{ route('auth.log.out') }}" class="text-dark d-block font-12 mb-2">{{ __('messages.sign_out_of_the_user_account') }}</a>
                            </div>
                        </div>
                    </div><!-- end avatar box -->

                    <div class="profile-card"><!-- start sidebar menu -->
                        <ul class="profile-sidebar">
                            <li><a href="{{ route('user.profile') }}" class="{{ $route === 'user.profile' ? 'text-info' : '' }}"><i class="far fa-user-circle align-middle me-2"></i>پروفایل</a></li>
                            <li><a href="{{ route('mobile.update.form') }}" class="{{ $user->mobile == null ? 'text-danger' : '' }}" ><i class="fas fa-mobile-alt align-middle me-2"></i>{{ __('messages.mobile') }}  {{ $user->mobile == null ? ' - '  . __('messages.update_needed') : '' }}</a></li>
                            <li><a href="{{ route('email.update.form') }}" class="{{ $user->email == null ? 'text-danger' : '' }}"><i class="fas fa-envelope align-middle me-2  "></i>{{ __('messages.email') }}   {{ $user->email == null ? __('messages.update_needed') : '' }}</a></li>
                            <li><a href="{{ route('all.orders') }}"><i class="fas fa-shopping-cart align-middle me-2"></i>سفارشات</a></li>
                            <li><a href="{{ route('order.returned.request') }}"><i class="fa  fa-retweet align-middle me-2"></i>درخواست مرجوعی</a></li>
                            <li><a href="{{ route('favorites') }}"><i class="far fa-heart align-middle me-2"></i>لیست علاقمندی ها</a></li>
                            <li><a href="{{ route('compare.products') }}"><i class="fas fa-random align-middle me-2"></i>مقایسه محصولات</a></li>
                            <li><a href="{{ route('comments') }}"><i class="far fa-comment align-middle me-2"></i>نظرات</a></li>
                            <li><a href="{{ route('addresses') }}"><i class="fas fa-map-marker-alt align-middle me-2"></i>آدرس ها</a></li>
                            <li><a href="{{ route('tickets') }}"><i class="fas fa-ticket-alt align-middle me-2"></i>تیکت ها</a></li>
                            <li><a href="{{ route('user.account.information') }}" class="{{ $route === 'user.account.information' ? 'text-info' : '' }}"><i class="far fa-address-card align-middle me-2"></i>اطلاعات حساب</a></li>
                        </ul>
                    </div>
                </div>
                <!-- end sidebar menu -->
                <!---------------------->

                <!-- left content ------>
                <!---------------------->
                <div class="col-lg-9">
                @yield('left_profile_content')
                </div>
                <!-- end left content ------>
                <!---------------------->

            </div>


        </div>
@endsection

