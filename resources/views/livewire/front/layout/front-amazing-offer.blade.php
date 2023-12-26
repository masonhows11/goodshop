<div>
    @if( $amazingSales != null )
        <div class="best-suggestion">
            <div class="row">
                <div class="col-4 col-lg-2 text-center">
                    <img src="{{ asset('front/images/best-suggest-1.png') }}"
                         alt="{{ asset('front/images/best-suggest-1.png') }}" class="best-suggest-pic">
                    <a href="#" class="btn best-suggest-btn">مشاهده همه<i
                            class="fa fa-angle-left ms-1 align-middle"></i></a>
                </div>
                <div class="col-8 col-lg-10">
                    <div class="owl-carousel owl-theme best-suggestion-slider">
                        @foreach( $amazingSales as $sale)
                            <div class="item">
                                <a href="{{ route('product.details',['product' => $sale->product->slug]) }}"
                                   class="d-block">
                                    <div class="card border-0 custom-card">
                                        <img src="{{ asset('storage/' . $sale->product->thumbnail_image) }}"
                                             class="slider-pic">
                                        <div class="card-body">
                                            <p class="font-14 text-dark text-center mt-2">{{ $sale->product->title_persian }}</p>
                                            <div class="d-flex justify-content-between px-3">
                                                <span class="badge bg-danger text-white rounded-pill font-13">{{ $sale->percentage }} % </span>
                                                @php
                                                    $final_price = $sale->product->origin_price - (( $sale->product->origin_price *  20) / 100)
                                                @endphp
                                                <span class="font-13"> تومان {{ priceFormat( $final_price )  }}</span>
                                            </div>
                                            <del
                                                class="text-muted font-13 float-end me-3">{{ priceFormat($sale->product->origin_price) }}</del>
                                        </div>
                                        <div
                                            class="card-footer bg-white border-top-0 d-flex justify-content-end w-100 pe-4">
                                            <div class="count-down-timer timer" data-minutes-left="60"></div>
                                            <i class="far fa-clock me-2"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="best-suggestion">
        <div class="row">
            <div class="col-4 col-lg-2 text-center">
                <img src="{{ asset('front/images/best-suggest-1.png') }}"
                     alt="{{ asset('front/images/best-suggest-1.png') }}" class="best-suggest-pic">
                <a href="#" class="btn best-suggest-btn">مشاهده همه<i class="fa fa-angle-left ms-1 align-middle"></i></a>
            </div>
            <div class="col-8 col-lg-10">
                <div class="owl-carousel owl-theme best-suggestion-slider">
                    <div class="item"><!-- start item -->
                        <a href="#" class="d-block">
                            <div class="card border-0 custom-card">
                                <img src="{{ asset('front/images/bs-1.jpg') }}" class="slider-pic">
                                <div class="card-body">
                                    <p class="font-14 text-dark text-center mt-2">هدفون بلوتوثی لیتو مدل L4</p>
                                    <div class="d-flex justify-content-between px-3">
                                        <span class="badge bg-danger text-white rounded-pill font-13">30%</span>
                                        <span class="font-13">950,000 تومان</span>
                                    </div>
                                    <del class="text-muted font-13 float-end me-3">1,200,000</del>
                                </div>
                                <div
                                    class="card-footer bg-white border-top-0 d-flex justify-content-end w-100 pe-4">
                                    <div class="count-down-timer timer" data-minutes-left="60"></div>
                                    <i class="far fa-clock me-2"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item"><!-- start item -->
                        <a href="#" class="d-block">
                            <div class="card border-0 custom-card">
                                <img src="{{ asset('front/images/bs-2.jpg') }}" class="slider-pic">
                                <div class="card-body">
                                    <p class="font-14 text-dark text-center mt-2">هندزفری مدل PD-BT121</p>
                                    <div class="d-flex justify-content-between px-3">
                                        <span class="badge bg-danger text-white rounded-pill font-13">10%</span>
                                        <span class="font-13">250,000 تومان</span>
                                    </div>
                                    <del class="text-muted font-13 float-end me-3">300,000</del>
                                </div>
                                <div
                                    class="card-footer bg-white border-top-0 d-flex justify-content-end w-100 pe-4">
                                    <div class="count-down-timer timer" data-minutes-left="60"></div>
                                    <i class="far fa-clock me-2"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item"><!-- start item -->
                        <a href="#" class="d-block">
                            <div class="card border-0 custom-card">
                                <img src="{{ asset('front/images/bs-3.jpg') }}" class="slider-pic">
                                <div class="card-body">
                                    <p class="font-14 text-dark text-center mt-2">کفش کوهنوردی کد AH21-X</p>
                                    <div class="d-flex justify-content-between px-3">
                                        <span class="badge bg-danger text-white rounded-pill font-13">25%</span>
                                        <span class="font-13">1,200,000 تومان</span>
                                    </div>
                                    <del class="text-muted font-13 float-end me-3">1,400,000</del>
                                </div>
                                <div
                                    class="card-footer bg-white border-top-0 d-flex justify-content-end w-100 pe-4">
                                    <div class="count-down-timer timer" data-minutes-left="60"></div>
                                    <i class="far fa-clock me-2"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item"><!-- start item -->
                        <a href="#" class="d-block">
                            <div class="card border-0 custom-card">
                                <img src="{{ asset('front/images/bs-4.jpg') }}" class="slider-pic">
                                <div class="card-body">
                                    <p class="font-14 text-dark text-center mt-2">ساعت دیجیتال مدل 2023</p>
                                    <div class="d-flex justify-content-between px-3">
                                        <span class="badge bg-danger text-white rounded-pill font-13">50%</span>
                                        <span class="font-13">1300,000 تومان</span>
                                    </div>
                                    <del class="text-muted font-13 float-end me-3">2,600,000</del>
                                </div>
                                <div
                                    class="card-footer bg-white border-top-0 d-flex justify-content-end w-100 pe-4">
                                    <div class="count-down-timer timer" data-minutes-left="60"></div>
                                    <i class="far fa-clock me-2"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item"><!-- start item -->
                        <a href="#" class="d-block">
                            <div class="card border-0 custom-card">
                                <img src="{{ asset('front/images/bs-5.jpg') }}" class="slider-pic">
                                <div class="card-body">
                                    <p class="font-14 text-dark text-center mt-2">ساک ورزشی لکسین مدل LX014</p>
                                    <div class="d-flex justify-content-between px-3">
                                        <span class="badge bg-danger text-white rounded-pill font-13">15%</span>
                                        <span class="font-13">450,000 تومان</span>
                                    </div>
                                    <del class="text-muted font-13 float-end me-3">600,000</del>
                                </div>
                                <div
                                    class="card-footer bg-white border-top-0 d-flex justify-content-end w-100 pe-4">
                                    <div class="count-down-timer timer" data-minutes-left="60"></div>
                                    <i class="far fa-clock me-2"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @empty($banners)
        <p class="text-center">{{ __('messages.no_data_for_show') }}</p>
    @else
        <div class="row">
            @foreach($banners as $banner)
                <div class="col-xxl-3 col-xl-3 mt-2 col-md-3 col-6 mb-3">
                    <a href="{{ $banner->url }}" target="_blank" class="d-block w-100">
                        <img src="{{ $banner->image_path }}" alt="amazing-banners" class="ads-img">
                    </a>
                </div>
            @endforeach
        </div>
    @endempty
</div>
