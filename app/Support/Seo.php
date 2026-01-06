<?php

namespace App\Support;

class Seo
{
    public static function defaults(): array
    {
        $branding = config('branding', []);
        $seo = $branding['seo'] ?? [];

        $siteName = (string) data_get($branding, 'name', config('app.name', 'Laravel'));
        $title = (string) ($seo['title'] ?? $siteName);
        $description = (string) ($seo['description'] ?? data_get($branding, 'description', ''));
        $image = $seo['image'] ?? data_get($branding, 'assets.og_image');
        $keywords = $seo['keywords'] ?? [];
        $twitter = data_get($branding, 'social.x');

        return [
            'title' => $title,
            'site_name' => $siteName,
            'description' => $description,
            'image' => self::absoluteUrl($image),
            'keywords' => $keywords,
            'robots' => $seo['robots'] ?? 'index,follow',
            'type' => $seo['og_type'] ?? 'website',
            'twitter_card' => $seo['twitter_card'] ?? 'summary_large_image',
            'twitter_site' => $twitter ? self::normalizeHandle($twitter) : null,
        ];
    }

    public static function forPage(
        ?string $title = null,
        ?string $description = null,
        ?string $image = null,
        ?string $type = null
    ): array {
        $defaults = self::defaults();

        if ($title) {
            $defaults['title'] = $title.' - '.$defaults['site_name'];
        }

        if ($description) {
            $defaults['description'] = $description;
        }

        if ($image) {
            $defaults['image'] = self::absoluteUrl($image);
        }

        if ($type) {
            $defaults['type'] = $type;
        }

        return $defaults;
    }

    public static function absoluteUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return url($path);
    }

    public static function normalizeHandle(string $handle): string
    {
        return str_starts_with($handle, '@') ? $handle : '@'.$handle;
    }
}
