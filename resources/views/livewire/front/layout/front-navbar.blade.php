<div>
    <nav class="d-none d-lg-block navigation">
        <div class="container">
            <ul class="main-menu">
                <li class="has-mega-menu"><a href="#"> دسته بندی محصولات <i class="fa fa-angle-down"></i></a>
                    <ul class="row mega-menu"><!-- start mega menu-->
                        @foreach( $categories as $child )
                        <li class="col-3 mega-menu-box">
                            <ul>
                                <li class="menu-title">
                                    <a href="{{ route('search.category',['slug' => $child->slug]) }}"><i class="fa fa-angle-left me-2"></i>{{ $child->title_persian }}</a>
                                </li>
                                    @if( $child->children != null  )
                                        @include('front.partials.child_category',['category' => $child->children])
                                    @endif
                            </ul>
                        </li>
                        @endforeach
                        <li class="col-12 d-flex justify-content-end mega-menu-box" >
                            <a href="#" class="d-block"><img src="{{ asset('front/images/menu-pic.jpg') }}" class="img-fluid rounded mt-3"></a>
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
