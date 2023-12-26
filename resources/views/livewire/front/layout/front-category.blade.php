@empty($categories)
<div>
    <div class="category-box">
        <h4>دسته‌بندی‌های خرید خوب</h4>
        <div class="row">
            <div class="col-4 col-md-3 col-lg text-center"><a href="search.html"><i class="fas fa-laptop"></i><p>کالای دیجیتال</p><p class="text-info">+825000 کالا</p></a></div>
            <div class="col-4 col-md-3 col-lg text-center"><a href="search.html"><i class="fas fa-tools"></i><p> ابزار و تجهیزات </p><p class="text-info">+146000 کالا</p></a></div>
            <div class="col-4 col-md-3 col-lg text-center"><a href="search.html"><i class="fas fa-tshirt"></i><p>مد و پوشاک</p><p class="text-info">+658000 کالا</p></a></div>
            <div class="col-4 col-md-3 col-lg text-center"><a href="search.html"><i class="fas fa-baby-carriage"></i><p>کودک و نوزاد</p><p class="text-info">+69000 کالا</p></a></div>
            <div class="col-4 col-md-3 col-lg text-center"><a href="search.html"><i class="fas fa-shopping-basket"></i><p>کالاهای سوپرمارکتی</p><p class="text-info">+60000 کالا</p></a></div>
            <div class="col-4 col-md-3 col-lg text-center"><a href="search.html"><i class="fas fa-heartbeat"></i><p>زیبایی و سلامت</p><p class="text-info">+98000 کالا</p></a></div>
            <div class="col-4 col-md-3 col-lg text-center"><a href="search.html"><i class="fas fa-couch"></i><p>خانه و آشپزخانه</p><p class="text-info">+477000 کالا</p></a></div>
            <div class="col-4 col-md-3 col-lg text-center"><a href="search.html"><i class="fas fa-pencil-ruler"></i><p>کتاب و لوازم تحریر </p><p class="text-info">+251000 کالا</p></a></div>
            <div class="col-4 col-md col-lg text-center"><a href="search.html"><i class="fas fa-campground"></i><p>ورزش و سفر</p><p class="text-info">+31000 کالا</p></a></div>
        </div>
    </div>
</div>
@else
    <div>
        <div class="category-box">
            <h4>دسته‌بندی‌های خرید خوب</h4>
            <div class="row">
                @foreach( $categories as $category)
                <div class="col-4 col-md-3 col-lg text-center">
                    <a href="#">
                        <img src="{{ $category->image_path ? asset('storage/images/category/'.$category->image_path) : asset('default_image/no-image-icon-23494.png') }}" height="64" width="64"  class="mt-2 mb-2" alt="category-image"><p class="mb-2">{{ $category->title_persian }}</p><p class="text-info">+825000 کالا</p></a>
                </div>
                @endforeach
             </div>
        </div>
    </div>
@endif

