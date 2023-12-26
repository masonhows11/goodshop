@extends('front.layouts.master_auth')
@section('page_title')
    {{ __('messages.login_user') }}
@endsection
@section('main_content')

    <div class="container">
        <div class="row">

            <div class="col-10 col-md-7 col-lg-5 signup-login-box">
                {{-- <img src="front/images/logo.png">--}}

                <h3 class="h3 text-center mt-4 ">
                    <a href="{{ route('home') }}" class="text-danger">{{ __('messages.site_name') }}</a>
                </h3>
                <form action="{{ route('auth.login.user') }}" method="post">
                    @csrf

                    <div class="form-group text-center mt-5">
                        <a href="{{ route('home') }}"> {{ __('messages.login_user') }}</a>
                    </div>

                    <div class="row d-flex flex-column justify-content-center align-items-center">

                        <div class="col">
                            <div class="input-group signup-login-form mobile-number">
                                <input type="text"
                                       class="form-control form-control-lg signup-login-input"
                                       name="auth_id" placeholder="{{ __('messages.auth_input_message') }}">
                            </div>
                        </div>

                        <div class="col">
                            <div class="col mb-2">
                                @include('front.auth_user.inline_alert')
                            </div>
                        </div>

                    </div>


                    <button type="submit" class="btn btn-danger d-block font-12 mx-auto mb-4 login-btn">
                        {{ __('messages.continue') }}
                    </button>

                    <p>{{ __('messages.new_user') }} <a href="{{ route('auth.register.form') }}" class="underline mx-1"> {{ __('messages.register_in_good_shop') }}</a></p>

                </form>
            </div>
        </div>
    </div>
@endsection

