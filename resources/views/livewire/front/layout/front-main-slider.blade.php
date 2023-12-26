@empty($banners)
    <p class="text-center">no slider image</p>
@else
<div>
       <section class="main-slider">
            <div id="main-slider" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    @foreach ( $banners as $key => $slide)
                    <button type="button" data-bs-target="#main-slider" data-bs-slide-to="{{ $loop->index }}" class="active"></button>
                    @endforeach
                </div>
                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    @foreach ( $banners as $banner)
                        <div class="carousel-item @if($loop->first) active @endif">
                            <a href="{{ $banner->url }}" target="_blank" class="d-block w-100">
                                <img src="{{ $banner->image_path }}" class="d-block w-100" alt="image_banner">
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#main-slider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#main-slider" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </section>
</div>
@endif
