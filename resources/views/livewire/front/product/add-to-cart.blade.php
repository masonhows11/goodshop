<div>
    @if ( $product->available_in_stock == 0 )
        <div class="col border border-1 rounded-3 py-5 px-2">
            <div class="product-seller-row d-flex justify-content-center">
                <p class="text-center">{{ __('messages.out_of_stock') }}</p>
            </div>
            <div>
                <button type="button" class="btn btn-danger add-cart-btn">
                   {{ __('messages.keep_me_update_if_exists') }}
                </button>
            </div>
        </div>
    @else

        <p class="text-danger text-center">
            {{ $product->activeAmazingSale() ? __('messages.amazing_sale') . ' ' . $product->activeAmazingSale()->percentage . '%' : '' }}
        </p>

        <div class="add-cart-box">

            <div class="product-seller-row">
                <span>{{ __('messages.seller') }}</span>
                <span>{{ __('messages.site_name') }}</span>
            </div>

            {{-- availble stock from product table --}}
            <div class="product-seller-row">
                <span>{{ __('messages.status') }} :</span>
                @if( $product->available_in_stock >= 3 )
                    <span>{{ __('messages.available_in_stock') }}</span>
                @elseif( $product->available_in_stock > 1 && $product->available_in_stock < 5 )
                    <span> {{ __('messages.just') }} {{ $product->available_in_stock}} {{ __('messages.number_left_in_stock') }} </span>
                @elseif( $product->available_in_stock == 0)
                    <span>{{ __('messages.out_of_stock') }}</span>
                @endif
            </div>

            {{-------------------------------}}
            {{---- default price section ----}}
            @if( $changePrice == false)

                @if( $defaultPriceByColor != null )
                    {{-- default price +  color if product has default color  --}}
                    <div class="product-seller-row">
                        <span>{{ __('messages.price') }}</span>
                        <span class="text-danger">{{ priceFormat($defaultPriceByColor) }} {{ __('messages.toman') }} </span>
                    </div>
                @else
                    <div class="product-seller-row">
                        <span>{{ __('messages.price') }}</span>
                        <span class="text-danger">{{ priceFormat($product->origin_price) }} {{ __('messages.toman') }} </span>
                    </div>
                @endif

            @else
                {{--change price when change color of product --}}
                <div class="product-seller-row">
                    <span>{{ __('messages.price') }}</span>
                    <span class="text-danger">{{ priceFormat($newPriceByColor) }} {{ __('messages.toman') }} </span>
                </div>
            @endif



            {{--------------------------}}
            {{---- discount section ----}}
            @if( $amazingSale != null && $defaultPriceByColor != null )
                <div class="product-seller-row">
                    <span>{{ __('messages.cart_discount') }}:</span>
                    <span class="text-danger">
                        {{ priceFormat( $defaultPriceByColor * ($amazingSale->percentage / 100)) }} {{ __('messages.toman') }}
                    </span>
                </div>
            @elseif( $amazingSale != null && $newPriceByColor != null )
                <div class="product-seller-row">
                    <span>{{ __('messages.cart_discount') }}:</span>
                    <span class="text-danger">
                        {{ priceFormat( $newPriceByColor * ($amazingSale->percentage / 100)) }} {{ __('messages.toman') }}
                    </span>
                </div>
            @elseif( $amazingSale != null )
                <div class="product-seller-row">
                    <span>{{ __('messages.cart_discount') }}:</span>
                    <span class="text-danger">
                        {{ priceFormat($product->origin_price * ($amazingSale->percentage / 100)) }} {{ __('messages.toman') }}
                    </span>
                </div>
            @else
            @endif


            {{--------------------------}}
            {{---- warranty section ----}}
            @if( $hasWarranty == false )
            @else
                <div class="product-seller-row">
                    <span>{{ __('messages.warranty') }}</span>
                    <span class="text-danger">{{ priceFormat($warrantyPrice) }} {{ __('messages.toman') }} </span>
                </div>
            @endif




            {{-- final price section --}}

            @if( $changePrice == false)

                @if( $amazingSale != null && $defaultPriceByColor == null )
                    <div class="product-seller-row">
                        <span> {{ __('messages.final_price') }}</span>
                        <span class="text-danger">{{ priceFormat($product->AmazingSaleOnOriginPrice()) }} {{ __('messages.toman') }} </span>
                    </div>
                @elseif( $defaultPriceByColor != null )
                    <div class="product-seller-row">
                        <span> {{ __('messages.final_price') }}</span>
                        @if( $amazingSale != null && $hasWarranty == false )
                            <span class="text-danger">
                                {{  priceFormat($product->AmazingSaleOnDefaultColorPrice($defaultPriceByColor))   }} {{ __('messages.toman') }}
                            </span>
                        @elseif( $amazingSale != null && $hasWarranty == true )
                            <span class="text-danger">
                                {{   priceFormat( $product->AmazingSaleOnDefaultColorPrice($defaultPriceByColor) + $warrantyPrice )  }} {{ __('messages.toman') }}
                            </span>
                        @else
                            <span class="text-danger">
                                {{  $warrantyPrice != null ? priceFormat($defaultPriceByColor + $warrantyPrice) : priceFormat($defaultPriceByColor) }} {{ __('messages.toman') }}
                            </span>
                        @endif
                    </div>
                @else
                    <div class="product-seller-row">
                        <span>{{ __('messages.final_price') }}</span>
                        <span class="text-danger">{{ priceFormat($product->origin_price) }} {{ __('messages.toman') }} </span>
                    </div>
                @endif

            @else
                <div class="product-seller-row">
                    <span>{{ __('messages.final_price') }}</span>
                    @if( $amazingSale != null && $hasWarranty == false )
                        <span class="text-danger">{{  priceFormat( $product->AmazingSaleOnChangeColorPrice($newPriceByColor)) }} {{ __('messages.toman') }} </span>
                    @elseif (  $amazingSale != null && $hasWarranty == true )
                        <span class="text-danger">{{   priceFormat( $product->AmazingSaleOnChangeColorPrice($newPriceByColor) + $warrantyPrice)  }} {{ __('messages.toman') }} </span>
                    @else
                        <span class="text-danger">{{ $warrantyPrice != null ?  priceFormat($newPriceByColor + $warrantyPrice) : priceFormat($newPriceByColor) }} {{ __('messages.toman') }} </span>
                    @endif
                </div>
            @endif
            
            <button type="button" wire:click="addToCart({{ $product->id }})"
                    class="btn btn-danger add-cart-btn {{ $product->available_in_stock == 0 ? 'disabled' : '' }}">
               {{ __('messages.add_to_cart') }}
            </button>

            @if( session()->has('message'))
                <div class="alert alert-danger mt-4 font-12">
                    {{ session()->get('message') }}
                </div>
            @endif

        </div>
    @endif
        {{-- <span class="text-danger"> {{ priceFormat($product->origin_price - ($product->origin_price * ($amazingSale->percentage / 100))) }} {{ __('messages.toman') }} </span>--}}
        {{-- <span class="text-danger">{{  priceFormat( $defaultPriceByColor - ( $defaultPriceByColor * ($amazingSale->percentage / 100)))   }} تومان </span> --}}
        {{-- <span class="text-danger">{{  priceFormat( $newPriceByColor - ( $newPriceByColor * ($amazingSale->percentage / 100)))   }} تومان </span>--}}
</div>
@push('custom_scripts')
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
