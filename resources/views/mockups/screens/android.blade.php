@php
    $navHome = [
        ['label' => 'Home', 'active' => $screen === 'home'],
        ['label' => 'Orders', 'active' => $screen === 'orders'],
        ['label' => 'Scan', 'active' => $screen === 'scan'],
        ['label' => 'Profile', 'active' => $screen === 'profile'],
    ];
@endphp
@switch($screen)
    @case('home')
        <x-mockup-shell title="Today" subtitle="Sample Trading Co. field app" :nav="$navHome" :phone="true">
            <div class="mt-3 space-y-2 text-sm">
                <div class="rounded border border-neutral-200 p-3"><p class="font-semibold">12 deliveries</p><p class="text-neutral-600">Riyadh zone · 4 pending</p></div>
                <div class="rounded border border-neutral-200 p-3"><p class="font-semibold">المهام</p><p class="text-neutral-600">Pickup at hub 14:00</p></div>
            </div>
        </x-mockup-shell>
        @break
    @case('orders')
        <x-mockup-shell title="Orders" subtitle="Live sync" :nav="$navHome" :phone="true">
            <ul class="mt-2 divide-y text-sm">
                @foreach ([['ORD-501', 'SAR 240', 'In transit'], ['ORD-502', 'SAR 89', 'Delivered']] as $o)
                    <li class="flex justify-between py-2"><span>{{ $o[0] }}</span><span>{{ $o[1] }} · {{ $o[2] }}</span></li>
                @endforeach
            </ul>
        </x-mockup-shell>
        @break
    @case('scan')
        <x-mockup-shell title="Scan parcel" subtitle="Camera placeholder" :nav="$navHome" :phone="true">
            <div class="mt-4 flex aspect-square items-center justify-center rounded-lg border-2 border-dashed border-[#1e3a8a] bg-neutral-50 text-center text-xs text-neutral-600">
                Barcode · باركود<br>SHP-9001
            </div>
        </x-mockup-shell>
        @break
    @case('profile')
        <x-mockup-shell title="Profile" subtitle="Driver: Sample User" :nav="$navHome" :phone="true">
            <p class="mt-2 text-sm">Rating 4.9 · رحلات 1,204</p>
            <p class="mt-4 text-xs text-neutral-500">Language: EN / AR</p>
        </x-mockup-shell>
        @break
@endswitch
