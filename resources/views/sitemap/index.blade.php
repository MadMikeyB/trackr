<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ route('sitemap.pages') }}</loc>
        <lastmod>{{ now()->parse('2 June 2018')->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
</sitemapindex>
