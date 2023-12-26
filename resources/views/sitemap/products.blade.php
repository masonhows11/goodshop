<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach( $products as $value)
        <url>
            <loc>
                {{ urldecode(route('product.details',$value->slug)) }}
            </loc>
            <lastmod>{{ $value->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
            @if( $value->thumbnail_image)
                <image:image>
                    <image:loc>
                        {{ asset('storage/'.$value->thumbnail_image) }}
                    </image:loc>
                    <image:caption>{{ __('messages.site_name_english') }}</image:caption>
                    <image:title>{{ $value->title_persian }}</image:title>
                </image:image>
            @endif
        </url>
    @endforeach
</urlset>
