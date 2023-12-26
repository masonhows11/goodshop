@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.new_banner') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('admin.delivery.create') }}--}}
@endsection

@section('dash_main_content')

    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.bottom_banner') }} / {{ __('messages.edit_banner') }}</h3>
                </div>
            </div>
        </div>

        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.bottom.banner.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.list_banners') }}</a>
            </div>
        </div>


        <form action="{{ route('admin.bottom.banner.update') }}" method="post" enctype="multipart/form-data">
            @csrf


            <div class="row   row-cols-md-2 row-cols-sm-1 row-cols-1  product-stock-list mt-5 py-5 bg-white">

                <div class="col">

                    <input type="hidden" name="banner" value="{{ $banner->id }}">

                    <div class="row">

                        <div class="col-12">
                            <div class="mt-3">
                                <label for=title" class="form-label">{{ __('messages.title') }}</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $banner->title }}">
                            </div>
                            @error('title')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="col-12">
                            <div class="mt-3">
                                <label for="url" class="form-label">{{ __('messages.url_image') }}</label>
                                <input type="url" class="form-control" id="url" name="url" value="{{ $banner->url }}">
                            </div>
                            @error('url')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="mt-3">
                                <label for="status" class="form-label">{{ __('messages.status') }}</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ $banner->status == 1 ? 'selected' : '' }} >{{ __('messages.active') }}</option>
                                    <option value="0" {{ $banner->status == 0 ? 'selected' : '' }} >{{ __('messages.deactivate') }}</option>
                                </select>
                            </div>
                            @error('status')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="col">
                    {{--  logo section  --}}
                    <div class="row d-flex flex-column justify-content-center align-content-center">
                        <div class="col-lg-8 top-banner-section">
                            <img src="{{ $banner->image_path ?   $banner->image_path : asset('dash/images/no-image-icon-23494.png') }}"
                                 id="image_view"
                                 class="img-thumbnail" height="250" width="250" alt="image">
                        </div>
                        <div class="col-lg-5">
                            <label for="image_label" class="mt-5 form-label">{{ __('messages.image') }}</label>
                            <input type="file"
                                   class="form-control" accept="image/png, image/jpeg , image/jpg ,image/gif" id="image_select"
                                   name="image_path">
                            @error('image_path')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
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
            const input = document.getElementById("image_select");
            const previewImage = document.getElementById("image_view");
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


