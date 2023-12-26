<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>
    <sitemap>
        <loc>{{ url('sitemap.xml/products') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap.xml/categories') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap.xml/tags') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap.xml/static') }}</loc>
    </sitemap>
</sitemapindex>
{{--<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($post as $value)
        <url>
            <loc>
                {{ urldecode(route('Post.show',$value->id.'-'.$value->title)) }}
            </loc>
            <lastmod>{{ $value->updated_at }}</lastmod>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
            <image:image>
                <image:loc>
                    {{ asset($value->Picture) }}
                </image:loc>
                <image:caption>جاب تیم</image:caption>
                <image:title>{{ $value->title }}</image:title>
            </image:image>
        </url>
    @endforeach
</urlset>--}}
