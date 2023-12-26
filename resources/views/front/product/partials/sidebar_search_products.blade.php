<div class="custom-sidebar">
    <p class="font-12 border-bottom pb-2">دسته بندی ها</p>
    <div class="category-section accordion">
        @include('front.category.categories' ,['categories' => $categories])
    </div>

</div>
<form action="{{ route('search.products') }}" method="get">



    <div class="custom-sidebar">
        <p class="font-12 border-bottom pb-2">جستجو در نتایج</p>
        <div class="search-in-result  position-relative mt-3">
            <input type="search" name="search" value="{{ request()->search }}" class="form-control"
                   placeholder=" نام محصول یا برند مورد نظر ">
            <input type="hidden" name="sort" value="{{ request()->sort }}">
        </div>
    </div>

   {{-- <div class="custom-sidebar">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="send">
            <label class="form-check-label font-12" for="send">فقط ارسال فوری</label>
        </div>
    </div>

    <div class="custom-sidebar">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="product">
            <label class="form-check-label font-12" for="product">فقط کالاهای موجود</label>
        </div>
    </div>--}}


    <div class="custom-sidebar">
        <p class="font-12 border-bottom pb-2">برند</p>
        <div class="mt-3 px-2 brands-select">
            @forelse( $brands as $brand )
                <div class="form-check mb-3">
                    <input type="checkbox"
                           @if ( request()->brands && in_array($brand->id ,request()->brands ) ) checked
                           @endif name="brands[]" value="{{ $brand->id }}" class="form-check-input"
                           id="brand-{{ $brand->id }}">
                    <label class="form-check-label font-12"
                           for="brand-{{ $brand->id }}">{{ $brand->title_persian }}</label>
                </div>
            @empty
                <div class="form-check mb-3">
                    <label class="form-check-label font-12"
                           for="brand">{{ __('messages.no_brand_found') }}</label>
                </div>
            @endforelse

        </div>
    </div>



    <div class="custom-sidebar">
        <p class="font-12 border-bottom pb-2">انتخاب رنگ</p>
        @forelse( $colors as $color)
            <div>
                <label class="select-color mt-2">
                    <span class="color-shape" style="background-color: {{ $color->code }};"></span>
                    <input type="radio" name="colors[]" value="{{ $color->id }}">
                    <span class="color-name">{{ $color->title_persian }}</span>
                </label>
            </div>
        @empty
            <label for="" class="mt-2">
                {{ __('messages.not_record_found') }}
            </label>
        @endforelse
    </div>

    <div class="custom-sidebar">
        <p class="font-12 border-bottom pb-2">محدوده قیمت (تومان)</p>
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-between mt-2">
                <div>{{ __('messages.from') }}
                    : {{ priceFormat($min_price) .' ' . __('messages.toman') }}</div>
                <div>{{ __('messages.to') }}
                    : {{ priceFormat($max_price) .' ' . __('messages.toman') }} </div>
            </div>
            <div class="d-flex flex-column mt-2">
                <div class="mt-1"><input type="number" value="{{ request()->min_price }}"
                                         min="{{$min_price}}" name="min_price" class="form-control"
                                         placeholder="از قیمت..."></div>
                <div class="mt-1"><input type="number" value="{{ request()->max_price }}"
                                         min="{{$min_price}}" max="{{$max_price}}" name="max_price"
                                         class="form-control" placeholder="تا قیمت..."></div>
            </div>

        </div>

        <button type="submit" class="btn btn-info font-13 w-100 mt-3">
            <i class="fa fa-filter align-middle font-12 me-2"></i>فیلتر
        </button>
    </div>
</form>
