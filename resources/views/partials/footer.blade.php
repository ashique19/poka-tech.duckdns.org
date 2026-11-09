@php
    use App\Support\Portfolio;

    $email = Portfolio::contactEmail();
    $whatsapp = Portfolio::whatsappUrl();
@endphp
<footer class="border-t border-line">
    <div class="mx-auto flex w-full max-w-6xl flex-col gap-3 px-5 py-8 text-sm text-muted sm:flex-row sm:items-center sm:justify-between">
        <p>{{ __('portfolio.footer.note') }}</p>
        <div class="flex flex-wrap gap-4">
            <a class="underline decoration-accent underline-offset-4" href="{{ config('portfolio.studio.github') }}" rel="noopener noreferrer">GitHub</a>
            @if ($whatsapp)
                <a class="underline decoration-accent underline-offset-4" href="{{ $whatsapp }}" target="_blank" rel="noopener noreferrer">{{ __('portfolio.contact.whatsapp') }}</a>
            @endif
            @if ($email)
                <a class="underline decoration-accent underline-offset-4" href="mailto:{{ $email }}">{{ $email }}</a>
            @endif
        </div>
    </div>
</footer>
