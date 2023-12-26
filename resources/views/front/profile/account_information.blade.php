@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.account_information') }}
@endsection
@section('left_profile_content')
    <div class="profile-card personal-info"><!-- start personal info edit box -->
        <p class="font-13">اطلاعات کاربری </p>
        <form action="{{ route('user.update.account.information') }}" method="post">
            @csrf

            <input type="hidden" name="user" value="{{ $user->id }}">

            <div class="row">

                <div class="col mb-3">
                    <label for="name" class="form-label">{{ __('messages.mobile') }} : </label>
                    @if( $user->mobile == null )
                    <div class="text-danger">
                        <a class="text-danger" href="{{ route('mobile.update.form') }}">  {{ __('messages.update_needed')  }}</a>
                    </div>
                    @else
                        <div>
                            {{  $user->mobile }}
                        </div>
                    @endif

                </div>
                <div class="col mb-3">
                    <label for="name" class="form-label">{{ __('messages.email') }} : </label>

                    @if( $user->email == null )
                    <div class="text-danger">
                        <a class="text-danger" href="{{ route('email.update,form') }}"> {{  __('messages.update_needed') }} </a>
                    </div>
                    @else
                        <div>
                            {{ $user->email  }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="name" class="form-label">نام کاربری : </label>
                    <input type="text" name="name" class="form-control form-control-lg" id="name"
                           value="{{ $user->name }}">
                    @error('name')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label for="national_code" class="form-label">کد ملی : </label>
                    <input type="text" name="national_code" class="form-control form-control-lg" id="national_code"
                           value="{{ $user->national_code }}">
                    @error('national_code')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="first_name" class="form-label">نام :</label>
                    <input type="text" name="first_name" class="form-control form-control-lg" id="first_name"
                           value="{{ $user->first_name }}">
                    @error('first_name')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label for="last_name" class="form-label"> نام خانوادگی :</label>
                    <input type="text" name="last_name" class="form-control form-control-lg" id="last_name"
                           value="{{ $user->last_name }}">
                    @error('last_name')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="news" class="form-label">دریافت خبرنامه :</label>
                    <select class="form-select" id="news">
                        <option>بله</option>
                        <option>خیر</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-info text-white font-13 float-end">ثبت اطلاعات</button>
                </div>
            </div>
        </form>

    </div>
@endsection

