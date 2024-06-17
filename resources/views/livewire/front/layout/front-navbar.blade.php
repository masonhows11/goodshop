<div>

    <header class="d-lg-none bg-white w-100">
        <div class="container">
            <div class="row py-2">
                <div class="col-7 d-flex flex-wrap">
                    <a href="#mobile-menu" data-bs-toggle="offcanvas">
                        <i class="fa fa-bars mobile-menu-icon mt-2"></i>
                    </a>
                    <a class="ms-2" href="{{ route('home') }}">
                        <h3 class="h3 text-center my-2 fw-semibold  text-danger">{{ __('messages.site_name') }}</h3>
                    </a>
                    <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-scroll="true" id="mobile-menu">
                        <div class="offcanvas-header">
                             <img src="{{ asset('front/images/logo.png') }}">
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
                    <div class="col-4 d-flex align-items-center justify-content-end ">
                        <a class="text-dark" href="{{ route('auth.login.form') }}">ورود / ثبت نام</a>
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
                <li><a href="#">تخفیف‌ها و پیشنهادها</a></li>
                <li class="has-sub-menu"><a href="#">صفحات <i class="fa fa-angle-down"></i></a>
                    <ul class="sub-menu"><!-- start sub menu-->
                        @guest
                            <li><a href="{{ route('auth.login.form') }}">ثبت نام / ورود</a></li>
                        @endguest
                        <li class="has-sub-menu-level-2"><a href="#">محصولات</a><i class="fa fa-angle-down"></i>
                            <ul class="sub-menu-level-2"><!-- start sub menu level 2 -->
                                <li><a href="#">محصول موجود</a></li>
                                <li><a href="#">محصول ناموجود</a></li>
                                <li><a href="#">خطای 404</a></li>
                            </ul><!-- end sub menu level 2 -->
                        </li>
                        <li><a href="#">پروفایل کاربر</a></li>
                        <li><a href="#">وبلاگ</a></li>
                        <li><a href="#">سبد خرید</a></li>
                    </ul><!-- end sub menu-->
                </li>
                <li><a href="{{ route('contact_us') }}">تماس با ما</a></li>
                <li><a href="{{ route('about_us') }}">درباره ما</a></li>
            </ul>
        </div>
    </nav>
</div>


