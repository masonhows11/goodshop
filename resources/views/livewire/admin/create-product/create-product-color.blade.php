<div>
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.create.product.colors',$product->title_persian) }}
    @endsection
    <div class="container-fluid my-3 product-color-section">

        <div class="row  mx-2">
            <div class="col-lg-3 col-md-3 col title-product">
                <div class="alert bg-white text-center">
                    <h6>{{ __('messages.product_other_color') }}</h6>
                </div>
            </div>
        </div>

        <div class="row mx-2  d-flex flex-column ">
            <div class="col  bg-white">

                <form wire:submit.prevent="save">

                    <div class="row product-color-form">

                        <div class="col-sm-2 mt-4">
                            <label for="color" class="form-label">{{ __('messages.product_color') }}</label>
                            <select class="form-control" id="color" wire:model.defer="color">
                                <option>{{ __('messages.choose') }}</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id}}">{{ $color->title_persian }}</option>
                                @endforeach
                            </select>
                            @error('color')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                       {{-- <div class="col mt-4">
                            <label for="default" class="form-label">{{ __('messages.default_color') }}</label>
                            <select class="form-control" id="default" wire:model.defer="default">
                                <option>{{ __('messages.choose') }}</option>
                                <option value="1">{{ __('messages.yes') }}</option>
                                <option value="0">{{ __('messages.no') }}</option>

                            </select>
                            @error('default')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>--}}



                        <div class="col-sm-2 mt-4">
                            <label for="price_increase" class="form-label">{{ __('messages.price_increase') }}</label>
                            <input type="text" class="form-control" id="price_increase"
                                   wire:model.defer="price_increase">
                            @error('price_increase')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="col-sm-2 mt-4">
                            <label for="salable_quantity" class="form-label">{{ __('messages.salable_quantity') }}</label>
                            <input type="text" class="form-control" id="salable_quantity" wire:model.defer="salable_quantity">
                            @error('salable_quantity')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-sm-2 mt-4">
                            <label for="available_in_stock" class="form-label">{{ __('messages.available_in_stock') }}</label>
                            <input type="text" class="form-control" id="available_in_stock" wire:model.defer="available_in_stock">
                            @error('available_in_stock')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-sm-2 mt-4">
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
                            <button type="submit" id="add_attribute"
                                    class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                            <a href="{{ route('admin.product.create.images',['product'=>$product->id]) }}"
                               class="btn btn-primary btn-sm">{{ __('messages.product_images') }}</a>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('admin.product.index') }}"
                               class="btn btn-secondary btn-sm">{{ __('messages.product_list') }}</a>
                        </div>
                    </div>
                </form>

            </div>


        </div>
        <div class="row mx-2 my-3 product-meta-list bg-white rounded rounded-1 overflow-auto">
            <div class="col">

                <table class="table ">
                    <thead>
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.price_increase') }}</th>
                        <th>{{ __('messages.available_in_stock') }}</th>
                        <th>{{ __('messages.salable_quantity') }}</th>
                        <th>{{ __('messages.product_color') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.edit_model') }}</th>
                        <th>{{ __('messages.delete_model') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product_colors as $color)
                        <tr class="text-center">
                            <td>{{ $color->id }}</td>
                            <td>{{ number_format(floatval($color->price_increase))  }}</td>
                            <td>{{ $color->available_in_stock }}</td>
                            <td>{{ $color->salable_quantity }}</td>
                            <td>{{ $color->color_name }}</td>
                            <td>{{ $color->status == 1 ? __('messages.active') : __('messages.deactivate') }}</td>
                            <td><a class="mt-3" href="javascript:void(0)" wire:click.edit="edit({{$color->id}})"><i class="mt-3 fa fa-edit"></i></a></td>
                            <td><a class="mt-3" href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $color->id }})"><i class="mt-3 fa fa-trash"></i></a></td>
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
