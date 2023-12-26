@extends('front.layouts.master_auth')
@section('page_title')
    {{ __('messages.validate_code') }}
@endsection
@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-10 col-md-7 col-lg-5 signup-login-box">
                {{-- <img src="assets/images/logo.png">--}}
                <h3 class="h3 text-center mt-4">
                    <a href="{{ route('home') }}" class="text-danger">  {{ __('messages.site_name') }}</a>
                </h3>

                <form action="{{ route('auth.validate.user') }}" method="post">
                    @csrf



                    @if( session()->has('auth_email') )
                        <input type="hidden" name="email" value="{{ session()->get('auth_email') }}">
                    @elseif( session()->has('auth_mobile'))
                        <input type="hidden" name="mobile" value="{{ session()->get('auth_mobile') }}">
                    @endif

                    @if( session()->has('token_guid') )
                        <input type="hidden" id="token-guid" name="" value="{{ session()->get('token_guid') }}">
                    @endif

                    <div class="form-group text-center mt-2">
                        {{ __('messages.enter_active_code') }}
                    </div>

                    <div class="input-group  signup-login-form  mt-2">
                        <a href="{{ route('auth.login.form') }}"><i class="text-danger fa fa-arrow-right"></i></a>
                    </div>

                    <div class="row d-flex flex-column justify-content-center align-items-center">

                        <div class="col">
                            <div class="input-group signup-login-form mobile-number">
                                <input type="text" class="form-control form-control-lg signup-login-input" name="token"
                                       placeholder="کد تایید را وارد کنید ">
                            </div>
                        </div>

                        <div class="col">
                            <div class="signup-login-form">
                                <div class="form-check">
                                    <input class="form-check-input form-check-input-custom" type="checkbox"
                                           name="remember">
                                    <label class="form-check-label line-height ps-1" for="customCheck">
                                        {{ __('messages.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-2 d-flex flex-column justify-content-center align-items-center">
                        <div class="col">
                            <div class="col mb-2">
                                @include('front.auth_user.inline_alert')
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-danger d-block font-12 mx-auto signup-btn mb-2">
                        {{ __('messages.login') }}
                    </button>

                    <div class="row mb-2 mt-2 d-flex flex-column justify-content-center align-items-center">
                        <div class="col count-down-link-container">

                            <div class="signup-login-form text-center d-none" id="resend-otp">
                                @if( session()->has('token_guid') )
                                    <a href="{{ route('auth.resend.token',['token_guid'=>session()->get('token_guid')]) }}" id="resend-token" class="text-info text-decoration-none">{{ __('messages.resend_active_code') }}</a>
                                @endif
                            </div>
                            <div class="signup-login-form text-center" id="timer-otp">
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('front_custom_scripts')
    @if ( session()->has('token_time'))
        @php
            $token = session()->get('token_time');
            $timer = (( new \Carbon\Carbon( $token))->addMinutes(2)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000 ;
        @endphp
        <script>
            let countDown = new Date().getTime() + {{ $timer }};
            let timer = $('#timer-otp');
            let resendOtp = $('#resend-otp');
            let x = setInterval(function () {
                let now = new Date().getTime();
                let distance = countDown - now;
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let second = Math.floor((distance % (1000 * 60)) / (1000));
                let tr_resend_code = ' ارسال مجدد کد تایید تا ';
                let tr_minutes = ' دقیقه و ';
                let tr_second = ' ثانیه دیگر ';
                if (minutes === 0) {
                    timer.html(tr_resend_code + second + tr_second)
                } else {
                    timer.html(tr_resend_code + minutes + tr_minutes + second + tr_second)
                }
                if (distance < 0) {
                    clearInterval(x);
                    timer.addClass('d-none')
                    resendOtp.removeClass('d-none');
                }
            }, 1000)
        </script>

    @endif
    {{-- <script>
         $(document).on('click', '#resend-token', function (event) {
             event.preventDefault();
             let token_guid = document.getElementById('token-guid').value;
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
             $.ajax({
                 method: 'POST',
                 url: '{{ route('auth.resend.token') }}',
                 data: {token_guid:token_guid}
             }).done(function (data) {
                 console.log(data);
                 if (data['status'] === 200) {
                     alert(data['success'])
                 }
                 if (data['status'] === 500) {
                     alert(data['error'])
                 }
             }).fail(function (data) {
                 if (data['status'] === 500) {
                     alert(data['exception'])
                 }
             });
         })
     </script>--}}
@endpush
