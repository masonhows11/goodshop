<div>
    <header class="w-100 d-none header-section d-lg-block bg-white">
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-2 header-logo">
                    <a href="{{ route('home') }}">
                        <h3 class="h3 text-center my-2  text-danger">{{ __('messages.site_name') }}</h3>
                    </a>
                    {{--<img src="front/images/logo.png" alt="goodshop">--}}
                </div>

                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <form action="{{ route('search.products') }}" method="get" class="w-100">
                    <div class="input-group search-box">
                            <input type="search"  name="search" value="{{ request()->search }}" class="form-control form-control-lg" autocomplete="on" placeholder="جستجو در خرید خوب">
                            <button type="submit" class="btn btn-danger"><img src="{{ asset('front/images/search.png') }}" alt="search-img"></button>
                    </div>
                    </form>
                </div>

                @guest
                    <div class="col-lg-3 d-flex align-items-center justify-content-end px-0">
                        <a href="{{ route('auth.login.form') }}" class="header-login-btn me-4"><i
                                class="fa fa-user-lock"></i>ورود / ثبت نام</a>
                    </div>
                @endguest
                @auth
                    <div class="col-lg-3 d-flex align-items-center justify-content-end px-0">
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="header-user-btn  me-4 " data-bs-toggle="dropdown">
                                <i class="fa fa-user mt-2"></i></a>
                            <ul class="dropdown-menu dropdown-menu-custom">
                                <li class="d-flex flex-column justify-content-center align-items-center my-2">
                                    <div>
                                        <img src="{{  Auth::user()->image_path == null ? asset('default_image/no-user.png') : asset('default_image/no-user.png') }}" class="avatar" alt="user-avatar">
                                    </div>
                                    <div class="ms-2">
                                        <a href="{{ route('user.profile') }}" class="font-12 d-block text-info mt-2">مشاهده حساب کاربری <i class="fa fa-chevron-left align-middle mt-1"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="login-link text-center font-14 mt-4 text-dark">
                                        @if(\Illuminate\Support\Facades\Auth::user()->name !== null)
                                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                        @elseif(\Illuminate\Support\Facades\Auth::user()->email !== null)
                                            {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                        @else
                                            {{ __('messages.no_name') }}
                                        @endif
                                    </a>
                                    <a href="{{ route('all.orders') }}" class="login-link my-4"><i
                                            class="fa fa-shopping-basket text-muted font-14 me-1"></i> سفارش های من</a>
                                    <a href="{{ route('favorites') }}" class="login-link my-4"><i
                                            class="fa fa-heart text-muted font-14 me-1"></i>علاقه مندی ها</a>
                                    <a href="{{ route('comments') }}" class="login-link my-4"><i
                                            class="fa fa-comment-alt text-muted font-14 me-1"></i>دیدگاه ها</a>
                                    <a href="{{ route('auth.log.out') }}" class="login-link my-4"><i
                                            class="fas fa-sign-out-alt text-muted font-14 me-1"></i>خروج از حساب کاربری</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth
                @auth
                    <div class="col-lg-1 d-flex align-items-center justify-content-center px-0">
                    <livewire:front.cart.cart-header />
                    </div>
                @endauth
                @guest
                    <div class="col-lg-1 d-flex align-items-center justify-content-center px-0">
                        <a href="{{ route('cart.check') }}" class="position-relative">
                            <img src="{{ asset('front/images/cart.png') }}" alt="cart">
                            <div class="count">0</div>
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <header class="d-lg-none bg-white w-100">
        <div class="container">
            <div class="row py-2">

                <div class="col-7 d-flex justify-content-between flex-wrap">
                    <a href="#mobile-menu" data-bs-toggle="offcanvas">
                        <i class="fa fa-bars mobile-menu-icon mt-2"></i>
                    </a>
                    <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-scroll="true" id="mobile-menu">
                        <div class="offcanvas-header">
                           {{-- <img src="{{ asset('front/images/logo.png') }}">--}}
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                        </div>

                        <div class="offcanvas-body px-0">
                            <ul class="mobile-menu-level-1">
                                <li class="has-mobile-submenu"><a href="javascript:void(0)">دسته بندی محصولات</a>
                                    <ul class="mobile-menu-level-2">
                                        @foreach( $categories as $child )
                                            <li class="has-mobile-submenu-2">
                                                <a href="javascript:void(0)" class="d-inline">{{ $child->title_persian }}</a>
                                                <ul class="mobile-menu-level-3 me-2">
                                                @if( $child->children != null  )
                                                    @include('front.partials.responsive_child_category',['category' => $child->children])
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

                    <a href="{{ route('home') }}">
                        <h3 class="h3 text-center my-2 fw-semibold  text-danger">{{ __('messages.site_name') }}</h3>
                    </a>
                   {{-- <a href="{{ route('home') }}"><img src="{{ asset('front/images/logo.png') }}" class="img-fluid"></a>--}}
                </div>


                @guest
                <div class="col-4 d-flex align-items-center justify-content-end ">
                    <a href="{{ route('auth.login.form') }}" class="header-login-btn me-4 "><i class="fa fa-user-lock mb-4"></i>ورود / ثبت نام</a>
                </div>
                @endguest
                @auth
                <div class="col-4 d-flex align-items-center justify-content-end">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown"><i class="fa fa-user-lock signup-login-icon"></i></a>
                        <ul class="dropdown-menu dropdown-menu-custom">
                            <li class="d-flex">
                                <img src="{{  Auth::user()->image_path == null ? asset('default_image/no-user.png') : asset('default_image/no-user.png') }}" class="avatar" alt="user-avatar">
                                <div class="ms-2">
                                    <a href="{{ route('user.profile') }}" class="font-14 text-dark">
                                        @if(\Illuminate\Support\Facades\Auth::user()->name !== null)
                                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                        @elseif(\Illuminate\Support\Facades\Auth::user()->email !== null)
                                            {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                        @else
                                            {{ __('messages.no_name') }}
                                        @endif
                                    </a>
                                    <a href="{{ route('user.profile') }}" class="font-12 d-block text-info mt-2">مشاهده حساب کاربری <i
                                            class="fa fa-chevron-left align-middle mt-1"></i></a>
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
                @endauth

            </div>
        </div>
    </header>
</div>
