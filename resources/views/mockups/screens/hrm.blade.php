@php
    $nav = [
        ['label' => 'Roster', 'active' => $screen === 'roster'],
        ['label' => 'Leave', 'active' => $screen === 'leave'],
        ['label' => 'Profiles', 'active' => $screen === 'profile'],
        ['label' => 'Payroll', 'active' => $screen === 'payroll'],
    ];
@endphp
@switch($screen)
    @case('roster')
        <x-mockup-shell title="People directory" subtitle="128 employees · 6 departments" :nav="$nav">
            <table class="w-full text-sm">
                <thead><tr class="border-b text-neutral-600"><th class="py-2 text-start">Employee</th><th class="py-2 text-start">Team</th><th class="py-2 text-start">Location</th></tr></thead>
                <tbody>
                    @foreach ([['Noor Al-Harbi', 'Finance', 'Riyadh'], ['Omar Sample', 'Warehouse', 'Dammam'], ['ليلى أحمد', 'Sales', 'Jeddah']] as $r)
                        <tr class="border-b"><td class="py-3">{{ $r[0] }}</td><td class="py-3">{{ $r[1] }}</td><td class="py-3">{{ $r[2] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
    @case('leave')
        <x-mockup-shell title="Leave requests" subtitle="Pending approval: 4" :nav="$nav">
            @foreach ([['Annual leave', 'Hassan Sample', '3 days', 'Pending'], ['Sick leave', 'ريم السبيعي', '1 day', 'Approved']] as $req)
                <div class="mb-3 flex items-center justify-between border border-neutral-200 px-4 py-3 text-sm">
                    <span>{{ $req[0] }} · {{ $req[1] }}</span>
                    <span>{{ $req[2] }} · <strong class="text-[#1e3a8a]">{{ $req[3] }}</strong></span>
                </div>
            @endforeach
        </x-mockup-shell>
        @break
    @case('profile')
        <x-mockup-shell title="Employee profile" subtitle="ID EMP-1042 · Sample Trading Co." :nav="$nav">
            <div class="grid gap-4 sm:grid-cols-2 text-sm">
                <div><p class="text-neutral-500">Job title</p><p class="font-medium">Senior accountant</p></div>
                <div><p class="text-neutral-500">Manager</p><p class="font-medium">Finance lead</p></div>
                <div><p class="text-neutral-500">Joined</p><p class="font-medium">Mar 2019</p></div>
                <div><p class="text-neutral-500">Contract</p><p class="font-medium">Full-time · SAR package</p></div>
            </div>
        </x-mockup-shell>
        @break
    @case('payroll')
        <x-mockup-shell title="Payroll summary" subtitle="October 2026 run" :nav="$nav">
            <table class="w-full text-sm">
                <thead><tr class="border-b"><th class="py-2 text-start">Cost center</th><th class="py-2 text-end">Gross (SAR)</th><th class="py-2 text-end">Net (SAR)</th></tr></thead>
                <tbody>
                    @foreach ([['HQ', '412,000', '368,500'], ['Warehouse', '198,200', '176,800']] as $r)
                        <tr class="border-b"><td class="py-2">{{ $r[0] }}</td><td class="py-2 text-end">{{ $r[1] }}</td><td class="py-2 text-end">{{ $r[2] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
@endswitch
