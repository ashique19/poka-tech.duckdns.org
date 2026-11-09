@props(['title', 'subtitle' => null, 'nav' => [], 'phone' => false])
<div class="{{ $phone ? 'flex justify-center px-4 py-6' : 'mx-auto max-w-[1400px]' }}">
    @if ($phone)
        <div class="w-[390px] rounded-[2rem] border-[10px] border-neutral-950 bg-white shadow-xl">
            <div class="flex items-center justify-between px-5 pt-3 text-[11px] text-neutral-500">
                <span>9:41</span>
                <span class="font-semibold text-neutral-800">Sample Field App</span>
                <span>LTE</span>
            </div>
            <div class="px-4 pb-4">
                <h1 class="text-lg font-semibold text-[#1e3a8a]">{{ $title }}</h1>
                @if ($subtitle)
                    <p class="mt-0.5 text-xs text-neutral-600">{{ $subtitle }}</p>
                @endif
                {{ $slot }}
            </div>
            @if ($nav !== [])
                <nav class="grid border-t text-center text-[10px]" style="grid-template-columns: repeat({{ count($nav) }}, minmax(0, 1fr))">
                    @foreach ($nav as $item)
                        <span class="py-3 {{ ($item['active'] ?? false) ? 'font-semibold text-[#1e3a8a]' : 'text-neutral-500' }}">{{ $item['label'] }}</span>
                    @endforeach
                </nav>
            @endif
        </div>
    @else
        <div class="grid min-h-[780px] w-full grid-cols-[220px_1fr] border border-neutral-200 bg-white shadow-sm">
            <aside class="mockup-accent p-4 text-sm text-white">
                <p class="text-xs uppercase tracking-wide text-white/70">Sample Trading Co.</p>
                <p class="mt-1 font-semibold">شركة العينة التجارية</p>
                <nav class="mt-6 space-y-2">
                    @foreach ($nav as $item)
                        <p class="{{ ($item['active'] ?? false) ? 'font-semibold' : 'text-white/60' }}">{{ $item['label'] }}</p>
                    @endforeach
                </nav>
            </aside>
            <section class="p-6">
                <header class="mb-6 flex flex-wrap items-end justify-between gap-3 border-b border-neutral-200 pb-4">
                    <div>
                        <h1 class="text-2xl font-semibold">{{ $title }}</h1>
                        @if ($subtitle)
                            <p class="mt-1 text-sm text-neutral-600">{{ $subtitle }}</p>
                        @endif
                    </div>
                    <p class="text-xs font-medium text-neutral-500">SAR · ريال · Dummy data</p>
                </header>
                {{ $slot }}
            </section>
        </div>
    @endif
</div>
