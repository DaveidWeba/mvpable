@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'type' => null,
])

@php
    $meta = \App\Support\Seo::forPage($title, $description, $image, $type);
    $canonical = url()->current();
    $keywords = $meta['keywords'] ?? [];
    $themeColor = data_get(config('branding'), 'theme_color', '#0b1220');

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $meta['site_name'],
        'url' => $canonical,
        'description' => $meta['description'],
    ];

    if (! empty($meta['image'])) {
        $schema['image'] = $meta['image'];
        $schema['publisher'] = [
            '@type' => 'Organization',
            'name' => $meta['site_name'],
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $meta['image'],
            ],
        ];
    }
@endphp

<title>{{ $meta['title'] }}</title>
<meta name="description" content="{{ $meta['description'] }}">
@if (! empty($keywords))
    <meta name="keywords" content="{{ implode(', ', $keywords) }}">
@endif
<meta name="robots" content="{{ $meta['robots'] }}">
<meta name="theme-color" content="{{ $themeColor }}">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:title" content="{{ $meta['title'] }}">
<meta property="og:description" content="{{ $meta['description'] }}">
<meta property="og:type" content="{{ $meta['type'] }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:site_name" content="{{ $meta['site_name'] }}">
@if (! empty($meta['image']))
    <meta property="og:image" content="{{ $meta['image'] }}">
@endif

<meta name="twitter:card" content="{{ $meta['twitter_card'] }}">
@if (! empty($meta['twitter_site']))
    <meta name="twitter:site" content="{{ $meta['twitter_site'] }}">
@endif
<meta name="twitter:title" content="{{ $meta['title'] }}">
<meta name="twitter:description" content="{{ $meta['description'] }}">
@if (! empty($meta['image']))
    <meta name="twitter:image" content="{{ $meta['image'] }}">
@endif

<script type="application/ld+json">{{ json_encode($schema, JSON_UNESCAPED_SLASHES) }}</script>
