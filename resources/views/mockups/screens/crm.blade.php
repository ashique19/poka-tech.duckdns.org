@php
    $nav = [
        ['label' => 'Pipeline', 'active' => $screen === 'pipeline'],
        ['label' => 'Contacts', 'active' => $screen === 'contacts'],
        ['label' => 'Deals', 'active' => $screen === 'deal'],
        ['label' => 'Activities', 'active' => $screen === 'activities'],
    ];
@endphp
@switch($screen)
    @case('pipeline')
        <x-mockup-shell title="Sales pipeline" subtitle="Weighted SAR 1.2M" :nav="$nav">
            <div class="grid gap-3 lg:grid-cols-4">
                @foreach ([['New', 'SAR 320k', 6], ['Qualified', 'SAR 410k', 4], ['Proposal', 'SAR 280k', 3], ['Won', 'SAR 190k', 2]] as $col)
                    <article class="rounded border border-neutral-200 bg-neutral-50 p-3">
                        <p class="text-xs font-semibold uppercase text-[#1e3a8a]">{{ $col[0] }}</p>
                        <p class="text-sm text-neutral-600">{{ $col[1] }} · {{ $col[2] }} deals</p>
                        <div class="mt-3 space-y-2">
                            <div class="bg-white p-2 text-sm shadow-sm">Gulf Retail Group</div>
                            <div class="bg-white p-2 text-sm shadow-sm">شركة النور</div>
                        </div>
                    </article>
                @endforeach
            </div>
        </x-mockup-shell>
        @break
    @case('contacts')
        <x-mockup-shell title="Contacts" subtitle="482 records · synced" :nav="$nav">
            <table class="w-full text-sm">
                <thead><tr class="border-b text-neutral-600"><th class="py-2 text-start">Name</th><th class="py-2 text-start">Company</th><th class="py-2 text-start">Stage</th></tr></thead>
                <tbody>
                    @foreach ([['Sara Al-Qahtani', 'Sample Trading Co.', 'Customer'], ['James Ortega', 'Eastern Logistics', 'Lead'], ['فهد العتيبي', 'مؤسسة العينة', 'Prospect']] as $r)
                        <tr class="border-b"><td class="py-3">{{ $r[0] }}</td><td class="py-3">{{ $r[1] }}</td><td class="py-3">{{ $r[2] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
    @case('deal')
        <x-mockup-shell title="Deal · ERP rollout" subtitle="SAR 185,000 · 70% probability" :nav="$nav">
            <dl class="grid gap-4 sm:grid-cols-2 text-sm">
                <div><dt class="text-neutral-500">Owner</dt><dd class="font-medium">Ashiq (Sample)</dd></div>
                <div><dt class="text-neutral-500">Close date</dt><dd class="font-medium">15 Dec 2026</dd></div>
            </dl>
            <h2 class="mt-6 font-semibold">Next steps</h2>
            <ul class="mt-2 list-disc ps-5 text-sm text-neutral-700">
                <li>Send SOW draft · إرسال نطاق العمل</li>
                <li>Schedule technical workshop</li>
            </ul>
        </x-mockup-shell>
        @break
    @case('activities')
        <x-mockup-shell title="Activity timeline" subtitle="This week" :nav="$nav">
            <ul class="space-y-3 text-sm">
                @foreach ([['Call', 'Spoke with Sara – pricing'], ['Email', 'Sent proposal PDF'], ['Meeting', 'Demo for فريق المشتريات']] as $a)
                    <li class="flex gap-3 border-l-4 border-[#1e3a8a] ps-3"><span class="font-semibold">{{ $a[0] }}</span><span>{{ $a[1] }}</span></li>
                @endforeach
            </ul>
        </x-mockup-shell>
        @break
@endswitch
