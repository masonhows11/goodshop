@extends('front.layouts.master_auth')
@section('page_title')
    {{ __('messages.register_user') }}
@endsection
@section('main_content')


    <div class="container">
        <div class="row">
            <div class="col-10 col-md-7 col-lg-5 signup-login-box">
                {{-- <img src="assets/images/logo.png">--}}
                <h3 class="h3 text-center mt-4 ">
                    <a href="{{ route('home') }}" class="text-danger">  {{ __('messages.site_name') }}</a>
                </h3>
                <form action="{{ route('auth.register.user') }}" method="post">
                    @csrf

                    <div class="form-group text-center mt-5">
                        {{ __('messages.register_user') }}
                    </div>

                    <div class="row d-flex flex-column justify-content-center align-items-center">

                        <div class="col">
                            <div class="input-group signup-login-form mobile-number">
                                <input type="text"
                                       class="form-control form-control-lg signup-login-input"
                                       name="auth_id"
                                       placeholder="{{ __('messages.auth_input_message') }}">
                            </div>
                        </div>

                        <div class="col">
                            <div class="signup-login-form">
                                <div class="form-check text-center">
                                    <input class="form-check-input form-check-input-custom" name="rules" type="checkbox"
                                           id="customCheck">
                                    <label class="form-check-label line-height" for="customCheck">
                                        <a href="#" class="underline">حریم خصوصی</a> و <a href="#" class="underline">شرایط
                                            و قوانین</a> استفاده از سرویس های سایت خرید خوب را مطالعه نموده و با کلیه
                                        موارد آن موافقم.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-2">
                            @include( 'front.auth_user.inline_alert')
                        </div>

                    </div>


                    <button type="submit" class="btn btn-danger d-block font-12 mx-auto signup-btn mb-4">
                        {{ __('messages.register') }}
                    </button>

                    <p> {{ __('messages.already_registered') }} <a href="{{ route('auth.login.form') }}" class="underline mx-1"> {{__('messages.login')}} </a>
                    </p>

                </form>
            </div>
        </div>
    </div>

@endsection
