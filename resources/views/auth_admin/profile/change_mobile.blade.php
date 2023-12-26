@extends('dash.include.master_dash')
@section('dash_page_title')
    تغییر شماره مویایل
@endsection
@section('dash_main_content')
    <div class="container">

       {{-- <div class="row admin-mobile-alert">
            @include('auth_admin.alert')
        </div>--}}

        <form action="{{ route('admin.update.mobile') }}" class="bg-white rounded rounded-2" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $admin->id }}">

            <div class="row admin-mobile-section px-2 py-2">

                <div class="col">
                    <div class="image-upload-content mt-5">
                        <img class="img-rounded" id="image_admin" width="250" height="250" src="{{ $admin->image_path ?  asset('storage/admin_images/'.$admin->image_path)  : asset('dash/images/no-user.png') }}" alt="">
                    </div>
                </div>

                <div class="col-sm-9 d-flex flex-column justify-content-center">

                    <div class="mt-3">
                        <label for="mobile" class="form-label">شماره موبایل:</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $admin->mobile }}">

                        @error('mobile')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <input type="submit" class="btn btn-success btn-sm" value="{{ __('messages.save') }}">
                        <a href="{{  route('admin.profile') }}" class="btn btn-primary btn-sm">{{ __('messages.return') }}</a>
                    </div>
                </div>

            </div>

        </form>
    </div>
@endsection
