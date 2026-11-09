@extends('layouts.site')

@section('title', __('portfolio.errors.title').' — Poka Tech')

@section('content')
    <div class="mx-auto grid w-full max-w-6xl gap-4 px-5 py-20">
        <h1 class="text-4xl font-semibold">{{ __('portfolio.errors.title') }}</h1>
        <p>{{ __('portfolio.errors.body') }}</p>
        <a class="inline-flex min-h-11 w-fit items-center underline" href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('portfolio.errors.home') }}</a>
    </div>
@endsection
