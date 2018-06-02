<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{route('static.landing')}}</loc>
        <lastmod>{{ now()->parse('2 June 2018')->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{route('static.pricing')}}</loc>
        <lastmod>{{ now()->parse('2 June 2018')->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{route('static.features')}}</loc>
        <lastmod>{{ now()->parse('2 June 2018')->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{route('static.privacy')}}</loc>
        <lastmod>{{ now()->parse('2 June 2018')->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{route('static.terms')}}</loc>
        <lastmod>{{ now()->parse('2 June 2018')->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset>
