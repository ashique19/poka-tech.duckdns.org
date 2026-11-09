@php
    $nav = [
        ['label' => 'Hub', 'active' => $screen === 'hub'],
        ['label' => 'Purchasing', 'active' => $screen === 'purchasing'],
        ['label' => 'Inventory', 'active' => $screen === 'inventory'],
        ['label' => 'Finance', 'active' => $screen === 'finance'],
    ];
@endphp
@switch($screen)
    @case('hub')
        <x-mockup-shell title="ERP home" subtitle="Modules · Sample Trading Co." :nav="$nav">
            <div class="grid gap-3 sm:grid-cols-3">
                @foreach (['Purchasing', 'Inventory', 'Production', 'Finance', 'HR', 'Projects'] as $m)
                    <article class="border border-neutral-200 p-4"><h2 class="font-semibold text-[#1e3a8a]">{{ $m }}</h2><p class="mt-1 text-sm text-neutral-600">Open tasks (dummy)</p></article>
                @endforeach
            </div>
        </x-mockup-shell>
        @break
    @case('purchasing')
        <x-mockup-shell title="Purchase orders" subtitle="Awaiting approval: 2" :nav="$nav">
            <table class="w-full text-sm">
                <thead><tr class="border-b"><th class="py-2 text-start">PO</th><th class="py-2 text-start">Vendor</th><th class="py-2 text-end">SAR</th></tr></thead>
                <tbody>
                    @foreach ([['PO-5521', 'Gulf Packaging', '24,500'], ['PO-5522', 'مورد المحاليل', '8,900']] as $r)
                        <tr class="border-b"><td class="py-2">{{ $r[0] }}</td><td class="py-2">{{ $r[1] }}</td><td class="py-2 text-end">{{ $r[2] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
    @case('inventory')
        <x-mockup-shell title="Stock overview" subtitle="Warehouses: 3" :nav="$nav">
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ([['Riyadh DC', 'SAR 1.2M on hand'], ['Jeddah DC', 'SAR 820k on hand']] as $w)
                    <div class="border p-4"><p class="font-semibold">{{ $w[0] }}</p><p class="text-sm text-neutral-600">{{ $w[1] }}</p></div>
                @endforeach
            </div>
        </x-mockup-shell>
        @break
    @case('finance')
        <x-mockup-shell title="Finance snapshot" subtitle="Linked to accounting module" :nav="$nav">
            <p class="text-sm">Cash position: <strong class="text-[#1e3a8a]">SAR 612,400</strong></p>
            <p class="mt-2 text-sm">Open AP: SAR 89,300 · Open AR: SAR 134,800</p>
        </x-mockup-shell>
        @break
@endswitch
