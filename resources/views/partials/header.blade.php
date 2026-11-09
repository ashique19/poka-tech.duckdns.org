@php
    use App\Support\Portfolio;

    $locale = app()->getLocale();
    $home = route('home', ['locale' => $locale]);
    $book = Portfolio::whatsappUrl(__('portfolio.whatsapp_book'));
    $logo = $brandLogo ?? config('portfolio.logo', 'concept-1');
@endphp
<header class="sticky top-0 z-40 border-b border-line bg-paper/95 backdrop-blur">
    <div class="mx-auto flex w-full max-w-6xl items-center gap-3 px-5 py-3">
        <a href="{{ $home }}" class="inline-flex min-h-11 items-center text-accent" aria-label="Poka Tech">
            <img src="{{ asset('brand/'.$logo.'.svg') }}" alt="" width="168" height="36" class="h-9 w-auto">
        </a>
        <nav class="ms-auto hidden items-center gap-5 md:flex" aria-label="{{ __('portfolio.nav.primary') }}">
            <a class="underline decoration-accent decoration-2 underline-offset-4" href="{{ $home }}#work">{{ __('portfolio.nav.work') }}</a>
            <a class="underline decoration-accent decoration-2 underline-offset-4" href="{{ $home }}#services">{{ __('portfolio.nav.services') }}</a>
            <a class="underline decoration-accent decoration-2 underline-offset-4" href="{{ $home }}#contact">{{ __('portfolio.nav.contact') }}</a>
        </nav>
        <div class="ms-auto flex items-center gap-2 md:ms-0">
            <nav aria-label="{{ __('portfolio.language.label') }}" class="flex items-center gap-1 text-sm">
                <a href="{{ Portfolio::switchUrl('en') }}" hreflang="en" lang="en" @if ($locale === 'en') aria-current="true" @endif class="inline-flex min-h-11 items-center px-2 {{ $locale === 'en' ? 'font-semibold text-accent' : 'underline' }}">English</a>
                <a href="{{ Portfolio::switchUrl('ar') }}" hreflang="ar" lang="ar" @if ($locale === 'ar') aria-current="true" @endif class="inline-flex min-h-11 items-center px-2 font-normal {{ $locale === 'ar' ? 'font-semibold text-accent' : 'underline' }}">العربية</a>
            </nav>
            @if ($book)
                <a href="{{ $book }}" class="hidden min-h-11 items-center bg-accent px-4 text-sm font-semibold text-white sm:inline-flex" target="_blank" rel="noopener noreferrer">{{ __('portfolio.hero.book') }}</a>
            @endif
            <details class="md:hidden">
                <summary class="inline-flex min-h-11 cursor-pointer items-center border border-line px-3 text-sm font-semibold">{{ __('portfolio.nav.menu') }}</summary>
                <nav class="absolute inset-x-0 top-full z-40 grid gap-1 border-b border-line bg-paper px-5 py-3" aria-label="{{ __('portfolio.nav.primary') }}">
                    <a class="inline-flex min-h-11 items-center underline" href="{{ $home }}#work">{{ __('portfolio.nav.work') }}</a>
                    <a class="inline-flex min-h-11 items-center underline" href="{{ $home }}#services">{{ __('portfolio.nav.services') }}</a>
                    <a class="inline-flex min-h-11 items-center underline" href="{{ $home }}#contact">{{ __('portfolio.nav.contact') }}</a>
                    @if ($book)
                        <a class="inline-flex min-h-11 items-center bg-accent px-4 font-semibold text-white" href="{{ $book }}" target="_blank" rel="noopener noreferrer">{{ __('portfolio.hero.book') }}</a>
                    @endif
                </nav>
            </details>
        </div>
    </div>
</header>
