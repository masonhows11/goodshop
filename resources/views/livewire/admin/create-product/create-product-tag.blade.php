<div>
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.product.create.tags',$product->title_persian) }}
    @endsection
    <div class="container-fluid product-color-section">

        <div class="row ms-2 my-3">
            <div class="col-lg-3 col-md-3 col title-product">
                <div class="alert bg-white text-center">
                    {{ __('messages.tags_management') }}
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
                    <div class="row product-tag-form">
                        <div class="col mt-4">
                            <label for="color" class="form-label">{{ __('messages.new_tag') }}</label>
                            <select class="form-control" id="color" wire:model.defer="Tag">
                                <option>{{ __('messages.choose') }}</option>
                                @foreach( $tags as $tag )
                                    <option value="{{ $tag->id}}">{{ $tag->title_persian }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <button type="submit" id="add_attribute" class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.product_list') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mx-2 my-3 product-meta-list bg-white rounded rounded-1">
            <div class="col">
                <table class="table ">
                    <thead>
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.name_persian') }}</th>
                        <th>{{ __('messages.delete_model') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $product->tags()->get() as $tag)
                        <tr class="text-center">
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->title_persian }}</td>
                            <td><a class="mt-3" href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $tag->id }})"><i class="mt-3 fa fa-trash"></i></a></td>
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

