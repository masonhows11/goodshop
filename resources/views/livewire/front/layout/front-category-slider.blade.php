<div>
    @if( $products === null  )
        <div class="product-slider">
            <div class="row">
                <div class="col-12">
                    <div class="title">
                        <h4>گوشی موبایل</h4>
                    </div>
                    <div class="owl-carousel owl-theme custom-product-slider">

                        <div class="item"><!-- start item -->
                            <div class="card border-0 custom-card mt-3">
                                <a href="#" class="d-block w-100"><img src="{{ asset('front/images/mobile1.jpg') }}"
                                                                       class="slider-pic"></a>
                                <div class="card-body">
                                    <a href="#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                        SM-A217F/DS</a>
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-3 ps-4">
                                            <span class="heart"><i
                                                    class="far fa-heart font-14 text-muted me-2"></i></span>
                                            <span class="random"><i
                                                    class="fa fa-random font-14 text-muted me-2"></i></span>
                                            <span class="add-to-cart"><i class="fa fa-cart-plus font-13 text-muted"></i></span>
                                        </div>
                                        <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end item -->

                        <div class="item"><!-- start item -->
                            <div class="card border-0 custom-card mt-3">
                                <a href="#" class="d-block w-100"><img src="{{ asset('front/images/mobile2.jpg') }}"
                                                                       class="slider-pic"></a>
                                <div class="card-body">
                                    <a href="#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                        SM-A217F/DS</a>
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-3 ps-4">
                                            <span class="heart"><i
                                                    class="far fa-heart font-14 text-muted me-2"></i></span>
                                            <span class="random"><i
                                                    class="fa fa-random font-14 text-muted me-2"></i></span>
                                            <span class="add-to-cart"><i class="fa fa-cart-plus font-13 text-muted"></i></span>
                                        </div>
                                        <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end item -->

                        <div class="item"><!-- start item -->
                            <div class="card border-0 custom-card mt-3">
                                <a href="#" class="d-block w-100">
                                    <img src="{{ asset('front/images/mobile3.jpg') }}" class="slider-pic">
                                </a>
                                <div class="card-body">
                                    <a href="#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                        SM-A217F/DS</a>
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-3 ps-4">
                                            <span class="heart"><i
                                                    class="far fa-heart font-14 text-muted me-2"></i></span>
                                            <span class="random"><i
                                                    class="fa fa-random font-14 text-muted me-2"></i></span>
                                            <span class="add-to-cart"><i class="fa fa-cart-plus font-13 text-muted"></i></span>
                                        </div>
                                        <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end item -->
                        <div class="item"><!-- start item -->
                            <div class="card border-0 custom-card mt-3">
                                <a href="#" class="d-block w-100">
                                    <img src="{{ asset('front/images/mobile4.jpg') }}" class="slider-pic">
                                </a>
                                <div class="card-body">
                                    <a href="#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                        SM-A217F/DS</a>
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-3 ps-4">
                                            <span class="heart"><i
                                                    class="far fa-heart font-14 text-muted me-2"></i></span>
                                            <span class="random"><i
                                                    class="fa fa-random font-14 text-muted me-2"></i></span>
                                            <span class="add-to-cart"><i class="fa fa-cart-plus font-13 text-muted"></i></span>
                                        </div>
                                        <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end item -->

                        <div class="item"><!-- start item -->
                            <div class="card border-0 custom-card mt-3">
                                <a href="#" class="d-block w-100">
                                    <img src="{{ asset('front/images/mobile2.jpg') }}" class="slider-pic">
                                </a>
                                <div class="card-body">
                                    <a href="#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                        SM-A217F/DS</a>
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-3 ps-4">
                                            <span class="heart"><i
                                                    class="far fa-heart font-14 text-muted me-2"></i></span>
                                            <span class="random"><i
                                                    class="fa fa-random font-14 text-muted me-2"></i></span>
                                            <span class="add-to-cart"><i class="fa fa-cart-plus font-13 text-muted"></i></span>
                                        </div>
                                        <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end item -->
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="product-slider">
            <div class="row">
                <div class="col-12">
                    <div class="title">
                        <h4>{{ $category_name }}</h4>
                    </div>
                    <div class="owl-carousel owl-theme custom-product-slider">
                        @foreach( $products as $key => $product)
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
                                                @if( $product->thumbnail_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->thumbnail_image ) )
                                                    <img src="{{ asset('storage/' . $product->thumbnail_image) }}"
                                                         alt="{{  $product->title_persian . '-' . $key }}"
                                                         class="slider-pic">
                                                @else
                                                    <img src="{{ asset('default_image/no-image-icon-23494.png') }}"
                                                         alt="no-product-image" class="slider-pic">
                                                @endif
                                            </a>
                                        </div>
                                    </div>


                                    <div class="card-body">
                                        <a href="{{ route('product.details',['product' => $product->slug]) }}"
                                           class="product-title">{{ $product->title_persian }}</a>
                                        <div class="d-flex justify-content-between">
                                            <div class="mt-3 ps-4">
                                                @guest
                                                    <span class="heart">
                                                        <i class="far fa-heart heart font-14 text-muted me-2"
                                                           data-url="{{ route('product.add.to.favorites',$product )}}"></i>
                                                    </span>
                                                @endguest
                                                @auth
                                                    @if ( $product->user->contains(auth()->user()->id))
                                                        <span class="heart" style="font-size: 1.2em;color:tomato">
                                                            <i class="fa-solid fa-heart heart font-14 text-muted me-2"
                                                               data-bs-toggle="tooltip"
                                                               data-bs-placement="top"
                                                               style="color: Tomato;"
                                                               title="{{ __('messages.remove_from_favorites') }}"
                                                               data-url="{{ route('product.add.to.favorites',$product )}}"></i>
                                                        </span>
                                                    @else
                                                        <span class="heart">
                                                            <i class="far fa-heart heart font-14 text-muted me-2"
                                                               data-bs-toggle="tooltip"
                                                               data-bs-placement="top"
                                                               title="{{ __('messages.add_to_favorites') }}"
                                                               data-url="{{ route('product.add.to.favorites',$product )}}"></i>
                                                        </span>
                                                    @endif
                                                @endauth
                                                <span class="random"><i
                                                        class="fa fa-random font-14 text-muted me-2"></i></span>
                                                <span class="add-to-cart"><i
                                                        class="fa fa-cart-plus font-13 text-muted"></i></span>
                                            </div>
                                            <p class="font-13 mt-3 pe-4"> {{ priceFormat($product->origin_price) }} {{ __('messages.toman') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end item -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
