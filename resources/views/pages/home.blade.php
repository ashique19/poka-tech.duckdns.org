@extends('layouts.site')

@php
    use App\Support\Portfolio;

    $locale = app()->getLocale();
    $book = Portfolio::whatsappUrl(__('portfolio.whatsapp_book'));
    $quote = route('home', ['locale' => $locale, 'intent' => 'quote']).'#contact';
@endphp

@section('content')
    <section class="border-b border-line" aria-labelledby="hero-title">
        <div class="mx-auto grid w-full max-w-6xl gap-8 px-5 py-16 sm:py-24">
            <p class="text-sm font-semibold text-accent">{{ __('portfolio.hero.kicker') }}</p>
            <h1 id="hero-title" class="max-w-4xl text-4xl font-semibold leading-tight sm:text-6xl">{{ __('portfolio.hero.title') }}</h1>
            <p class="max-w-2xl text-lg text-muted">{{ __('portfolio.hero.lede') }}</p>
            <div class="flex flex-wrap gap-3">
                <a href="#work" class="inline-flex min-h-11 items-center bg-accent px-5 font-semibold text-white">{{ __('portfolio.hero.see_work') }}</a>
                @if ($book)
                    <a href="{{ $book }}" class="inline-flex min-h-11 items-center border border-ink px-5 font-semibold" target="_blank" rel="noopener noreferrer">{{ __('portfolio.hero.book') }}</a>
                @endif
            </div>
        </div>
    </section>

    <section id="work" class="border-b border-line" aria-labelledby="work-title">
        <div class="mx-auto grid w-full max-w-6xl gap-10 px-5 py-16">
            <div class="grid gap-3">
                <h2 id="work-title" class="text-3xl font-semibold">{{ __('portfolio.work.title') }}</h2>
                <p class="max-w-3xl text-muted">{{ __('portfolio.work.intro') }}</p>
            </div>
            <div class="grid gap-8">
                @foreach ($caseStudies as $study)
                    <article class="grid gap-4 border-t border-line pt-8" aria-labelledby="study-{{ $study['slug'] }}">
                        @php $cover = $study['screenshots'][0] ?? null; @endphp
                        @if ($cover)
                            <img
                                src="{{ Portfolio::imageUrl($cover) }}"
                                alt="{{ Portfolio::text($cover['alt'] ?? '') }}"
                                width="{{ $cover['width'] }}"
                                height="{{ $cover['height'] }}"
                                loading="lazy"
                                decoding="async"
                                class="max-h-64 w-full border border-line bg-white object-cover object-top"
                            >
                        @endif
                        <p class="text-sm font-semibold text-accent">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 id="study-{{ $study['slug'] }}" class="text-2xl font-semibold">{{ Portfolio::text($study['name']) }}</h3>
                        <p class="max-w-3xl text-muted">{{ Portfolio::text($study['summary']) }}</p>
                        <div class="flex flex-wrap gap-3">
                            <a class="inline-flex min-h-11 items-center underline decoration-accent decoration-2 underline-offset-4" href="{{ route('work.show', ['locale' => $locale, 'slug' => $study['slug']]) }}">{{ __('portfolio.work.view') }}</a>
                            <a class="inline-flex min-h-11 items-center bg-accent px-4 font-semibold text-white" href="{{ route('home', ['locale' => $locale, 'project' => $study['slug']]) }}#contact">{{ __('portfolio.work.demo_on_request') }}</a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="grid gap-3">
                <h3 class="text-2xl font-semibold">{{ __('portfolio.samples.title') }}</h3>
                <p class="max-w-3xl text-muted">{{ __('portfolio.samples.intro') }}</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($samples as $sample)
                    <article class="grid gap-3 border border-line p-4" aria-labelledby="sample-{{ $sample['slug'] }}">
                        @php $cover = $sample['thumb'] ?? ($sample['screenshots'][0] ?? null); @endphp
                        @if ($cover)
                            <img
                                src="{{ Portfolio::imageUrl($cover) }}"
                                @if (! empty($cover['srcset'])) srcset="{{ $cover['srcset'] }}" sizes="(max-width: 1024px) 50vw, 320px" @endif
                                alt="{{ Portfolio::text($cover['alt'] ?? '') }}"
                                width="{{ $cover['width'] }}"
                                height="{{ $cover['height'] }}"
                                loading="lazy"
                                decoding="async"
                                class="aspect-[16/10] w-full bg-white object-cover object-top"
                            >
                        @endif
                        <p class="text-xs font-semibold uppercase tracking-wide text-accent">{{ __('portfolio.samples.badge') }}</p>
                        <h3 id="sample-{{ $sample['slug'] }}" class="text-xl font-semibold">{{ Portfolio::text($sample['kind']) }}</h3>
                        <p class="text-sm text-muted">{{ __('portfolio.samples.not_client') }}</p>
                        <a class="inline-flex min-h-11 items-center underline decoration-accent underline-offset-4" href="{{ route('samples.show', ['locale' => $locale, 'slug' => $sample['slug']]) }}">{{ __('portfolio.samples.view') }}</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="services" class="border-b border-line" aria-labelledby="services-title">
        <div class="mx-auto grid w-full max-w-6xl gap-8 px-5 py-16">
            <div class="grid gap-3">
                <h2 id="services-title" class="text-3xl font-semibold">{{ __('portfolio.services.title') }}</h2>
                <p class="max-w-3xl text-muted">{{ __('portfolio.services.intro') }}</p>
                <a href="{{ $quote }}" class="inline-flex min-h-11 w-fit items-center bg-accent px-5 font-semibold text-white">{{ __('portfolio.services.quote') }}</a>
            </div>
            <dl class="grid gap-6 sm:grid-cols-2">
                @foreach (config('portfolio.service_keys') as $key)
                    <div class="border-t border-line pt-4">
                        <dt class="font-semibold">{{ __('portfolio.services.items.'.$key.'.title') }}</dt>
                        <dd class="mt-1 text-muted">{{ __('portfolio.services.items.'.$key.'.body') }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    <section id="process" class="border-b border-line" aria-labelledby="process-title">
        <div class="mx-auto grid w-full max-w-6xl gap-6 px-5 py-16">
            <h2 id="process-title" class="text-3xl font-semibold">{{ __('portfolio.process.title') }}</h2>
            <ol class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (__('portfolio.process.steps') as $step)
                    <li class="border border-line p-4">
                        <p class="text-sm font-semibold text-accent">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-2 font-semibold">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm text-muted">{{ $step['body'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section id="trust" class="border-b border-line" aria-labelledby="trust-title">
        <div class="mx-auto grid w-full max-w-6xl gap-6 px-5 py-16">
            <h2 id="trust-title" class="text-3xl font-semibold">{{ __('portfolio.trust.title') }}</h2>
            <p class="text-2xl font-semibold">{{ __('portfolio.trust.years', ['years' => config('portfolio.studio.years')]) }}</p>
            <p>
                <a class="inline-flex min-h-11 items-center underline decoration-accent decoration-2 underline-offset-4" href="{{ config('portfolio.studio.github') }}" rel="noopener noreferrer">{{ config('portfolio.studio.github') }}</a>
            </p>
            <p class="text-sm text-muted">{{ __('portfolio.trust.github_body') }}</p>
            <h3 class="font-semibold">{{ __('portfolio.trust.categories') }}</h3>
            <ul class="flex flex-wrap gap-2">
                @foreach (config('portfolio.service_keys') as $key)
                    <li class="border border-line px-3 py-2 text-sm">{{ __('portfolio.services.items.'.$key.'.title') }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <section id="contact" class="scroll-mt-24" aria-labelledby="contact-title">
        <div class="mx-auto grid w-full max-w-6xl gap-8 px-5 py-16 lg:grid-cols-5">
            <div class="grid gap-3 lg:col-span-2">
                <h2 id="contact-title" class="text-3xl font-semibold">{{ __('portfolio.contact.title') }}</h2>
                <p class="text-muted">{{ __('portfolio.contact.intro') }}</p>
                @if ($book)
                    <a href="{{ $book }}" class="inline-flex min-h-11 w-fit items-center bg-accent px-5 font-semibold text-white" target="_blank" rel="noopener noreferrer">{{ __('portfolio.hero.book') }}</a>
                @endif
                @if ($email = Portfolio::contactEmail())
                    <p><a class="underline decoration-accent underline-offset-4" href="mailto:{{ $email }}">{{ $email }}</a></p>
                @endif
            </div>
            <div class="lg:col-span-3">
                <livewire:contact-form />
            </div>
        </div>
    </section>
@endsection
