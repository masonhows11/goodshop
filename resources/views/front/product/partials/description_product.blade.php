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
