@php
    $nav = [
        ['label' => 'Shop', 'active' => $screen === 'shop'],
        ['label' => 'Product', 'active' => $screen === 'product'],
        ['label' => 'Checkout', 'active' => $screen === 'checkout'],
        ['label' => 'Orders', 'active' => $screen === 'orders'],
    ];
@endphp
@switch($screen)
    @case('shop')
        <x-mockup-shell title="Sample store" subtitle="Ships across KSA · الدفع عند الاستلام available" :nav="$nav">
            <div class="grid gap-3 sm:grid-cols-3">
                @foreach ([['Heritage dates', 'SAR 48'], ['بخور عود', 'SAR 120'], ['Desk lamp', 'SAR 185']] as $p)
                    <article class="border p-3"><div class="aspect-[4/3] bg-neutral-200"></div><h2 class="mt-2 font-semibold">{{ $p[0] }}</h2><p class="text-sm text-[#1e3a8a]">{{ $p[1] }}</p></article>
                @endforeach
            </div>
        </x-mockup-shell>
        @break
    @case('product')
        <x-mockup-shell title="Heritage dates – 1kg" subtitle="SKU DEMO-8801" :nav="$nav">
            <div class="grid gap-4 lg:grid-cols-2 text-sm">
                <div class="aspect-square bg-neutral-100"></div>
                <div>
                    <p class="text-2xl font-semibold text-[#1e3a8a]">SAR 48.00</p>
                    <p class="mt-2 text-neutral-600">Including VAT · شحن مجاني over SAR 199</p>
                    <button type="button" class="mt-4 bg-[#1e3a8a] px-4 py-2 font-semibold text-white">Add to cart</button>
                </div>
            </div>
        </x-mockup-shell>
        @break
    @case('checkout')
        <x-mockup-shell title="Checkout" subtitle="3 items" :nav="$nav">
            <p class="text-sm">Subtotal SAR 156 · Shipping SAR 25 · Total <strong class="text-[#1e3a8a]">SAR 181</strong></p>
            <p class="mt-4 text-sm">Pay with: Mada / Apple Pay (dummy)</p>
        </x-mockup-shell>
        @break
    @case('orders')
        <x-mockup-shell title="Order history" subtitle="Customer: sample@example.com" :nav="$nav">
            <table class="w-full text-sm">
                <thead><tr class="border-b"><th class="py-2 text-start">Order</th><th class="py-2 text-start">Status</th><th class="py-2 text-end">SAR</th></tr></thead>
                <tbody>
                    @foreach ([['WEB-7710', 'Delivered', '181'], ['WEB-7702', 'Processing', '92']] as $r)
                        <tr class="border-b"><td class="py-2">{{ $r[0] }}</td><td class="py-2">{{ $r[1] }}</td><td class="py-2 text-end">{{ $r[2] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
@endswitch
