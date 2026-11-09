@extends('layouts.site')

@php
    use App\Support\Portfolio;

    $locale = app()->getLocale();
    $kind = Portfolio::text($sample['kind']);
@endphp

@section('title', __('portfolio.samples.badge').' — '.$kind.' — Poka Tech')
@section('description', __('portfolio.meta.sample_description', ['kind' => $kind]))

@section('content')
    <article class="mx-auto grid w-full max-w-6xl gap-8 px-5 py-12">
        <p><a class="inline-flex min-h-11 items-center underline" href="{{ route('home', ['locale' => $locale]) }}#work">{{ __('portfolio.samples.back') }}</a></p>
        <header class="grid gap-3">
            <p class="text-sm font-semibold text-accent">{{ __('portfolio.samples.badge') }}</p>
            <h1 class="text-4xl font-semibold">{{ $kind }}</h1>
            <p class="max-w-3xl text-muted">{{ __('portfolio.samples.intro') }} {{ __('portfolio.samples.not_client') }}.</p>
        </header>
        <x-screenshot-gallery :images="$sample['screenshots']" :id="'sample-'.$sample['slug']" />
        <a href="{{ route('home', ['locale' => $locale, 'project' => $sample['slug']]) }}#contact" class="inline-flex min-h-11 w-fit items-center bg-accent px-4 font-semibold text-white">{{ __('portfolio.services.quote') }}</a>
    </article>
@endsection
