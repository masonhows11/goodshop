<div>
    @empty($brands)
        <div class="product-slider">
            <div class="row">
                <div class="col-12">
                    <div class="title">
                        <h4>برندهای ویژه</h4>
                    </div>
                    <div class="owl-carousel owl-theme custom-product-slider">

                        <div class="item"><!-- start item -->
                            <a href="search.html" class="d-block">
                                <div class="card border-0 custom-card mt-3">
                                    <img src="front/images/brands1.jpg" class="brands-pic">
                                </div>
                            </a>
                        </div><!-- end item -->
                        <div class="item"><!-- start item -->
                            <a href="search.html" class="d-block">
                                <div class="card border-0 custom-card mt-3">
                                    <img src="front/images/brands2.jpg" class="brands-pic">
                                </div>
                            </a>
                        </div><!-- end item -->
                        <div class="item"><!-- start item -->
                            <a href="search.html" class="d-block">
                                <div class="card border-0 custom-card mt-3">
                                    <img src="front/images/brands3.jpg" class="brands-pic">
                                </div>
                            </a>
                        </div><!-- end item -->
                        <div class="item"><!-- start item -->
                            <a href="search.html" class="d-block">
                                <div class="card border-0 custom-card mt-3">
                                    <img src="front/images/brands4.jpg" class="brands-pic">
                                </div>
                            </a>
                        </div><!-- end item -->
                        <div class="item"><!-- start item -->
                            <a href="search.html" class="d-block">
                                <div class="card border-0 custom-card mt-3">
                                    <img src="front/images/brands5.jpg" class="brands-pic">
                                </div>
                            </a>
                        </div><!-- end item -->
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="product-slider">
            <div class="row">
                <div class="col-12">
                    <div class="title">
                        <h4>برندهای ویژه</h4>
                    </div>
                    <div class="owl-carousel owl-theme custom-product-slider">
                        @foreach ( $brands as $brand)
                            <div class="item">
                                <a href="{{ route('search.products',['brands[]' => $brand->id] ) }}" class="d-block">
                                    <div class="card border-0 custom-card mt-3">
                                        @if( $brand->logo_path && \Illuminate\Support\Facades\Storage::disk('public')->exists('images/'.$brand->logo_path))
                                            <img height="150" width="150" alt="brand-logo" class="brands-pic" src="{{  asset('storage/images/'.$brand->logo_path) }}">
                                        @else
                                            <img height="150" width="150" class="brands-pic" src="{{  asset('default_image/no-image-icon-23494.png') }}" alt="brand-logo">
                                        @endif
                                    </div>
                                    <p class="text-center">{{ $brand->title_persian }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endempty
</div>

