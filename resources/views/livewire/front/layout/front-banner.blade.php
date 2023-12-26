<div>
    @empty($banners)
        <p class="text-center">{{ __('messages.no_data_for_show') }}</p>
    @else
        <div class="row">
            @foreach( $banners as $banner)
            <div class="col-xxl-6 col-xl-6 col-md-6 mb-3">
                <a href="{{ $banner->url }}" target="_blank" class="d-block w-100">
                    <img src="{{ $banner->image_path }}" alt="banner" class="ads-img">
                </a>
            </div>
            @endforeach
        </div>
    @endif
</div>
