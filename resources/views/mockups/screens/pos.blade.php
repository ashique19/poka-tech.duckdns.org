@php
    $nav = [
        ['label' => 'Register', 'active' => $screen === 'register'],
        ['label' => 'Checkout', 'active' => $screen === 'checkout'],
        ['label' => 'Stock', 'active' => $screen === 'stock'],
        ['label' => 'End of day', 'active' => $screen === 'eod'],
    ];
@endphp
@switch($screen)
    @case('register')
        <x-mockup-shell title="POS register" subtitle="Branch A · Sample Trading Co." :nav="$nav">
            <div class="grid gap-4 lg:grid-cols-[1fr_240px]">
                <div class="grid grid-cols-3 gap-2">
                    @foreach ([['Dates box', 'SAR 28'], ['Arabic coffee', 'SAR 12'], ['عسل سدر', 'SAR 45'], ['Gift set', 'SAR 90'], ['Notebook', 'SAR 18'], ['Water case', 'SAR 22']] as $item)
                        <button type="button" class="min-h-24 border border-neutral-200 bg-neutral-50 p-2 text-start text-sm">
                            <span class="font-semibold">{{ $item[0] }}</span>
                            <span class="mt-1 block text-[#1e3a8a]">{{ $item[1] }}</span>
                        </button>
                    @endforeach
                </div>
                <aside class="mockup-accent p-4 text-white text-sm">
                    <p class="font-semibold">Current ticket</p>
                    <p class="mt-3">2 × Dates box</p>
                    <p class="mt-6 text-2xl font-semibold">SAR 56.00</p>
                </aside>
            </div>
        </x-mockup-shell>
        @break
    @case('checkout')
        <x-mockup-shell title="Payment" subtitle="Ticket #POS-4412" :nav="$nav">
            <div class="max-w-md space-y-3 text-sm">
                <p>Subtotal: SAR 128.00</p>
                <p>VAT 15%: SAR 19.20</p>
                <p class="text-xl font-semibold text-[#1e3a8a]">Total: SAR 147.20</p>
                <div class="mt-4 grid grid-cols-2 gap-2">
                    <button type="button" class="bg-[#1e3a8a] py-3 font-semibold text-white">Card</button>
                    <button type="button" class="border border-neutral-300 py-3">Cash · نقدًا</button>
                </div>
            </div>
        </x-mockup-shell>
        @break
    @case('stock')
        <x-mockup-shell title="Branch stock" subtitle="Low-stock alerts: 3" :nav="$nav">
            <table class="w-full text-sm">
                <thead><tr class="border-b"><th class="py-2 text-start">SKU</th><th class="py-2 text-start">Item</th><th class="py-2 text-end">Qty</th></tr></thead>
                <tbody>
                    @foreach ([['SKU-100', 'Dates box', '42'], ['SKU-204', 'Coffee 250g', '8'], ['SKU-310', 'عسل', '15']] as $r)
                        <tr class="border-b"><td class="py-2">{{ $r[0] }}</td><td class="py-2">{{ $r[1] }}</td><td class="py-2 text-end {{ $r[2] < 10 ? 'text-red-700 font-semibold' : '' }}">{{ $r[2] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
    @case('eod')
        <x-mockup-shell title="End of day" subtitle="08 Nov 2026" :nav="$nav">
            <div class="grid gap-4 sm:grid-cols-3 text-sm">
                <div class="border p-4"><p class="text-neutral-500">Card sales</p><p class="text-xl font-semibold">SAR 4,820</p></div>
                <div class="border p-4"><p class="text-neutral-500">Cash sales</p><p class="text-xl font-semibold">SAR 1,240</p></div>
                <div class="border p-4"><p class="text-neutral-500">Variance</p><p class="text-xl font-semibold text-[#1e3a8a]">SAR 0</p></div>
            </div>
            <button type="button" class="mt-6 bg-[#1e3a8a] px-5 py-2 text-sm font-semibold text-white">Close day · إقفال اليوم</button>
        </x-mockup-shell>
        @break
@endswitch
