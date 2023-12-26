@extends('dash.include.master_dash')
@section('dash_page_title')
    پروفایل مدیریت
@endsection
@section('dash_main_content')
    <div class="container">

      {{--  <div class="row admin-profile-alert">
            @include('auth_admin.alert')
        </div>--}}

        <form action="{{ route('admin.update.profile') }}" method="post" class="bg-white rounded rounded-2" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $admin->id }}">

            <div class="row admin-profile-section px-2 py-2">

                <div class="col-sm-3 d-flex flex-column justify-content-center align-items-center admin-image-section pt-3">

                    <div class="image-upload-content mt-5 ">
                        <img class="img-thumbnail" id="image_admin" width="250" height="250" src="{{ $admin->image_path ?  asset('storage/admin_images/'.$admin->image_path)  : asset('dash/images/no-user.png') }}" alt="">
                    </div>

                    <div class="image-upload-btn">
                        <input type="file" name="image_path" id="image_select" class="btn btn-primary">
                    </div>

                </div>

                <div class="col-sm-9 admin-info-section">

                    <div class="mt-3">
                        <label for="user" class="form-label">نام کاربری:</label>
                        <input type="text" name="name" class="form-control" value="{{ $admin->name }}" id="user">
                    </div>

                    <div class="mt-3">
                        <label for="firstName" class="form-label">نام:</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $admin->first_name }}" id="firstName">
                    </div>

                    <div class="mt-3">
                        <label for="lastName" class="form-label">نام خانوادگی:</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $admin->last_name }}" id="lastName">
                    </div>

                    <div class="mt-3">
                        <label for="email" class="form-label">ایمیل:</label>
                        <input type="email" name="email" class="form-control" value="{{ $admin->email}}" id="email">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success btn-sm">{{ __('messages.edit_model') }}</button>
                        <a href="{{  route('admin.edit.mobile') }}" class="btn btn-primary btn-sm">{{ __('messages.edit_mobile') }}</a>
                    </div>

                </div>

            </div>
        </form>

    </div>
@endsection
@push('dash_custom_script')
    <script>
        $(document).ready(function () {
            $('#image_select').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image_admin').attr('src', e.target.result)
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush
