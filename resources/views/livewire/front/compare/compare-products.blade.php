<div>
    @if ( $compare_products->count() > 0 )
        <div class="row row-cols-1  row-cols-md-4 g-2 compare-products-list">
            @foreach( $compare_products as $item)
                <div class="col">
                    <div class="card  mt-2 mb-2">
                        <a href="{{ route('product.details',$item->slug) }}">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('storage/' . $item->thumbnail_image) }}" width="160" height="170" class=" mt-2" alt="...">
                            </div>
                            <div class="card-body">
                                <p class="card-text text-center font-13">{{ Str::limit($item->title_persian,55) }}</p>
                            </div>
                            <div class="card-body">
                                <div>
                                    <a href="{{ route('product.details',$item->slug) }}" class="btn btn-danger add-cart-btn">
                                        {{ __('messages.add_to_cart') }}
                                    </a>
                                </div>
                                <div class="text-center">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-trash" wire:click.prevent="deleteConfirmation({{ $item->id }})"></i>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="my-3">
            {{ __('messages.specifications') }}
        </div>
        <div class="row mb-2 compare-products-list-details">
            <div class="col-2">
                <div class="d-flex flex-column">
                        <div class="font-13 border-bottom p-2 mt-2">{{ __('messages.name_persian')  }}</div>
                        <div class="font-13 border-bottom p-2 mt-3">{{ __('messages.name_english') }}</div>
                        <div class="font-13 border-bottom p-2 mt-3">{{ __('messages.weight')  }}</div>
                        <div class="font-13 border-bottom p-2 mt-2">{{ __('messages.length') }}</div>
                        <div class="font-13 border-bottom p-2 mt-2">{{ __('messages.width') }}</div>
                        <div class="font-13 border-bottom p-2 mt-2">{{ __('messages.height') }}</div>
                </div>
            </div>
            <div class="col-10">
                <div class="row row-cols-1  row-cols-md-4 g-2">
                    @foreach( $compare_products as $item)
                        <div class="col">
                            <ul class="list-group mt-2">
                                <li class="list-group-item font-13 text-center">{{ Str::limit($item->title_persian,50)  }}</li>
                                <li class="list-group-item font-13 text-center">{{ Str::limit($item->title_english,40) }}</li>
                                <li class="list-group-item font-13">{{ intval($item->weight) }} {{ __('messages.gram') }}</li>
                                <li class="list-group-item font-13">{{ intval($item->length) }} {{ __('messages.centimeter') }}</li>
                                <li class="list-group-item font-13">{{ intval($item->width) }}  {{ __('messages.centimeter') }}</li>
                                <li class="list-group-item font-13">{{ intval($item->height) }} {{ __('messages.centimeter') }}</li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    @else
        <div class="row d-flex justify-content-center align-items-center no-compare-products">
            <div class="col d-flex justify-content-center align-items-center" style="height: 300px">
                <p class="text-center">{{ __('messages.no_product_found') }}</p>
            </div>
        </div>
    @endif

    @push('front_custom_scripts')
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
    @endpush


</div>
