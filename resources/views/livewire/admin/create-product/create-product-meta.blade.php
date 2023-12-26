<div>
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.create.product.meta',$product->title_persian) }}
    @endsection
    <div class="container-fluid product-meta-section">

        <div class="row ms-2 my-3">
            <div class="col-lg-3 col-md-3 col title-product">
                <div class="alert bg-white text-center">
                    {{ __('messages.product_meta') }}
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col title-product">
                <div class="alert bg-white text-center">
                    {{ $product->title_persian }}
                </div>
            </div>
        </div>

        <div class="row mx-2 my-3 d-flex flex-column ">

            <div class="col  bg-white">

                <form wire:submit.prevent="save">

                    <div class="row product-meta-form">
                        <div class="col-4 mt-5 mb-5">
                            <label for="meta_key" class="form-label">{{ __('messages.product_meta_key') }}</label>
                            <input type="text" class="form-control" id="meta_key" wire:model.defer="meta_key">
                            @error('meta_key')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-4 mt-5 mb-5">
                            <label for="meta_value" class="form-label">{{ __('messages.product_meta_value') }}</label>
                            <input type="text" class="form-control" id="meta_value" wire:model.defer="meta_value">
                            @error('meta_value')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col">
                            <button type="submit" id="add_attribute" class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                            <a href="{{ route('admin.product.create.images',['product'=>$product->id]) }}" class="btn btn-primary btn-sm">{{ __('messages.product_images') }}</a>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.product_list') }}</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>


        <div class="row mx-2 my-3 product-meta-list bg-white">
           <div class="col">

               <table class="table">
                   <thead>
                   <tr class="text-center">
                       <th>{{ __('messages.id') }}</th>
                       <th>{{ __('messages.product_meta_key') }}</th>
                       <th>{{ __('messages.product_meta_value') }}</th>
                       <th>{{ __('messages.edit_model') }}</th>
                       <th>{{ __('messages.delete_model') }}</th>
                   </tr>
                   </thead>
                   <tbody>
                     @foreach($metas as $meta)
                        <tr class="text-center">
                            <td>{{ $meta->id }}</td>
                            <td>{{ $meta->meta_key }}</td>
                            <td>{{ $meta->meta_value }}</td>
                            <td><a class="mt-3" href="javascript:void(0)" wire:click.edit="edit({{$meta->id}})"><i class="mt-3 fa fa-edit"></i></a></td>
                            <td><a class="mt-3" href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $meta->id }})"><i class="mt-3 fa fa-trash"></i></a></td>
                        </tr>
                     @endforeach
                   </tbody>
               </table>

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
