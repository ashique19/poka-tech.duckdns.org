@php
    $nav = [
        ['label' => 'Dashboard', 'active' => $screen === 'dashboard'],
        ['label' => 'Shipments', 'active' => $screen === 'shipments'],
        ['label' => 'Dispatch', 'active' => $screen === 'dispatch'],
        ['label' => 'Reports', 'active' => $screen === 'delivery-report'],
    ];
@endphp
@switch($screen)
    @case('dashboard')
        <x-mockup-shell title="Operations overview" subtitle="Live fleet · Dammam hub" :nav="$nav">
            <div class="grid gap-4 sm:grid-cols-4">
                @foreach ([['In transit', '24'], ['At hub', '11'], ['Delivered today', '38'], ['Exceptions', '2']] as $kpi)
                    <article class="border border-neutral-200 p-3"><p class="text-xs text-neutral-500">{{ $kpi[0] }}</p><p class="mt-1 text-2xl font-semibold text-[#1e3a8a]">{{ $kpi[1] }}</p></article>
                @endforeach
            </div>
            <ul class="mt-6 divide-y border border-neutral-200 text-sm">
                @foreach ([['SHP-8821', 'Riyadh → Jeddah', 'In transit'], ['SHP-8822', 'Dammam → Khobar', 'Packed']] as $s)
                    <li class="flex justify-between px-3 py-3"><span>{{ $s[0] }} · {{ $s[1] }}</span><span class="font-medium text-[#1e3a8a]">{{ $s[2] }}</span></li>
                @endforeach
            </ul>
        </x-mockup-shell>
        @break
    @case('shipments')
        <x-mockup-shell title="Shipment list" subtitle="All statuses · last 30 days" :nav="$nav">
            <table class="w-full text-sm">
                <thead><tr class="border-b bg-neutral-50 text-neutral-600"><th class="px-2 py-2 text-start">ID</th><th class="px-2 py-2 text-start">Route</th><th class="px-2 py-2 text-end">Weight</th><th class="px-2 py-2 text-start">Status</th></tr></thead>
                <tbody>
                    @foreach ([['SHP-8801', 'Jeddah → Riyadh', '420 kg', 'Delivered'], ['SHP-8802', 'الدمام → المدينة', '180 kg', 'In transit'], ['SHP-8803', 'Riyadh → Dammam', '95 kg', 'Exception']] as $r)
                        <tr class="border-b"><td class="px-2 py-3">{{ $r[0] }}</td><td class="px-2 py-3">{{ $r[1] }}</td><td class="px-2 py-3 text-end">{{ $r[2] }}</td><td class="px-2 py-3">{{ $r[3] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
    @case('dispatch')
        <x-mockup-shell title="Dispatch board" subtitle="Assign drivers · اليوم" :nav="$nav">
            <div class="grid gap-4 lg:grid-cols-2">
                <div class="border border-neutral-200 p-4">
                    <h2 class="font-semibold">Pending pickup</h2>
                    @foreach (['SHP-8830 – Al Olaya', 'SHP-8831 – مستودع الشرق'] as $item)
                        <p class="mt-2 rounded bg-neutral-50 px-3 py-2 text-sm">{{ $item }}</p>
                    @endforeach
                </div>
                <div class="border border-neutral-200 p-4">
                    <h2 class="font-semibold">Driver: Ahmad (Sample)</h2>
                    <p class="mt-2 text-sm text-neutral-600">Van 12 · capacity 1.2t</p>
                    <button type="button" class="mt-4 bg-[#1e3a8a] px-4 py-2 text-sm font-semibold text-white">Assign 3 stops</button>
                </div>
            </div>
        </x-mockup-shell>
        @break
    @case('delivery-report')
        <x-mockup-shell title="Delivery performance" subtitle="SLA 96% target" :nav="$nav">
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="border border-neutral-200 p-4"><p class="text-sm text-neutral-600">On-time rate</p><p class="text-3xl font-semibold text-[#1e3a8a]">94.2%</p></div>
                <div class="border border-neutral-200 p-4"><p class="text-sm text-neutral-600">Avg. cost / shipment</p><p class="text-3xl font-semibold">SAR 42</p></div>
            </div>
            <table class="mt-6 w-full text-sm">
                <thead><tr class="border-b"><th class="py-2 text-start">Hub</th><th class="py-2 text-end">Shipments</th><th class="py-2 text-end">Late</th></tr></thead>
                <tbody>
                    @foreach ([['Riyadh', '412', '18'], ['Jeddah', '308', '9'], ['Dammam', '201', '12']] as $r)
                        <tr class="border-b"><td class="py-2">{{ $r[0] }}</td><td class="py-2 text-end">{{ $r[1] }}</td><td class="py-2 text-end">{{ $r[2] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
@endswitch
