@php
    use App\Support\Portfolio;

    $locale = app()->getLocale();
    $dir = $locale === 'ar' ? 'rtl' : 'ltr';
    $alternates = Portfolio::alternates();
    $canonical = $canonical ?? Portfolio::canonical();
    $pageTitle = trim($__env->yieldContent('title')) ?: __('portfolio.meta.home_title');
    $pageDescription = trim($__env->yieldContent('description')) ?: __('portfolio.meta.home_description');
    $home = route('home', ['locale' => $locale]);
    $logo = $brandLogo ?? config('portfolio.logo', 'concept-1');
    $theme = $brandTheme ?? config('portfolio.theme', 'theme-1');
    $organization = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => config('portfolio.studio.name'),
        'url' => config('app.url'),
        'founder' => [
            '@type' => 'Person',
            'name' => config('portfolio.studio.founder'),
        ],
        'sameAs' => [config('portfolio.studio.github')],
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}" data-theme="{{ $theme }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ $canonical }}">
    @foreach ($alternates as $lang => $href)
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $href }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ $alternates['en'] ?? $canonical }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Poka Tech">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:locale" content="{{ $locale === 'ar' ? 'ar_SA' : 'en_US' }}">
    <meta property="og:locale:alternate" content="{{ $locale === 'ar' ? 'en_US' : 'ar_SA' }}">
    <meta property="og:image" content="{{ asset('images/og.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Poka Tech">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="32x32">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="application/ld+json">{!! json_encode($organization, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
</head>
<body class="bg-paper text-ink antialiased">
    <a class="skip-link" href="#content">{{ __('portfolio.skip') }}</a>
    @include('partials.header')
    <main id="content">
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>
