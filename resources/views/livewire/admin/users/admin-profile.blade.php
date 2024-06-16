<div>
    @section('dash_page_title')
        پروفایل کاربری
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.profile') }}
    @endsection
    <div class="container">


        <div class="row admin-profile-info">
            <form wire:submit.prevent="update">

                <div class="row">

                    <div class="col">
                        <div class="image-wrapper my-5 d-flex flex-column  align-items-center">
                            <div class="image-content   border border-3 rounded-3">
                                @if($image_path)
                                    <img src="{{ $image_path->temporaryUrl() }}" alt="admin_image_path"
                                         class="rounded image-admin-preview">
                                @else
                                    <img class="rounded admin-image"
                                         src="{{ $admin->image_path ?  asset('storage/admin/'.$admin->image_path)  : asset('assets/media/avatars/no-image-icon-23494.png') }}"
                                         alt="">
                                @endif
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="image" class="form-label"> آپلود عکس</label>
                                <input type="file" class="form-control" wire:model="image_path" id="image">
                            </div>
                            @error('image_path')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group my-5">
                            <label for="user" class="form-label">نام کاربری:</label>
                            <input type="text" wire:model.defer="name" class="form-control" id="user">
                            @error('name')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-5">
                            <label for="firstName" class="form-label">نام:</label>
                            <input type="text" wire:model.defer="first_name" class="form-control" id="firstName">
                            @error('first_name')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-5">
                            <label for="lastName" class="form-label">نام خانوادگی:</label>
                            <input type="text" wire:model.defer="last_name" class="form-control" id="lastName">
                            @error('last_name')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-5">
                            <label for="email" class="form-label">ایمیل:</label>
                            <input type="email" wire:model.defer="email" class="form-control" value="{{ $admin->email}}"
                                   id="email">
                            @error('email')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-5 d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">ویرایش اطلاعات</button>
                            <a href="{{  route('admin.change.mobile') }}" class="btn btn-success">تغییر شماره موبایل</a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">بازگشت</a>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

@if(session('success'))
    @push('dash_custom_scripts')
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endpush
@endif
