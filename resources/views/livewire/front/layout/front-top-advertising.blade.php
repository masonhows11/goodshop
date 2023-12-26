@empty($banner)

@else
<div>
    <div class="d-none d-lg-block top-ads">
        <a href="{{ $banner->url }}" target="_blank"><img src="{{ $banner->image_path }}" alt="top-ads-banner"></a>
    </div>
</div>
@endempty
