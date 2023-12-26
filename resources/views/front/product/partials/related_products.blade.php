<div class="row">
    <div class="col-12">
        <div class="title">
            <h4>{{ __('messages.relatedProducts') }}</h4>
        </div>

        @if( $relatedProducts == null)
        @else
            <div class="owl-carousel owl-theme  custom-product-slider">
                @foreach( $relatedProducts as $key => $product)
                    <div class="item"><!-- start item -->
                        <div class="card border-0 custom-card mt-3">
                            <div class="d-flex">
                                <div class="d-flex flex-column product-color">
                                    @foreach( $product->colors()->get() as $color)
                                        <div class="mt-2 mb-2 ms-1 rounded rounded-pill"
                                             style="background-color:{{ $color->color_code }}"></div>
                                    @endforeach
                                </div>
                                <div>
                                    <a href="{{ route('product.details',['product' => $product->slug]) }}"
                                       class="d-block w-100">
                                        <img src="{{ asset('storage/' . $product->thumbnail_image) }}"
                                             alt="{{ asset('storage/' . $product->thumbnail_image) . '-' . ($key) }}"
                                             class="slider-pic">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('product.details',['product' => $product->slug]) }}"
                                   class="product-title">{{ $product->title_persian }}</a>
                                <div class="d-flex justify-content-between">
                                    <div class="mt-3 ps-4">
                                        @guest
                                            <span class="heart"><i class="far fa-heart font-14 text-muted me-2"></i></span>
                                        @endguest
                                        @auth
                                            @if ( $product->user->contains(auth()->user()->id))
                                                <span class="heart" style="font-size: 1.2em; color: Tomato;">
                                                    <i class="fa-solid fa-heart font-14 text-muted me-2"></i>
                                                </span>
                                            @else
                                                <span class="heart">
                                                    <i class="far fa-heart font-14 text-muted me-2"></i>
                                                </span>
                                            @endif
                                        @endauth
                                        <span class="random"><i class="fa fa-random font-14 text-muted me-2"></i></span>
                                        <span class="add-to-cart"><i class="fa fa-cart-plus font-13 text-muted"></i></span>
                                    </div>
                                    <p class="font-13 mt-3 pe-4"> {{ priceFormat($product->origin_price) }} {{ __('messages.toman') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
