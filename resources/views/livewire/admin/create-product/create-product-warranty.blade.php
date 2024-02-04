<div>
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.create.product.warranty',$product->title_persian) }}
    @endsection
    <div class="container-fluid">

        <div class="row  my-3">
            <div class="col-lg-3 col-md-3 col title-product">
                <div class="alert bg-white text-center">
                    {{ __('messages.warranty') }}
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col title-product">
                <div class="alert bg-white text-center">
                    {{ $product->title_persian }}
                </div>
            </div>
        </div>

        <div class="row  mt-2 ">
            <div class="col bg-white">
                <form wire:submit.prevent="save">
                    <div class="row product-warranty">
                        <div class="col-sm-4 mt-3 mb-3">
                            <label for="title" class="form-label">{{ __('messages.title') }}</label>
                            <input type="text" class="form-control" id="title" wire:model.defer="title">
                            @error('title')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-4 mt-3 mb-3">
                            <label for="price_increase" class="form-label">{{ __('messages.price_increase') }}</label>
                            <input type="text" class="form-control" id="price_increase" wire:model.defer="price_increase">
                            @error('price_increase')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-4 mt-3 mb-3">
                            <label for="status" class="form-label">{{ __('messages.status') }}</label>
                            <select class="form-select" id="status" wire:model.defer="status">
                                <option>{{ __('messages.choose') }}</option>
                                <option value="1">{{ __('messages.active') }}</option>
                                <option value="0">{{ __('messages.deactivate') }}</option>
                            </select>
                            @error('status')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <button type="submit" id="add_attribute" class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                            <a href="{{ route('admin.product.create.meta',['product' => $product->id]) }}" class="btn btn-primary btn-sm">{{ __('messages.product_meta') }}</a>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.product_list') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row mt-2 warranty-list  bg-white overflow-auto">
            <div class="my-5">
                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.product_name') }}</th>
                        <th>{{ __('messages.price_increase') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.edit_model') }}</th>
                        <th>{{ __('messages.delete_model') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $warranties as $warranty)
                        <tr class="text-center">
                            <td>{{ $warranty->id }}</td>
                            <td>{{ $warranty->guarantee_name }}</td>
                            <td>{{ $warranty->product->title_persian }}</td>
                            <td>{{ priceFormat($warranty->price_increase) }} تومان</td>
                            <td><a class="btn {{ $warranty->status === 1 ?  'btn-success' : 'btn-danger' }}  btn-sm"
                                   href="#">
                                    {{ $warranty->status === 1  ? __('messages.active') : __('messages.deactivate')}}
                                </a></td>
                            <td> <a href="javascript:void(0)" wire:click.edit="edit({{ $warranty->id }})"><i class="mt-3 fa fa-edit"></i></a></td>
                            <td> <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $warranty->id }})" class=""><i class="mt-3 fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-lg-2 col-md-2 ">
                {{ $warranties->links() }}
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
        @if( session()->has('warning') )
        Toast.fire({
            icon: 'warning',
            title: '{{ session()->get('warning') }}'
        })
        @elseif( session()->has('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
        @endif
    </script>
@endpush
