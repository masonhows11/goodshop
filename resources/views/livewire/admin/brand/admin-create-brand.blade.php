<div>
    @section('dash_page_title')
        برند جدید
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.brands.create') }}
    @endsection
    <div class="container-fluid">


        <div class="row d-flex justify-content-center mt-5 create-form-brand">
            <div class="col-lg-5">
                <form wire:submit.prevent="save">
                    @csrf

                    <div class="mb-3 mt-3">
                        <label for="title_p" class="form-label">عنوان ( فارسی )</label>
                        <input wire:model.defer="title_persian" type="text" class="form-control" id="title_p">
                    </div>
                    @error('title_persian')
                    <div class="alert alert-danger">{{ $message}}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="title_e" class="form-label">عنوان ( انگلیسی )</label>
                        <input wire:model.defer="title_english" type="text" dir="ltr" class="form-control" id="title_e">
                    </div>
                    @error('title_english')
                    <div class="alert alert-danger">{{ $message}}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="seo_desc" class="form-label">توضیحات سئو</label>
                        <input wire:model.defer="seo_desc" type="text" dir="ltr" class="form-control" id="seo_desc">
                    </div>
                    @error('seo_desc')
                    <div class="alert alert-danger">{{ $message}}</div>
                    @enderror


                    <div class="mb-3">
                        @if($logo)
                            <img src="{{ $logo->temporaryUrl() }}"
                                 width="200" height="200"
                                 alt="logo_image_path"
                                 class="rounded border border-2 image-admin-preview">
                        @else
                            <img src="{{ asset('dash/images/no-image-icon-23494.png') }}"
                                 width="200" height="200"
                                 alt="logo_image_path"
                                 class="rounded border border-2 image-admin-preview">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">تصویر برند</label>
                        <input type="file" accept="image/*" class="form-control" wire:model.defer="logo" id="logo">
                    </div>
                    <div wire:loading wire:target="logo">در حال بارگزاری...</div>
                    @error('logo')
                    <div class="alert alert-danger">{{ $message}}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="is_active">وضعیت:</label>
                        <select wire:model.defer="is_active" class="form-select" id="is_active">
                            <option>وضعیت برند را انتخاب کنید</option>
                            <option value="1">فعال</option>
                            <option value="0">غیر فعال</option>
                        </select>
                    </div>
                    @error('is_active')
                    <div class="alert alert-danger">{{ $message}}</div>
                    @enderror

                    <button type="submit" class="btn btn-success">ذخیره</button>
                    <a href="{{ route('admin.brand.index') }}" class="btn btn-primary">لیست برندها</a>
                </form>
            </div>
        </div>


    </div>
</div>
