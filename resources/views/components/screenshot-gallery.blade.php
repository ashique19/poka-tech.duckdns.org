@props(['images', 'id' => null, 'strips' => []])
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
            $jpegRel = $image['jpeg'] ?? null;
            $jpegSrc = is_string($jpegRel) && is_file(public_path($jpegRel)) ? asset($jpegRel) : null;
            $srcset = $image['srcset'] ?? null;
            $missing = Portfolio::imageMissing($image);
        @endphp
        <figure class="grid gap-2">
            <button
                type="button"
                class="block w-full border border-line bg-white text-start"
                data-lightbox-open
                data-src="{{ $src }}"
                data-jpeg="{{ $jpegSrc }}"
                data-srcset="{{ $srcset }}"
                data-sizes="{{ $image['sizes'] ?? '100vw' }}"
                data-alt="{{ $alt }}"
                data-caption="{{ $caption }}"
                data-width="{{ $image['width'] }}"
                data-height="{{ $image['height'] }}"
                data-screen="{{ $image['screen'] ?? '' }}"
                aria-haspopup="dialog"
                aria-label="{{ __('portfolio.lightbox.open', ['caption' => $caption]) }}"
            >
                @if ($jpegSrc && ! $missing)
                    <picture>
                        <source type="image/webp" srcset="{{ $srcset ?? $src }}">
                        <img
                            src="{{ $jpegSrc }}"
                            srcset="{{ $srcset }}"
                            sizes="{{ $image['sizes'] ?? '100vw' }}"
                            width="{{ $image['width'] }}"
                            height="{{ $image['height'] }}"
                            alt="{{ $alt }}"
                            loading="lazy"
                            decoding="async"
                            class="h-auto max-h-96 w-full bg-white object-contain"
                        >
                    </picture>
                @else
                    <img
                        src="{{ $src }}"
                        @if ($srcset) srcset="{{ $srcset }}" sizes="{{ $image['sizes'] ?? '100vw' }}" @endif
                        width="{{ $image['width'] }}"
                        height="{{ $image['height'] }}"
                        alt="{{ $alt }}"
                        loading="lazy"
                        decoding="async"
                        class="h-auto max-h-96 w-full bg-white object-contain"
                    >
                @endif
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
        @if (count($strips) > 0)
            <div class="flex gap-2 overflow-x-auto border-b border-line bg-paper px-3 py-2" data-lightbox-strip role="tablist" aria-label="{{ __('portfolio.lightbox.strip') }}">
                @foreach ($strips as $strip)
                    <button
                        type="button"
                        class="shrink-0 border border-line bg-white p-0.5"
                        data-lightbox-strip-item
                        data-screen="{{ $strip['screen'] }}"
                        aria-label="{{ Portfolio::text($strip['caption'] ?? '') }}"
                    >
                        <img
                            src="{{ asset($strip['src']) }}"
                            width="{{ $strip['width'] }}"
                            height="{{ $strip['height'] }}"
                            alt=""
                            loading="lazy"
                            decoding="async"
                            class="h-14 w-auto object-cover"
                        >
                    </button>
                @endforeach
            </div>
        @endif
        <div class="relative bg-white">
            <img data-lightbox-image alt="" width="1440" height="900" class="mx-auto max-h-[70vh] w-full object-contain" decoding="async">
            <button type="button" data-lightbox-prev class="absolute top-1/2 start-2 inline-flex min-h-11 min-w-11 -translate-y-1/2 items-center justify-center border border-line bg-paper text-lg" aria-label="{{ __('portfolio.lightbox.prev') }}">‹</button>
            <button type="button" data-lightbox-next class="absolute top-1/2 end-2 inline-flex min-h-11 min-w-11 -translate-y-1/2 items-center justify-center border border-line bg-paper text-lg" aria-label="{{ __('portfolio.lightbox.next') }}">›</button>
        </div>
        <p id="{{ $id }}-caption" data-lightbox-caption class="px-4 py-3 text-sm"></p>
    </dialog>
</div>
