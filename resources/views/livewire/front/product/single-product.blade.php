<div>


    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="breadcrumb-custom">{{ __('messages.good_shopping_online_store') }}</a>
                    </li>
                    @if( !empty($productCategories) )
                        @foreach( $productCategories as $category)
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-custom">{{ $category->title_persian }}</a>
                            </li>
                        @endforeach
                    @endif
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-custom">{{ $product->title_persian }}</a></li>
                </ul>
            </div>
        </div>
    </div><!-- end breadcrumb -->

    <main><!-- start main -->
        <div class="container">

            <!--------------------------->
            <!--------------------------->
            <!--------------------------->
            <!--------------------------->
            <!-- start product content -->
            <div class="product-content">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="row">
                            <div class="col-1 text-center product-icons"><!-- start product icons -->
                                <i class="far fa-heart heart d-block my-4" data-bs-toggle="tooltip"
                                   data-bs-placement="top" title="افزودن به علاقمندی ها"></i>
                                <span data-bs-toggle="modal" data-bs-target="#share-modal"><i
                                        class="fa fa-share-alt share d-block my-4" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="اشتراک گذاری"></i></span>
                                <div class="modal fade" id="share-modal"><!-- start share modal -->
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title font-13">اشتراک گذاری</p>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="font-12">این کالا را با دوستان خود به اشتراک بگذارید!</p>
                                                <a href="#" class="btn btn-share"><i class="fa fa-copy me-2"></i>کپی
                                                    کردن لینک</a>
                                                <div class="d-flex justify-content-center mt-4">
                                                    <a href="#"><i
                                                            class="fab fa-instagram text-danger social-media"></i></a>
                                                    <a href="#"><i
                                                            class="fab fa-telegram text-info social-media"></i></a>
                                                    <a href="#"><i
                                                            class="fab fa-whatsapp text-success social-media"></i></a>
                                                    <a href="#"><i class="fab fa-twitter text-primary social-media"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end share modal -->
                                <i class="fas fa-random random d-block my-4" data-bs-toggle="tooltip"
                                   data-bs-placement="top" title="مقایسه کالا"></i>
                            </div><!-- end product icons -->
                            <div class="col-11 pb-5 mb-3">
                                <!-- start product slider pic -->
                                @if( $images !== null )
                                    <div class="carousel slide pb-5 product-slider-2" id="product-slider"
                                         data-bs-ride="carousel">
                                        <div class="carousel-indicators carousel-indicator-custom">
                                            @foreach ( $images as  $key => $slide)
                                                <button type="button" data-bs-target="#product-slider"
                                                        data-bs-slide-to="{{ $loop->index }}" class="active">
                                                    <img
                                                        src="{{ asset('storage/images/product/images/'. $slide->image_path) }}"
                                                        alt="{{ asset('storage/images/product/images/'. $slide->image_path). '-' .( $key + 1) }}"
                                                        class="d-block w-100">
                                                </button>
                                            @endforeach
                                            {{-- <button type="button" data-bs-target="#product-slider" data-bs-slide-to="1">
                                                 <img src="{{ asset('front/images/product-slider2.jpg') }}" class="d-block w-100">
                                             </button>--}}
                                        </div>
                                        <div class="carousel-inner">
                                            @foreach ( $images as $key =>  $slide)
                                                <div class="carousel-item @if( $loop->first ) active @endif">
                                                    <img
                                                        src="{{ asset('storage/images/product/images/'. $slide->image_path) }}"
                                                        alt="{{ asset('storage/images/product/images/'. $slide->image_path) . '-' . ($key + 1) }}"
                                                        class="d-block w-100">
                                                </div>
                                            @endforeach
                                            {{-- <div class="carousel-item">
                                                 <img src="{{ asset('front/images/product-slider2.jpg') }}" class="d-block w-100">
                                             </div>--}}
                                        </div>
                                    </div>
                                @else
                                    <div class="carousel slide pb-5 product-slider-2" id="product-slider"
                                         data-bs-ride="carousel">
                                        <img src="{{ asset('default_image/no-image-icon-23494.png') }}"
                                             alt="{{  asset('default_image/no-image-icon-23494.png')  }}"
                                             class="d-block w-100">
                                    </div>
                                @endif

                            </div><!-- end product slider pic -->
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-8 product-details"><!-- start product details -->
                        <p>{{ $product->title_persian }}</p>
                        <p class="d-inline-block"><span>دسته بندی :</span><span> {{ $categories }}</span></p>
                        <p class="d-inline-block ms-5"><span>برند :</span> {{ $product->brand->title_persian }}</p>
                        <p class="">انتخاب رنگ : {{ $colorSelectedName  }}</p>

                        {{-- color selector component --}}
                        <p>
                            <livewire:front.product.color-selector :product="$product->id"/>

                        </p>
                        {{-- end color selector component --}}


                        <p class="mt-4">ویژگی های محصول :</p>
                        <ul class="font-13 ps-1">
                            @foreach( $product->values()->get() as $value )
                                <li class="mt-3"><i class="fa fa-check align-middle text-primary me-2"></i>
                                    {{ $value->attribute->title }} : {{ $value->value }} {{ $value->attribute->unit }}
                                </li>
                            @endforeach

                            @foreach( $product->meta as $item )
                                <li class="mt-3"><i class="fa fa-check align-middle text-primary me-2"></i>
                                    {{ $item->meta_key }} : {{ $item->meta_value }}
                                </li>
                            @endforeach
                            {{--
                            <li class="mt-3"><i class="fa fa-check align-middle text-primary me-2"></i> سیستم عامل :
                                 Android
                             </li>
                             <li class="mt-3"><i class="fa fa-check align-middle text-primary me-2"></i>حافظه داخلی : 256
                                 گیگابایت
                             </li>
                             <li class="mt-3"><i class="fa fa-check align-middle text-primary me-2"></i> شبکه های ارتباطی
                                 : 4G، 3G، 2G
                             </li>
                             <li class="mt-3"><i class="fa fa-check align-middle text-primary me-2"></i>دوربین‌های پشت
                                 گوشی : 3 ماژول دوربین
                             </li>
                             --}}
                        </ul>

                        <div class="alert alert-warning font-12 line-height text-justify mt-4">
                            هشدار سامانه همتا: حتما در زمان تحویل دستگاه، به کمک کد فعال‌سازی چاپ شده روی جعبه یا کارت
                            گارانتی، دستگاه را
                            از طریق #7777*، برای سیم‌کارت خود فعال‌سازی کنید. آموزش تصویری در آدرس اینترنتی hmti.ir/05
                        </div>

                    </div><!-- end product details -->
                    @if ( $product->marketable_number == 0 )
                        <div class="col-lg-3 col-md-4">
                            <div class="product-seller-row justify-content-center">
                                <p class="text-center">{{ __('messages.out_of_stock') }}</p>
                            </div>
                            <button type="button" class="btn btn-danger add-cart-btn">
                                خبرم کن اگه موجود شد
                            </button>
                        </div>
                    @else
                        <div class="col-lg-3 col-md-4"><!-- start add to cart box -->
                            <p class="text-danger text-center">{{ $product->activeAmazingSale() ? __('messages.amazing_sale') . ' ' . $product->activeAmazingSale()->percentage . '%' : '' }}</p>
                            <div class="add-cart-box">
                                <div class="product-seller-row">
                                    <span>فروشنده :</span>
                                    <span>{{ __('messages.site_name') }}</span>
                                </div>

                                @if( $warranties->count() !== 0)
                                    @foreach( $warranties as $warranty)
                                        <div class="product-seller-row">
                                            <span>گارانتی:</span>
                                            <span>{{ $warranty->guarantee_name }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="product-seller-row">
                                        <span>گارانتی:</span>
                                        <span>{{ __('messages.no_warranty') }}</span>
                                    </div>
                                @endif

                                <div class="product-seller-row">
                                    <span>وضعیت :</span>
                                    @if( $product->marketable_number >= 3 )
                                        <span>{{ __('messages.available_in_stock') }}</span>
                                    @elseif( $product->marketable_number > 1 && $product->marketable_number < 5 )
                                        <span> فقط {{ $product->marketable_number }} عدد در انبار مانده </span>
                                    @elseif( $product->marketable_number == 0)
                                        <span>{{ __('messages.out_of_stock') }}</span>
                                    @endif
                                </div>
                                <div class="product-seller-row">
                                    <span>قیمت :</span>
                                    <span class="text-danger">{{ priceFormat($product->origin_price) }} تومان </span>
                                </div>

                                {{-- for if product has discount  kind of discount like amazing sale coupon discount or common discount --}}
                                @php
                                    $amazingSale =  $product->activeAmazingSale();
                                @endphp
                                @if($amazingSale == null)
                                @else
                                    <div class="product-seller-row">
                                        <span>تخفیف :</span>
                                        <span class="text-danger">{{ priceFormat($product->origin_price * ($amazingSale->percentage / 100)) }} تومان </span>
                                    </div>
                                @endif
                                @if($amazingSale != null )  {{-- To display the final price if the product has a discount   --}}
                                <div class="product-seller-row">
                                    <span>قیمت نهایی :</span>
                                    <span class="text-danger">{{ priceFormat($product->origin_price - ($product->origin_price * ($amazingSale->percentage / 100))) }} تومان </span>
                                </div>
                                @else  {{--   To display the final price if the product does not have a discount   --}}
                                <div class="product-seller-row">
                                    <span>قیمت نهایی :</span>
                                    <span class="text-danger">{{ priceFormat($product->origin_price) }} تومان </span>
                                </div>
                                @endif

                                <button type="button"
                                        class="btn btn-danger add-cart-btn {{ $product->marketable_number == 0 ? 'disabled' : '' }}">
                                    افزودن به سبد خرید
                                </button>
                            </div>
                        </div><!-- end add to cart box -->
                    @endif
                </div>
            </div>
            <!-- end product content -->
            <!------------------------->
            <!------------------------->
            <!------------------------->
            <!------------------------->

            <div class="d-none d-lg-block product-delivery-icons"><!-- start product delivery icons -->
                <div class="row">
                    <div class="col-6 col-sm text-center"><i class="fa fa-shipping-fast"></i>
                        <p>تحویل اکسپرس</p></div>
                    <div class="col-6 col-sm text-center"><i class="fa fa-headset"></i>
                        <p> پشتیبانی 24 ساعته </p></div>
                    <div class="col-6 col-sm text-center"><i class="fa fa-credit-card"></i>
                        <p>پرداخت در محل</p></div>
                    <div class="col-6 col-sm text-center"><i class="fa fa-box"></i>
                        <p>7 روز ضمانت بازگشت کالا</p></div>
                    <div class="col-12 col-sm text-center"><i class="fa fa-medal"></i>
                        <p>ضمانت اصالت کالا</p></div>
                </div>
            </div><!-- end product delivery icons -->

            {{----  start ads ----}}
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="#" class="d-block" target="_blank">
                        <img src="{{ asset('front/images/ads7.jpg') }}" alt="{{ asset('front/images/ads7.jpg') }}" class="ads-img"></a>
                </div>
            </div>
            {{---- end ads ----}}

            {{---- start product tab content ----}}
            <div class="product-tab-content">
                <div class="row pb-3">
                    <div class="col-12">

                        <ul class="nav nav-pills custom-nav-pills"><!-- start  tabs -->
                            <li class="nav-item"><a href="#description" data-bs-toggle="tab" class="nav-link active">نقد
                                    و بررسی</a></li>
                            <li class="nav-item"><a href="#detail" data-bs-toggle="tab" class="nav-link">مشخصات</a></li>
                            <li class="nav-item"><a href="#comment" data-bs-toggle="tab" class="nav-link">نظرات
                                    کاربران</a></li>
                            <li class="nav-item"><a href="#question" data-bs-toggle="tab" class="nav-link">پرسش و
                                    پاسخ </a></li>
                        </ul><!-- end  tabs -->

                        <div class="tab-content">

                            {{------   start description  ------}}
                            <div class="tab-pane fade show active" id="description">
                                <p class="m-3 font-14">نقد و بررسی اجمالی</p>
                                <p class="m-3 font-13">{{ $product->title_persian }}</p>
                                <p class="font-12 line-height mx-3 text-justify">
                                    {!! $product->short_description !!}
                                </p>
                                <img src="{{ asset('storage/' . $product->thumbnail_image) }}" alt=""
                                     class="mobile-banner">
                                <p class="font-12 line-height  mx-3 text-justify">
                                    {!! $product->full_description !!}
                                </p>
                            </div>
                            {{------   end description  ------}}

                            {{------  start detail  ------}}
                            <div class="tab-pane fade show" id="detail">
                                <p class="mt-3 mx-3 font-14">
                                    <i class="fa fa-chevron-left align-middle text-danger font-12 me-1"></i> مشخصات فنی
                                </p>
                                @foreach( $product->values()->get() as $value )
                                    <div class="row mx-3">
                                        <div class="col-sm-4 mb-2">
                                            <div class="box-line">{{ $value->attribute->title }}</div>
                                        </div>
                                        <div class="col-sm-8 mb-2">
                                            <div
                                                class="box-line">{{ $value->value }} {{ $value->attribute->unit }}</div>
                                        </div>
                                    </div>
                                @endforeach
                                {{--<div class="row mx-3">
                                    <div class="col-sm-4 mb-2">
                                        <div class="box-line">توضیحات سیم کارت</div>
                                    </div>
                                    <div class="col-sm-8 mb-2">
                                        <div class="box-line"> سایز نانو (8.8 × 12.3 میلی‌متر)</div>
                                    </div>
                                </div>

                                <div class="row mx-3">
                                    <div class="col-sm-4 mb-2">
                                        <div class="box-line">وزن</div>
                                    </div>
                                    <div class="col-sm-8 mb-2">
                                        <div class="box-line"> 190 گرم</div>
                                    </div>
                                </div>--}}
                            </div>
                            {{------  end detail  ------ }}

                            {{------  start comment ------}}
                            <div class="tab-pane fade show" id="comment">
                                <livewire:front.comment.add-comment :product="$product_id"/>
                            </div>
                            {{------  end comment ------}}


                            {{------   start question ------}}
                            <div class="tab-pane fade show" id="question">
                                <p class="m-3 font-14">پرسش و پاسخ</p>
                                <p class="m-3 font-13">پرسش خود را در مورد محصول مطرح نمایید</p>

                                <form><!-- start question form -->
                                    <div class="px-3 mb-3">
                                        <textarea class="form-control" rows="5"></textarea>
                                    </div>
                                    <a href="#" class="btn btn-secondary font-13 px-3 py-2 mx-3 mb-3">ثبت پرسش</a>
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" id="check1">
                                        <label class="form-check-label font-12 text-secondary" for="check1">اولین پاسخی
                                            که به پرسش من داده شد، از طریق ایمیل به من اطلاع دهید. </label>
                                    </div>
                                </form><!-- end question form -->

                                <div class="row mx-3 mt-5"><!-- start question box -->
                                    <div class="col-12 question-box">
                                        <div class="question-icon"><i class="fa fa-question"></i></div>
                                        <div class="question-header">
                                            <p>پرسش : <span class="font-13 text-secondary">امیرحسین</span></p>
                                            <p class="font-12 text-secondary">14 اردیبهشت 1402</p>
                                        </div>
                                        <div class="question-body py-3">
                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و
                                                با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه
                                                روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                                                تکنولوژی
                                                مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                            </p>
                                        </div>
                                        <div class="question-footer">
                                            <a href="#" class="font-12 text-info underline">به این پرسش پاسخ دهید</a>
                                        </div>
                                    </div>
                                </div><!-- end question box -->

                                <div class="row mx-3 mt-4 d-flex justify-content-end"><!-- start answer box -->
                                    <div class="col-11 question-box">
                                        <div class="question-icon"><i class="fa fa-store"></i></div>
                                        <div class="question-header">
                                            <p>پاسخ : <span class="font-13 text-secondary">فروشنده</span></p>
                                            <p class="font-12 text-secondary">14 اردیبهشت 1402</p>
                                        </div>
                                        <div class="question-body py-3">
                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و
                                                با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه
                                                روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                                                تکنولوژی
                                                مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- end answer box -->

                            </div>
                            {{------   end question ------}}

                        </div>
                    </div>
                </div>
            </div>
        {{---- end product tab content ----}}


        <!-- start product slider related products -->
            <div class="product-slider">
                <div class="row">
                    <div class="col-12">
                        <div class="title">
                            <h4>{{ __('messages.relatedProducts') }}</h4>
                        </div>
                        @if( $relatedProducts == null)
                            <div class="owl-carousel owl-theme  custom-product-slider">
                                <div class="item"><!-- start item -->
                                    <a href="#">
                                        <div class="card border-0 custom-card mt-3">
                                            <img src="{{ asset('front/images/mobile1.jpg') }}" class="slider-pic">
                                            <div class="card-body">
                                                <a href="#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                                    SM-A217F/DS</a>
                                                <div class="d-flex justify-content-between">
                                                    <div class="mt-3 ps-4">
                                                    <span class="heart"><i
                                                            class="far fa-heart font-14 text-muted me-2"></i></span>
                                                        <span class="random"><i
                                                                class="fa fa-random font-14 text-muted me-2"></i></span>
                                                        <span class="add-to-cart"><i
                                                                class="fa fa-cart-plus font-13 text-muted"></i></span>
                                                    </div>
                                                    <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div><!-- end item -->
                                <div class="item"><!-- start item -->
                                    <a href="#">
                                        <div class="card border-0 custom-card mt-3">
                                            <img src="{{ asset('front/images/mobile2.jpg') }}" class="slider-pic">
                                            <div class="card-body">
                                                <a href="#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                                    SM-A217F/DS</a>
                                                <div class="d-flex justify-content-between">
                                                    <div class="mt-3 ps-4">
                                                    <span class="heart"><i
                                                            class="far fa-heart font-14 text-muted me-2"></i></span>
                                                        <span class="random"><i
                                                                class="fa fa-random font-14 text-muted me-2"></i></span>
                                                        <span class="add-to-cart"><i
                                                                class="fa fa-cart-plus font-13 text-muted"></i></span>
                                                    </div>
                                                    <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div><!-- end item -->
                                <div class="item"><!-- start item -->
                                    <a href="#">
                                        <div class="card border-0 custom-card mt-3">
                                            <img src="{{ asset('front/images/mobile3.jpg') }}" class="slider-pic">
                                            <div class="card-body">
                                                <a href="#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                                    SM-A217F/DS</a>
                                                <div class="d-flex justify-content-between">
                                                    <div class="mt-3 ps-4">
                                                    <span class="heart"><i
                                                            class="far fa-heart font-14 text-muted me-2"></i></span>
                                                        <span class="random"><i
                                                                class="fa fa-random font-14 text-muted me-2"></i></span>
                                                        <span class="add-to-cart"><i
                                                                class="fa fa-cart-plus font-13 text-muted"></i></span>
                                                    </div>
                                                    <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div><!-- end item -->
                                <div class="item"><!-- start item -->
                                    <a href="#">
                                        <div class="card border-0 custom-card mt-3">
                                            <img src="{{ asset('front/images/mobile4.jpg') }}" class="slider-pic">
                                            <div class="card-body">
                                                <a href=#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                                    SM-A217F/DS</a>
                                                <div class="d-flex justify-content-between">
                                                    <div class="mt-3 ps-4">
                                                    <span class="heart"><i
                                                            class="far fa-heart font-14 text-muted me-2"></i></span>
                                                        <span class="random"><i
                                                                class="fa fa-random font-14 text-muted me-2"></i></span>
                                                        <span class="add-to-cart"><i
                                                                class="fa fa-cart-plus font-13 text-muted"></i></span>
                                                    </div>
                                                    <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div><!-- end item -->
                                <div class="item"><!-- start item -->
                                    <a href="#">
                                        <div class="card border-0 custom-card mt-3">
                                            <img src="{{ asset('front/images/mobile2.jpg') }}" class="slider-pic">
                                            <div class="card-body">
                                                <a href="#" class="product-title">گوشی موبایل سامسونگ مدل Galaxy A21S
                                                    SM-A217F/DS</a>
                                                <div class="d-flex justify-content-between">
                                                    <div class="mt-3 ps-4">
                                                    <span class="heart"><i
                                                            class="far fa-heart font-14 text-muted me-2"></i></span>
                                                        <span class="random"><i
                                                                class="fa fa-random font-14 text-muted me-2"></i></span>
                                                        <span class="add-to-cart"><i
                                                                class="fa fa-cart-plus font-13 text-muted"></i></span>
                                                    </div>
                                                    <p class="font-13 mt-3 pe-4">۴,۱۶۹,۰۰۰تومان</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div><!-- end item -->
                            </div>
                        @else

                            <div class="owl-carousel owl-theme  custom-product-slider">
                                @foreach( $relatedProducts as $key => $product)
                                    <div class="item"><!-- start item -->
                                        <div class="card border-0 custom-card mt-3">
                                            <a href="{{ route('product.details',['product' => $product->slug]) }}"
                                               class="d-block w-100">
                                                <img src="{{ asset('storage/' . $product->thumbnail_image) }}"
                                                     alt="{{ asset('storage/' . $product->thumbnail_image) . '-' . ($key) }}"
                                                     class="slider-pic"></a>
                                            <div class="card-body">
                                                <a href="{{ route('product.details',['product' => $product->slug]) }}"
                                                   class="product-title">{{ $product->title_persian }}</a>
                                                <div class="d-flex justify-content-between">
                                                    <div class="mt-3 ps-4">
                                            <span class="heart"><i
                                                    class="far fa-heart font-14 text-muted me-2"></i></span>
                                                        <span class="random"><i
                                                                class="fa fa-random font-14 text-muted me-2"></i></span>
                                                        <span class="add-to-cart"><i
                                                                class="fa fa-cart-plus font-13 text-muted"></i></span>
                                                    </div>
                                                    <p class="font-13 mt-3 pe-4"> {{ priceFormat($product->origin_price) }}
                                                        تومان </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end item -->
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div><!-- end product slider -->
        </div>
    </main><!-- end main -->
</div>
{{--@push('custom_scripts')
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
@endpush--}}
