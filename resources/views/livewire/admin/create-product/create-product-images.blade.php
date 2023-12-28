<div>
    @section('breadcrumb')
     {{ Breadcrumbs::render('admin.create.product.images',$title->title_persian) }}
    @endsection
    <div class="container-fluid">

        <div class="row mt-5 create-product-image bg-white py-5">


            <div class="col-sm-4 create-product-gallery-form">

                <form wire:submit.prevent="save">
                    <div class="mb-3 d-flex justify-content-center">
                        @if($photo)
                            <img src="{{ $photo->temporaryUrl() }}"
                                 width="250" height="250"
                                 alt="logo_image_path"
                                 class="rounded border border-2 image-product-gallery-preview">
                        @else
                            <img src="{{ asset('dash/images/no-image-icon-23494.png') }}"
                                 width="250" height="250"
                                 alt="logo_image_path"
                                 class="rounded border border-2 image-product-gallery-preview">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">انتخاب تصویر</label>
                        <input type="file" accept="image/*" class="form-control" wire:model.defer="photo" id="photo">
                    </div>
                    <div wire:loading wire:target="photo">در حال بارگزاری...</div>
                    @error('photo')
                    <div class="alert alert-danger">{{ $message}}</div>
                    @enderror
                    <div class="col mt-3 d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                            <a href="{{ route('admin.product.create.colors',['product'=>$product]) }}"
                               class="btn btn-primary btn-sm">{{ __('messages.product_colors') }}</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.product_list') }}</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-8 list-product-image mt-4">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @if($images)
                        @foreach( $images as $image)
                            <div class="col ">
                                <div class="card border border-2 border-active-secondary">
                                    @if ( $image->image_path != null && \Illuminate\Support\Facades\Storage::disk('public')->exists('images/product/gallery/'.$image->image_path) )
                                    <img src="{{ asset('storage/images/product/gallery/'.$image->image_path) }}" class="card-img-top " alt="image-product">
                                    @else
                                        <img src="{{ asset('dash/images/no-image-icon-23494.png') }}"  id="image_view" class="img-thumbnail" height="300" width="300" alt="image">
                                    @endif
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between">
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                               wire:click.prevent="deleteConfirmation({{$image->id}})">حذف</a>
                                            <a class="btn {{ $image->is_active === 1 ?  'btn-success' : 'btn-danger' }}  btn-sm"
                                               wire:click.prevent="active({{$image->id}})" href="#">
                                                {{ $image->is_active === 1  ? __('messages.active') : __('messages.deactivate')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>


        </div>
    </div>

</div>
@push('dash_custom_script')
    <script type="text/javascript">
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
            });
        })
    </script>
    <script>
        const Toast = Swal.mixin({
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
        window.addEventListener('show-result', ({detail: {type, message}}) => {
            Toast.fire({
                icon: type,
                title: message
            })
        })
        @if(session()->has('warning'))
        Toast.fire({
            icon: 'warning',
            title: '{{ session()->get('warning') }}'
        })
        @elseif(session()->has('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
        @endif
    </script>
@endpush
