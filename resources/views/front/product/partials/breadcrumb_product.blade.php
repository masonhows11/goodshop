<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}"
                       class="breadcrumb-custom">{{ __('messages.good_shopping_online_store') }}</a>
                </li>
                @if( !empty($productCategories) )
                    @foreach( $productCategories as $category)
                        <li class="breadcrumb-item">
                            <a href="#" class="breadcrumb-custom">{{ $category->title_persian }}</a>
                        </li>
                    @endforeach
                @endif
                <li class="breadcrumb-item">
                    <a href="#" class="breadcrumb-custom">{{ $product->title_persian }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
