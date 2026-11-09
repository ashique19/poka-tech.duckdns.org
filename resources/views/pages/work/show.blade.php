@extends('layouts.site')

@php
    use App\Support\Portfolio;

    $locale = app()->getLocale();
    $name = Portfolio::text($study['name']);
    $demo = Portfolio::safeHttpUrl($study['demo_url'] ?? null);
@endphp

@section('title', $name.' — Poka Tech')
@section('description', Portfolio::text($study['summary']))

@section('content')
    <article class="mx-auto grid w-full max-w-6xl gap-8 px-5 py-12">
        <p><a class="inline-flex min-h-11 items-center underline decoration-accent underline-offset-4" href="{{ route('home', ['locale' => $locale]) }}#work">{{ __('portfolio.work.back') }}</a></p>
        <header class="grid gap-3">
            <h1 class="text-4xl font-semibold">{{ $name }}</h1>
            <p class="max-w-3xl text-lg text-muted">{{ Portfolio::text($study['summary']) }}</p>
        </header>

        <section class="grid gap-2" aria-labelledby="problem-title">
            <h2 id="problem-title" class="text-2xl font-semibold">{{ __('portfolio.work.problem') }}</h2>
            <p class="max-w-3xl">{{ Portfolio::text($study['problem']) }}</p>
        </section>

        <section class="grid gap-2" aria-labelledby="built-title">
            <h2 id="built-title" class="text-2xl font-semibold">{{ __('portfolio.work.built') }}</h2>
            <ul class="grid max-w-3xl list-disc gap-2 ps-5">
                @foreach (Portfolio::lines($study['built']) as $line)
                    <li>{{ $line }}</li>
                @endforeach
            </ul>
        </section>

        <section class="grid gap-2" aria-labelledby="stack-title">
            <h2 id="stack-title" class="text-2xl font-semibold">{{ __('portfolio.work.stack') }}</h2>
            <ul class="flex flex-wrap gap-2">
                @foreach (Portfolio::lines($study['stack']) as $item)
                    <li class="border border-line px-3 py-2 text-sm">{{ $item }}</li>
                @endforeach
            </ul>
        </section>

        @if (! empty($study['notes']))
            <p class="max-w-3xl border-s-4 border-accent ps-4 text-sm text-muted">{{ Portfolio::text($study['notes']) }}</p>
        @endif

        <section class="grid gap-4" aria-labelledby="shots-title">
            <h2 id="shots-title" class="text-2xl font-semibold">{{ __('portfolio.work.screenshots') }}</h2>
            <x-screenshot-gallery :images="$study['screenshots']" :id="'work-'.$study['slug']" />
        </section>

        <div class="flex flex-wrap gap-3">
            @if ($demo)
                <a href="{{ $demo }}" class="inline-flex min-h-11 items-center border border-ink px-4 font-semibold" target="_blank" rel="noopener noreferrer">{{ __('portfolio.work.live_demo') }}</a>
            @endif
            <a href="{{ route('home', ['locale' => $locale, 'project' => $study['slug']]) }}#contact" class="inline-flex min-h-11 items-center bg-accent px-4 font-semibold text-white">{{ __('portfolio.work.demo_on_request') }}</a>
        </div>

        @if (! empty($study['links']))
            <section class="grid gap-2" aria-labelledby="sources-title">
                <h2 id="sources-title" class="text-lg font-semibold">{{ __('portfolio.work.source') }}</h2>
                <ul class="grid gap-1">
                    @foreach ($study['links'] as $link)
                        @if ($href = Portfolio::safeHttpUrl($link['url'] ?? null))
                            <li><a class="underline decoration-accent underline-offset-4" href="{{ $href }}" rel="noopener noreferrer">{{ Portfolio::text($link['label']) }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </section>
        @endif
    </article>
@endsection
