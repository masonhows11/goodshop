<div>

    <header class="d-lg-none bg-white w-100">
        <div class="container">
            <div class="row d-flex py-2">
                <div class="col-6 d-flex flex-wrap">
                    <a href="#mobile-menu" data-bs-toggle="offcanvas">
                        <i class="fa fa-bars mobile-menu-icon mt-2"></i>
                    </a>
                    <a class="ms-2" href="{{ route('home') }}">
                        <h3 class="h3 text-center my-2 fw-semibold  text-danger">{{ __('messages.site_name') }}</h3>
                    </a>
                    <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-scroll="true" id="mobile-menu">
                        <div class="offcanvas-header">
                            <h3 class="h3 text-center my-2 fw-semibold  text-danger">{{ __('messages.site_name') }}</h3>
                             {{-- <img src="{{ asset('front/images/logo.png') }}"> --}}
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                        </div>

                        <div class="offcanvas-body px-0">
                            <ul class="mobile-menu-level-1">
                                <li class="has-mobile-submenu"><a href="javascript:void(0)">دسته بندی محصولات</a>
                                    <ul class="mobile-menu-level-2">
                                        @foreach ($categories as $child)
                                            <li class="has-mobile-submenu-2">
                                                <a href="javascript:void(0)"
                                                    class="d-inline">{{ $child->title_persian }}</a>
                                                <ul class="mobile-menu-level-3 me-2">
                                                    @if ($child->children != null)
                                                        @include('front.partials.responsive_child_category', [
                                                            'category' => $child->children,
                                                        ])
                                                    @endif
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="#">تخفیف‌ها و پیشنهادها</a></li>
                                <li class="has-mobile-submenu"><a href="#">صفحات</a>

                                    <ul class="mobile-menu-level-2">
                                        @guest
                                            <li><a href="{{ route('auth.login.form') }}">ثبت نام / ورود</a></li>
                                        @endguest
                                        <li class="has-mobile-submenu-2"><a href="#"> محصولات </a></li>
                                        @auth
                                            <li><a href="{{ route('user.profile') }}">پروفایل کاربر</a></li>
                                        @endauth
                                        <li><a href="#">وبلاگ</a></li>
                                    </ul>

                                </li>
                                <li><a href="{{ route('contact_us') }}">تماس با ما</a></li>
                                <li><a href="{{ route('about_us') }}">درباره ما</a></li>
                            </ul>

                        </div>
                    </div>
                </div>

                @guest
                    <div class="col-4 d-flex align-items-center justify-content-end">
                        <a class="text-dark" href="{{ route('auth.login.form') }}">ورود / ثبت نام</a>
                    </div>

                    <div class="col-2 d-flex align-items-center justify-content-end">
                        <a href="{{ route('auth.login.form') }}" class="position-relative">
                            <img src="{{ asset('front/images/cart.png') }}">
                            <div class="count">0</div>
                        </a>
                    </div>
                @endguest

                @auth
                    <div class="col-4 d-flex align-items-center justify-content-end">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"><i class="fa fa-user-lock signup-login-icon"></i></a>
                            <ul class="dropdown-menu dropdown-menu-custom">
                                <li class="d-flex">
                                    <img src="{{ Auth::user()->image_path == null ? asset('default_image/no-user.png') : asset('default_image/no-user.png') }}"
                                        class="avatar" alt="user-avatar">
                                    <div class="ms-2">
                                        <a href="{{ route('user.profile') }}" class="font-14 text-dark">
                                            @if (\Illuminate\Support\Facades\Auth::user()->name !== null)
                                                {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                            @elseif(\Illuminate\Support\Facades\Auth::user()->email !== null)
                                                {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                            @else
                                                {{ __('messages.no_name') }}
                                            @endif
                                        </a>
                                        <a href="{{ route('user.profile') }}" class="font-12 d-block text-info mt-2">مشاهده
                                            حساب کاربری <i class="fa fa-chevron-left align-middle mt-1"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{ route('all.orders') }}" class="login-link"><i
                                            class="fa fa-shopping-basket text-muted font-14 me-1"></i> سفارش های من</a>
                                    <a href="{{ route('favorites') }}" class="login-link my-4"><i
                                            class="fa fa-heart text-muted font-14 me-1"></i>علاقه مندی ها</a>
                                    <a href="{{ route('auth.log.out') }}" class="login-link"><i
                                            class="fas fa-sign-out-alt text-muted font-14 me-1"></i>خروج از حساب کاربری</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-1 d-flex align-items-center justify-content-end">
                        <a href="#shopping-cart-responsive" class="position-relative" data-bs-toggle="offcanvas">
                            <img src="front/images/cart.png">
                            <div class="count">2</div>
                        </a>
                        <div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" id="shopping-cart-responsive">

                            <div class="offcanvas-header">
                                <p class="offcanvas-title font-12">سبد خرید (4 کالا)</p>
                                <button type="button" class="text-reset btn-close" data-bs-dismiss="offcanvas"></button>
                            </div>

                            <div class="offcanvas-body">
                                <div class="row">
                                    <div class="col-4"><img src="front/images/mobile1.jpg" class="img-fluid img-thumbnail"></div>
                                    <div class="col-8 d-flex align-items-center">
                                        <a href="product.html" class="cart-product-title">گوشی موبایل سامسونگ مدل Galaxy A21S SM-A217F/DS</a>
                                    </div>
                                </div>
                                <div class="row my-3 border-bottom">
                                    <div class="col-6 d-flex">
                                        <span class="number">1 عدد</span>
                                        <span class="color" style="background-color:#d4d4d4;"></span>
                                        <i class="fa fa-trash cart-delete-btn"></i>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <p class="cart-product-price">4,169,000 تومان</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row cart-footer">
                               <div class="col-5">
                                    <p>مبلغ قابل پرداخت:</p>
                                    <p>12,480,000 تومان</p>
                               </div>
                               <div class="col-7">
                                <a href="login.html" class="btn btn-info font-13 btn-lg ms-4">ورود و ثبت سفارش</a>
                               </div>
                            </div>

                        </div>
                    </div>
                @endauth

            </div>
        </div>
    </header>

    <nav class="d-none d-lg-block navigation">
        <div class="container">
            <ul class="main-menu">
                <li class="has-mega-menu"><a href="#"> دسته بندی محصولات <i class="fa fa-angle-down"></i></a>
                    <ul class="row mega-menu"><!-- start mega menu-->
                        @foreach ($categories as $child)
                            <li class="col-3 mega-menu-box">
                                <ul>
                                    <li class="menu-title">
                                        <a href="{{ route('search.category', ['slug' => $child->slug]) }}"><i
                                                class="fa fa-angle-left me-2"></i>{{ $child->title_persian }}</a>
                                    </li>
                                    @if ($child->children != null)
                                        @include('front.partials.child_category', [
                                            'category' => $child->children,
                                        ])
                                    @endif
                                </ul>
                            </li>
                        @endforeach
                        <li class="col-12 d-flex justify-content-end mega-menu-box">
                            <a href="#" class="d-block"><img src="{{ asset('front/images/menu-pic.jpg') }}"
                                    class="img-fluid rounded mt-3"></a>
                        </li>
                    </ul><!-- end mega menu-->
                </li>
                <li><a href="{{  route('not_found') }}">تخفیف‌ها و پیشنهادها</a></li>
                <li class="has-sub-menu"><a href="javascript:void(0)">صفحات <i class="fa fa-angle-down"></i></a>
                    <ul class="sub-menu"><!-- start sub menu-->
                        @guest
                            <li><a href="{{ route('auth.login.form') }}">ثبت نام / ورود</a></li>
                        @else
                        <li><a href="{{ route('user.profile') }}">پروفایل کاربر</a></li>
                        <li><a href="{{ route('cart.check') }}">سبد خرید</a></li>
                        @endguest
                        <li><a href="{{  route('not_found') }}">وبلاگ</a></li>

                    </ul><!-- end sub menu-->
                </li>
                <li><a href="{{ route('contact_us') }}">تماس با ما</a></li>
                <li><a href="{{ route('about_us') }}">درباره ما</a></li>
            </ul>
        </div>
    </nav>
</div>


