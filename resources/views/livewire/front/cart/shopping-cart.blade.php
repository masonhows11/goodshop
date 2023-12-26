<div>
    <main>
        <div class="container">

            <div class="row d-flex justify-content-center">
                @if( count($cartItems) < 1  )
                    <div class="col-lg-9 mb-5" style="height: 280px">
                        <div class="cart-content my-4 d-flex justify-content-center align-items-center h-425px" style="height: 280px">
                               <div>
                                   <p class="text-center">{{ __('messages.your_shopping_cart_is_empty') }}</p>
                               </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-9">
                        <div class="cart-content">
                            <div class="title">
                                <h4> سبد خرید </h4>
                            </div>

                            @php
                                $totalProductPrice = 0;
                                $totalDiscount = 0;
                            @endphp

                        @foreach( $cartItems as $cartItem )
                                @php
                                    $totalProductPrice += $cartItem->cartItemProductPrice();
                                    $totalDiscount += $cartItem->cartItemProductDiscount();
                                @endphp

                                <div class="row shopping-cart-item">

                                    <div class="col-lg-1 col-md-2">
                                        <div class="d-block border-dark border-bottom text-center">{{ $cartItem->id }}</div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <a href="{{ route('product.details',$cartItem->product->slug) }}" class="d-block"><img src="{{ asset('storage/' . $cartItem->product->thumbnail_image) }}" alt="cart-item-image" class="img-fluid mb-3"></a>
                                    </div>
                                    <div class="col-lg-5 col-md-6">
                                        <a href="javascript:void(0)" class="shopping-cart-title">{{ $cartItem->product->title_persian }}</a>
                                        <p class="shopping-cart-detail"> {{ __('messages.numbers') }}: {{ $cartItem->number  }} </p>

                                        @if(!empty($cartItem->color))
                                            <p class="shopping-cart-detail"> {{ __('messages.product_color') }}: {{ $cartItem->color->color_name }} </p>
                                        @else
                                            <p class="shopping-cart-detail">{{ __('messages.no_color_has_been_selected_for_this_product') }}</p>
                                        @endif

                                        @if(!empty($cartItem->warranty))
                                            <p class="shopping-cart-detail"> {{ __('messages.warranty') }}: {{ $cartItem->warranty->guarantee_name }} </p>
                                        @else
                                            <p class="shopping-cart-detail">{{ __('messages.no_warranty_has_been_selected_for_this_product') }}</p>
                                        @endif

                                        <p class="shopping-cart-detail"> {{ __('messages.price') }}   {{ priceFormat( $cartItem->cartItemProductPrice() ) }} {{ __('messages.toman') }}</p>

                                        @if( !empty($cartItem->product->activeAmazingSale()))
                                            <p class="shopping-cart-detail text-danger">{{ __('messages.cart_discount') }} {{ priceFormat( $cartItem->cartItemProductDiscount() ) }} </p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 ">
                                        <div class="button-container d-flex justify-content-start align-items-start mb-3">
                                            <button class="cart-qty-plus" wire:click="increaseItem({{ $cartItem->id  }})" type="button" value="+">+</button>
                                            <input type="text" name="qty" min="1" class="qty form-control text-center" value="{{ $cartItem->number }}">
                                            <button class="cart-qty-minus" @if( $cartItem->number  == 1 ) disabled @endif @if( $this->disabled == true ) disabled @endif wire:click="decreaseItem({{ $cartItem->id }})" type="button" value="-">-</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-12 d-flex justify-content-center align-items-center cart-items-op">
                                        <a href="javascript:void(0)"  wire:click.prevent="deleteConfirmation({{ $cartItem->id }})"><i class="fa  fa-trash"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif


                @if( count($cartItems) > 0)
                    <div class="col-lg-3">
                        <div class="cart-content">
                            <div class="product-seller-row">
                                <span>{{ __('messages.seller') }}</span>
                                <span>{{ __('messages.good_shopping_online_store') }}</span>
                            </div>
                            @php
                                $cartItemsCount = null;
                                 foreach( $cartItems as $item ){
                                      $cartItemsCount += $item->number;
                                  }
                            @endphp

                            <div class="product-seller-row">
                                <span>{{ __('messages.quantity') }}</span>
                                <span> {{ $cartItemsCount }} عدد </span>
                            </div>
                            <div class="product-seller-row">
                                <span>{{ __('messages.total_price') }}</span>
                                <span class="text-danger"> {{ priceFormat($totalProductPrice) }} {{ __('messages.toman') }} </span>
                            </div>
                            <div class="product-seller-row">
                                <span>{{ __('messages.order_discount_amount') }}  </span>
                                <span class="text-danger">{{  priceFormat( $totalDiscount ) }} {{ __('messages.toman') }}</span>
                            </div>
                            <div class="product-seller-row">
                                <span>{{ __('messages.delivery_amount') }}</span>
                                <span class="text-danger">وابسته به آدرس</span>
                            </div>
                            <div class="product-seller-row">
                                <span>{{ __('messages.final_price') }}</span>
                                <span class="text-danger"> {{ priceFormat( $totalProductPrice - $totalDiscount   ) }} {{ __('messages.toman') }}</span>
                            </div>

                            <a href="{{ route('check.address') }}" class="btn btn-danger add-cart-btn">ادامه و ثبت سفارش</a>
                            <p class="font-12 text-muted mt-3 line-height text-center">
                            {{ __('messages.register_the_goods_in_your_basket_are_not_reserved_complete_the_next_steps_to_place_an_order') }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>


        </div>
    </main>
</div>
@push('front_custom_scripts')
    <script type="text/javascript">
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: 'javascript:void(0)3085d6',
                cancelButtonColor: 'javascript:void(0)d33',
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
        window.addEventListener('show-result', ({detail: { type, message }}) => {
            Swal.fire({
                icon: type,
                text: message,
            });
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
