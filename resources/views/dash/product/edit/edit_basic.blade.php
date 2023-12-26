@extends('dash.include.master_dash')
@section('dash_page_title')
    ویرایش مشخصات عمومی کالا
@endsection
@section('breadcrumb')
        {{ Breadcrumbs::render('admin.edit.product.basic',$product->title_persian) }}
@endsection
@section('dash_main_content')
    <link rel="stylesheet" href="{{ asset('dash/plugins/jalalidatepicker/dist/css/persian-datepicker.min.css') }}">
    <div class="container-fluid">


        <div class="row product-create-body mx-auto my-5 bg-white">
            <form action="{{ route('admin.product.update.basic') }}" method="post" enctype="multipart/form-data"
                  id="product-form">
                @csrf

                <div class="row mx-2">

                    <input type="hidden" name="product" value="{{ $product->id }}">

                    <div class="col-sm-4 mt-5 mb-5">

                        <div class="col mt-5 mb-5">
                            <label for="title_persian" class="form-label">عنوان کالا ( فارسی )</label>
                            <input type="text"
                                   class="form-control"
                                   id="title_persian"
                                   placeholder=""
                                   name="title_persian"
                                   value="{{ $product->title_persian }}">
                            @error('title_persian')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mt-5 mb-5">
                            <label for="title_english" class="form-label">عنوان کالا ( انگلیسی )</label>
                            <input type="text"
                                   dir="ltr"
                                   class="form-control"
                                   id="title_english"
                                   placeholder=""
                                   name="title_english"
                                   value="{{ $product->title_english }}">
                            @error('title_english')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mt-5 mb-5">
                            <label for="active" class="form-label">وضعیت نمایش کالا</label>
                            <select name="is_active" id="active" class="form-select">
                                <option
                                    {{ $product->status == 0 ? 'selected' : '' }} value="0">{{ __('messages.unpublished') }}</option>
                                <option
                                    {{ $product->status == 1 ? 'selected' : '' }} value="1">{{ __('messages.published') }}</option>
                            </select>
                            @error('is_active')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mt-5 mb-5">
                            <label for="brands" class="form-label">برند کالا</label>
                            <select name="brand_id" class="form-select" id="brands">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                            @if(old('brands',$product->brand_id) == $brand->id) selected @endif >{{ $brand->title_persian }}</option>
                                @endforeach
                            </select>
                            @error('brand')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mt-5 mb-5">
                            <label for="product_tags" class="form-label">تگ ها</label>
                            <input type="hidden" name="product_tags" id="product_tags"
                                   value="{{ old('product_tags',$product->tags) }}">
                            <select class="form-select" id="product_selected_tags" multiple>
                            </select>
                            @error('product_tags')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="col mt-5 mb-5">
                            <label for="category-select" class="form-label">انتخاب دسته بندی</label>
                            <select class="category-select form-select" multiple id="category-select"
                                    name="categories[]">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id,$category_ids) ? 'selected' : '' }} >
                                        {{ $category->title_persian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                            <div class="my-5 alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="col mt-5 mb-5">
                            <label for="marketable" class="form-label">قابل فروش بودن</label>
                            <select class="form-select" id="marketable" name="marketable">

                                <option value="1" {{ $product->marketable == 1 ? 'selected' : '' }} >بله</option>
                                <option value="0" {{ $product->marketable == 0 ? 'selected' : '' }} >خیر</option>
                            </select>

                            @error('marketable')
                            <div class="my-5 alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-sm-4 mt-5 mb-5">

                        <div class="col mt-5 mb-5">
                            <label for="weight" class="form-label">وزن</label>
                            <input type="number" dir="ltr" min="1" class="form-control" id="weight" name="weight"
                                   value="{{ $product->weight  }}">
                            @error('weight')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col mt-5 mb-5">
                            <label for="length" class="form-label">طول</label>
                            <input type="number" dir="ltr" min="1" class="form-control" id="length" name="length"
                                   value="{{ $product->length }}">
                            @error('length')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col mt-5 mb-5">
                            <label for="width" class="form-label">عرض</label>
                            <input type="number" dir="ltr" min="1" class="form-control" id="width" name="width"
                                   value="{{ $product->width }}">
                            @error('width')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col mt-5 mb-5">
                            <label for="height" class="form-label">ارتفاع</label>
                            <input type="number" dir="ltr" min="1" class="form-control" id="height" name="height"
                                   value="{{ $product->height }}">
                            @error('height')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col mt-5 mb-5">
                            <label for="available_in_stock" class="form-label">تعداد</label>
                            <input type="text" class="form-control" id="available_in_stock" name="available_in_stock" value="{{ $product->available_in_stock }}">
                            @error('available_in_stock')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col mt-5 mb-5">
                            <label for="sku" class="form-label">شناسه محصول (SKU)</label>
                            <input type="text" class="form-control" id="sku" name="sku"
                                   value="{{ $product->sku }}">
                            @error('sku')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col mt-5 mb-5">
                            <label for="origin_price" class="form-label">{{ __('messages.origin_price') }}</label>
                            <input type="number" dir="ltr" min="1" class="form-control" id="origin_price"
                                   name="origin_price" value="{{ $product->origin_price }}">
                            @error('origin_price')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col mt-5 mb-5">
                            <label for="published_at" class="form-label">تاریخ انتشار</label>

                            <input type="text" id="published_at" class="d-none form-control form-control-sm"
                                   name="published_at">

                            <input type="text" id="published_at_view" class="form-control form-control-sm"
                                   value="{{ $product->published_at }}">
                            @error('published_at')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    {{--  image section  --}}
                    <div class="col-sm-4 mt-5 mb-5">

                        <div class="row d-flex flex-column justify-content-center align-content-center product-image">
                            <div class="col-lg-8">
                                <img src="{{ $product->thumbnail_image ?  asset('storage/'.$product->thumbnail_image) :   asset('dash/images/no-image-icon-23494.png') }}"
                                     id="image_view" class="img-thumbnail" height="300" width="300" alt="image"></div>
                            <div class="col-lg-8">
                                <label for="image_label" class="mt-5 form-label">{{ __('messages.thumbnail_image') }}</label>
                                <input type="file" class="form-control" accept="image/png, image/jpeg" id="image_select"
                                       name="thumbnail_image" value="{{ asset('storage/'.$product->thumbnail_image) }}"
                                       readonly>
                                @error('thumbnail_image')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row product-description mx-2">

                    <div class="col-sm mt-5">
                        <label for="short_description" class="mb-5">چکیده</label>
                        <textarea class="form-control mt-5" id="short_description" name="short_description">
                            {{ $product->short_description }}
                           </textarea>
                        @error('short_description')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-sm mt-5">
                        <label for="full_description" class="mb-5">توضیحات</label>
                        <textarea class="form-control mt-5" id="full_description" name="full_description">
                            {{ $product->full_description }}
                            </textarea>
                        @error('full_description')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-sm mt-5">
                        <label for="seo_desc" class="mb-5">توضیحات سئو</label>
                        <textarea class="form-control" rows="8" dir="rtl" name="seo_desc" id="seo_desc">
                            {{ $product->seo_desc }}
                            </textarea>
                        @error('seo_desc')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row my-4 mx-2">
                    <div class="col d-flex justify-content-start">
                        <div>
                            <button type="submit" class="btn btn-success">ذخیره</button>
                        </div>
                        <div class="ms-2">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">لیست محصولات</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('dash_custom_script')
    <script type="text/javascript" src="{{ asset('dash/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('dash/plugins/jalalidatepicker/assets/persian-date.min.js')  }}"></script>
    <script type="text/javascript"
            src="{{ asset('dash/plugins/jalalidatepicker/dist/js/persian-datepicker.min.js')  }}"></script>
    <script type="javascript" src="{{ asset('dash/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        CKEDITOR.replace('full_description', {
            language: 'fa',
            removePlugins: 'image',
        });
        CKEDITOR.replace('short_description', {
            language: 'fa',
            removePlugins: 'image',
        });
        CKEDITOR.replace('seo_desc', {
            language: 'fa',
            removePlugins: 'image',
        });
        $(document).ready(function () {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at'
            })
        })
        $(document).ready(function () {
            $('.category-select').select2({
                dir: 'rtl',
                theme: "classic"
            });
        });
        $(document).ready(function () {
            var tags_input = $('#product_tags'); // go for backend
            var selected_tags = $('#product_selected_tags'); // user enter tags
            var default_tags = tags_input.val();
            var default_data = null;
            // for keeping old value after failed validation
            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
                console.log(default_data);
            }
            // select2 config
            selected_tags.select2({
                theme: 'classic',
                dir: 'rtl',
                tags: 'true',
                data: default_data,
            });
            selected_tags.children('option').attr('selected', true).trigger('change');
            // save all tags into hidden input & go for backed
            $('#product-form').submit(function (event) {
                if (selected_tags.val() !== null && selected_tags.val().length > 0) {
                    var selectedSource = selected_tags.val().join(',');
                    tags_input.val(selectedSource);
                }
            })
        });
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
        $(document).ready(function () {
            @if(session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                newWindow: true,
                close: false,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
            }).showToast();
            @elseif(session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
            }).showToast();
            @endif
        })
    </script>
    {{--  const Toast = Swal.mixin({
          toast: true,
          position: 'top',
          showConfirmButton: false,
          showCloseButton: true,
          timer: 5000,
          timerProgressBar: true,
          didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
      });
      @if(session()->has('error'))
      Toast.fire({
          icon: 'error',
          title: '{{ session()->get('error') }}'
      })
      @elseif(session()->has('success'))
      Toast.fire({
          icon: 'success',
          title: '{{ session()->get('success') }}'
      })
      @endif--}}


@endpush
