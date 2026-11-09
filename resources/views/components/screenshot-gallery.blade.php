@props(['images', 'id' => null])
@php
    use App\Support\Portfolio;

    $id = $id ?: 'gallery-'.substr(md5(json_encode(array_column($images, 'src'))), 0, 8);
@endphp
<div
    id="{{ $id }}"
    data-lightbox
    data-count-template="{{ __('portfolio.lightbox.count') }}"
    class="grid gap-4 sm:grid-cols-2"
>
    @foreach ($images as $image)
        @php
            $caption = Portfolio::text($image['caption'] ?? '');
            $alt = Portfolio::text($image['alt'] ?? $caption);
            $src = Portfolio::imageUrl($image);
            $missing = Portfolio::imageMissing($image);
        @endphp
        <figure class="grid gap-2">
            <button
                type="button"
                class="block w-full border border-line bg-white text-start"
                data-lightbox-open
                data-src="{{ $src }}"
                data-alt="{{ $alt }}"
                data-caption="{{ $caption }}"
                data-width="{{ $image['width'] }}"
                data-height="{{ $image['height'] }}"
                aria-haspopup="dialog"
                aria-label="{{ __('portfolio.lightbox.open', ['caption' => $caption]) }}"
            >
                <img
                    src="{{ $src }}"
                    width="{{ $image['width'] }}"
                    height="{{ $image['height'] }}"
                    alt="{{ $alt }}"
                    loading="lazy"
                    decoding="async"
                    class="h-auto max-h-96 w-full bg-white object-contain"
                >
            </button>
            <figcaption class="text-sm text-muted">
                {{ $caption }}
                @if ($missing)
                    <span class="mt-1 block text-ink">{{ __('portfolio.work.missing_shot') }}</span>
                @endif
            </figcaption>
        </figure>
    @endforeach

    <dialog class="lightbox" data-lightbox-dialog aria-labelledby="{{ $id }}-caption">
        <div class="flex items-center justify-between gap-3 border-b border-line px-3 py-2">
            <p data-lightbox-count class="text-sm text-muted"></p>
            <button type="button" data-lightbox-close class="inline-flex min-h-11 items-center px-3 text-sm font-semibold">{{ __('portfolio.lightbox.close') }}</button>
        </div>
        <div class="relative bg-white">
            <img data-lightbox-image alt="" class="mx-auto max-h-[70vh] w-full object-contain" decoding="async">
            <button type="button" data-lightbox-prev class="absolute top-1/2 start-2 inline-flex min-h-11 min-w-11 -translate-y-1/2 items-center justify-center border border-line bg-paper text-lg" aria-label="{{ __('portfolio.lightbox.prev') }}">‹</button>
            <button type="button" data-lightbox-next class="absolute top-1/2 end-2 inline-flex min-h-11 min-w-11 -translate-y-1/2 items-center justify-center border border-line bg-paper text-lg" aria-label="{{ __('portfolio.lightbox.next') }}">›</button>
        </div>
        <p id="{{ $id }}-caption" data-lightbox-caption class="px-4 py-3 text-sm"></p>
    </dialog>
</div>
