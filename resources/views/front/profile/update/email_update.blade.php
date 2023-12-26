@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.profile') }}
@endsection
@section('left_profile_content')

    <div class="profile-card personal-info"><!-- start personal info edit box -->
        <p class="font-13">اطلاعات کاربری </p>

        <form action="{{ route('email.update') }}" method="post">
            @csrf

            <input type="hidden" name="user" value="{{ $user->id }}">


            <div class="row">
                <div class="col mb-3">
                    <label for="email" class="form-label">ایمیل :</label>
                    <input type="email" name="email" class="form-control form-control-lg" id="email" value="{{ $user->email }}">
                    @error('email')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
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

