@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_setting_site') }}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.setting.edit',$setting->title) }}
@endsection

@section('dash_main_content')

    <div class="container-fluid">


        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.setting.index') }}" class="btn btn-sm btn-primary">{{ __('messages.setting_site') }}</a>
            </div>
        </div>


        <form action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="setting_id" value="{{ $setting->id }}">

            <div class="row  setting-edit-form mt-5 py-5 bg-white">

                <div class="col-lg-6">
                    <div class="col">
                        <div class="mt-3">
                            <label for=title" class="form-label">{{ __('messages.title') }}</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ $setting->title }}">
                        </div>
                        @error('title')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col">
                        <div class="mt-3">
                            <label for="description" class="form-label">{{ __('messages.description') }}</label>
                            <input type="text" class="form-control " id="description" name="description" value=" {{ $setting->description }}">
                        </div>
                        @error('description')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col">
                        <div class="mt-3">
                            <label for="keywords" class="form-label">{{ __('messages.keywords') }}</label>
                            <input type="text" class="form-control " id="keywords" name="keywords" value=" {{ $setting->keywords }}">
                        </div>
                        @error('keywords')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col">
                            {{--  logo section  --}}
                            <div class="row d-flex flex-column justify-content-center align-content-center">
                                <div class="col-lg-8 logo-section">
                                    <img src="{{ $setting->logo ?
                                            asset('storage/'.$setting->logo) :
                                            asset('dash/images/no-image-icon-23494.png') }}"
                                         id="logo_view"
                                         class="img-thumbnail"
                                         height="300" width="300"
                                         alt="image">
                                </div>
                                <div class="col-lg-8">
                                    <label for="image_label" class="mt-5 form-label">{{ __('messages.logo') }}</label>
                                    <input type="file"
                                           class="form-control"
                                           accept="image/png, image/jpeg"
                                           id="logo_select"
                                           name="logo">
                                    @error('logo')
                                    <div class="alert alert-danger mt-3">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            {{-- icon section  --}}
                            <div
                                class="row d-flex flex-column justify-content-center align-content-center product-image">
                                <div class="col-lg-8 icon-section">
                                    <img src="{{ $setting->icon ?
                                            asset('storage/'.$setting->icon) :
                                            asset('dash/images/no-image-icon-23494.png') }}"
                                         id="icon_view"
                                         class="img-thumbnail"
                                         height="300" width="300"
                                         alt="image">
                                </div>
                                <div class="col-lg-8">
                                    <label for="image_label" class="mt-5 form-label">{{ __('messages.icon') }}</label>
                                    <input type="file" class="form-control"
                                           accept="image/png, image/jpeg"
                                           id="icon_select"
                                           name="icon"
                                           value="{{ asset('storage/'.$setting->icon) }}" readonly>
                                    @error('icon')
                                    <div class="alert alert-danger mt-3">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 discount-common-save">
                    <div class="mt-3">
                        <input type="submit" class="btn btn-success" value="{{ __('messages.save') }}">
                    </div>
                </div>

            </div>



        </form>
    </div>
@endsection
@push('dash_custom_script')
    <script>
        $(document).ready(function () {
            const input = document.getElementById("logo_select");
            const previewImage = document.getElementById("logo_view");
            input.addEventListener("change", function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener("load", function () {
                        previewImage.setAttribute("src", this.result);
                    });
                    reader.readAsDataURL(file);
                }
            });
        })
    </script>
    <script>
        $(document).ready(function () {
            const input = document.getElementById("icon_select");
            const previewImage = document.getElementById("icon_view");
            input.addEventListener("change", function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener("load", function () {
                        previewImage.setAttribute("src", this.result);
                    });
                    reader.readAsDataURL(file);
                }
            });
        })
    </script>
@endpush
