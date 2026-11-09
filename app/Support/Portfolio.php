<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\URL;

class Portfolio
{
    public static function text(mixed $value, ?string $locale = null): string
    {
        $locale ??= app()->getLocale();

        if (is_array($value)) {
            $picked = $value[$locale] ?? $value['en'] ?? '';

            return is_string($picked) ? $picked : '';
        }

        return is_string($value) ? $value : '';
    }

    /**
     * @return list<string>
     */
    public static function lines(mixed $value, ?string $locale = null): array
    {
        $locale ??= app()->getLocale();

        if (! is_array($value)) {
            return [];
        }

        $picked = $value[$locale] ?? $value['en'] ?? [];

        if (is_string($picked)) {
            return [$picked];
        }

        if (! is_array($picked)) {
            return [];
        }

        return array_values(array_filter($picked, 'is_string'));
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function caseStudies(): array
    {
        return array_values(config('portfolio.case_studies', []));
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function findCaseStudy(string $slug): ?array
    {
        foreach (self::caseStudies() as $study) {
            if (($study['slug'] ?? null) === $slug) {
                return $study;
            }
        }

        return null;
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function samples(): array
    {
        $samples = [];

        foreach (config('portfolio.samples', []) as $slug => $sample) {
            $kind = $sample['kind'] ?? ['en' => '', 'ar' => ''];
            $screenshots = [];
            foreach ($sample['screens'] ?? [] as $image) {
                $screenshots[] = self::enrichShot($image, $kind);
            }
            $thumbPath = (string) ($sample['thumb'] ?? '');
            $thumb = $thumbPath !== ''
                ? self::enrichShot([
                    'src' => $thumbPath,
                    'width' => 640,
                    'height' => 400,
                    'caption' => [
                        'en' => 'Representative mockup · '.self::text($kind, 'en'),
                        'ar' => 'نموذج تمثيلي · '.self::text($kind, 'ar'),
                    ],
                    'alt' => [
                        'en' => 'Representative mockup cover for '.self::text($kind, 'en').'. Not a client project.',
                        'ar' => 'غلاف نموذج تمثيلي لـ '.self::text($kind, 'ar').'. ليس مشروع عميل.',
                    ],
                ], $kind)
                : ($screenshots[0] ?? null);

            $samples[] = [
                'slug' => $slug,
                'kind' => $kind,
                'thumb' => $thumb,
                'screenshots' => $screenshots,
                'strips' => self::sampleStrips($slug, $screenshots),
            ];
        }

        return $samples;
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function findSample(string $slug): ?array
    {
        foreach (self::samples() as $sample) {
            if ($sample['slug'] === $slug) {
                return $sample;
            }
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $image
     * @param  array<string, string>  $kind
     * @return array<string, mixed>
     */
    private static function enrichShot(array $image, array $kind): array
    {
        $src = (string) ($image['src'] ?? '');
        $jpeg = preg_replace('/\.webp$/', '.jpg', $src) ?? $src;
        $width = (int) ($image['width'] ?? 1440);
        $height = (int) ($image['height'] ?? 900);
        $caption = $image['caption'] ?? [
            'en' => 'Representative mockup · '.self::text($kind, 'en'),
            'ar' => 'نموذج تمثيلي · '.self::text($kind, 'ar'),
        ];
        $alt = $image['alt'] ?? [
            'en' => self::text($caption, 'en').'. Not a client project.',
            'ar' => self::text($caption, 'ar').'. ليس مشروع عميل.',
        ];

        $webpUrl = self::fileUrl($src);
        $jpegUrl = is_file(public_path($jpeg)) ? asset($jpeg) : null;
        $srcset = $webpUrl.' '.$width.'w';
        if ($jpegUrl !== null) {
            $srcset .= ', '.$jpegUrl.' '.$width.'w';
        }

        return [
            'src' => $src,
            'jpeg' => $jpegUrl !== null ? $jpeg : null,
            'width' => $width,
            'height' => $height,
            'caption' => $caption,
            'alt' => $alt,
            'srcset' => $srcset,
            'sizes' => $width <= 400 ? '(max-width: 640px) 90vw, 320px' : '(max-width: 1024px) 100vw, 640px',
            'screen' => self::screenIdFromSrc($src),
        ];
    }

    private static function fileUrl(string $relative): string
    {
        return is_file(public_path($relative)) ? asset($relative) : asset('images/work/placeholder.svg');
    }

    private static function screenIdFromSrc(string $src): string
    {
        $base = basename($src, '.webp');

        return (string) preg_replace('/-(desktop|mobile)$/', '', $base);
    }

    /**
     * @param  list<array<string, mixed>>  $screenshots
     * @return list<array<string, mixed>>
     */
    private static function sampleStrips(string $slug, array $screenshots): array
    {
        $seen = [];
        $strips = [];
        foreach ($screenshots as $shot) {
            $screen = (string) ($shot['screen'] ?? '');
            if ($screen === '' || isset($seen[$screen])) {
                continue;
            }
            $seen[$screen] = true;
            $stripSrc = 'images/works/'.$slug.'/'.$screen.'-strip.webp';
            if (! is_file(public_path($stripSrc))) {
                continue;
            }
            $strips[] = [
                'screen' => $screen,
                'src' => $stripSrc,
                'width' => 160,
                'height' => 100,
                'caption' => $shot['caption'] ?? ['en' => '', 'ar' => ''],
            ];
        }

        return $strips;
    }

    public static function imageUrl(array $image): string
    {
        $relative = ltrim((string) ($image['src'] ?? ''), '/');

        if ($relative !== '' && is_file(public_path($relative))) {
            return asset($relative);
        }

        return asset('images/work/placeholder.svg');
    }

    public static function imageMissing(array $image): bool
    {
        $relative = ltrim((string) ($image['src'] ?? ''), '/');

        return $relative === '' || ! is_file(public_path($relative));
    }

    public static function whatsappDigits(): string
    {
        return preg_replace('/\D+/', '', (string) config('portfolio.contact.whatsapp')) ?? '';
    }

    public static function whatsappUrl(?string $message = null): ?string
    {
        $digits = self::whatsappDigits();

        if ($digits === '') {
            return null;
        }

        $url = 'https://wa.me/'.$digits;

        if (is_string($message) && $message !== '') {
            $url .= '?text='.rawurlencode($message);
        }

        return $url;
    }

    public static function safeHttpUrl(mixed $url): ?string
    {
        if (! is_string($url) || trim($url) === '') {
            return null;
        }

        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return null;
        }

        $scheme = parse_url($url, PHP_URL_SCHEME);

        return in_array($scheme, ['http', 'https'], true) ? $url : null;
    }

    public static function contactEmail(): ?string
    {
        $email = config('portfolio.contact.email');

        return is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : null;
    }

    /**
     * @return array<string, string>
     */
    public static function alternates(): array
    {
        $route = request()->route();
        $name = $route?->getName();
        $params = $route?->parameters() ?? [];
        $links = [];

        foreach (config('portfolio.locales', ['en', 'ar']) as $locale) {
            $links[$locale] = self::localeUrl($name, $params, $locale);
        }

        return $links;
    }

    public static function canonical(): string
    {
        $route = request()->route();

        return self::localeUrl($route?->getName(), $route?->parameters() ?? [], app()->getLocale());
    }

    public static function switchUrl(string $locale): string
    {
        $route = request()->route();
        $url = self::localeUrl($route?->getName(), $route?->parameters() ?? [], $locale);
        $query = request()->except(['preview_theme', 'preview_logo']);

        if ($query !== []) {
            $url .= '?'.http_build_query($query);
        }

        return $url;
    }

    /**
     * @param  array<string, mixed>  $params
     */
    private static function localeUrl(?string $name, array $params, string $locale): string
    {
        if ($name === null || $name === 'mockups.show') {
            return url('/'.$locale);
        }

        $params['locale'] = $locale;

        try {
            return route($name, $params);
        } catch (\Throwable) {
            return url('/'.$locale);
        }
    }

    public static function brandTheme(): string
    {
        return self::allowedBrand(
            'theme',
            'preview_theme',
            array_keys(config('portfolio.themes', [])),
            'theme-2',
        );
    }

    public static function brandLogo(): string
    {
        return self::allowedBrand(
            'logo',
            'preview_logo',
            config('portfolio.logos', []),
            'concept-2',
        );
    }

    /**
     * @param  list<string>  $allowed
     */
    private static function allowedBrand(string $configKey, string $queryKey, array $allowed, string $fallback): string
    {
        $value = (string) config('portfolio.'.$configKey, $fallback);

        if (app()->environment(['local', 'testing'])) {
            $requested = request()->query($queryKey);
            if (is_string($requested) && in_array($requested, $allowed, true)) {
                return $requested;
            }
        }

        return in_array($value, $allowed, true) ? $value : $fallback;
    }

    public static function forceCanonicalRoot(): void
    {
        URL::forceRootUrl((string) config('app.url'));
    }
}
