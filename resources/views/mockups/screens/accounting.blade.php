@php
    $nav = [
        ['label' => 'Dashboard', 'active' => $screen === 'dashboard'],
        ['label' => 'Invoices / فواتير', 'active' => $screen === 'invoices'],
        ['label' => 'Ledger', 'active' => $screen === 'ledger'],
        ['label' => 'P&L report', 'active' => $screen === 'pl-report'],
    ];
@endphp
@switch($screen)
    @case('dashboard')
        <x-mockup-shell title="Finance dashboard" subtitle="November 2026 · Sample Trading Co." :nav="$nav">
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ([['Revenue', 'SAR 284,500', '▲ 12%'], ['Receivables', 'SAR 41,200', 'Due 14d'], ['Payables', 'SAR 18,750', '▼ 3%']] as [$label, $value, $note])
                    <article class="border border-neutral-200 bg-[#f7f4ee] p-4">
                        <p class="text-xs uppercase text-neutral-500">{{ $label }}</p>
                        <p class="mt-2 text-2xl font-semibold text-[#1e3a8a]">{{ $value }}</p>
                        <p class="mt-1 text-sm text-neutral-600">{{ $note }}</p>
                    </article>
                @endforeach
            </div>
            <table class="mt-6 w-full text-sm">
                <thead><tr class="border-b text-neutral-500"><th class="py-2 text-start">Account</th><th class="py-2 text-end">Balance (SAR)</th></tr></thead>
                <tbody>
                    @foreach ([['Petty cash / صندوق', '12,400'], ['AR – Gulf Wholesale', '28,900'], ['VAT payable', '6,120']] as $row)
                        <tr class="border-b"><td class="py-3">{{ $row[0] }}</td><td class="py-3 text-end font-medium">{{ $row[1] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
    @case('invoices')
        <x-mockup-shell title="Sales invoices" subtitle="Filter: Open · VAT 15%" :nav="$nav">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b bg-neutral-50 text-neutral-600">
                        <th class="px-2 py-2 text-start">No.</th>
                        <th class="px-2 py-2 text-start">Customer</th>
                        <th class="px-2 py-2 text-end">Amount</th>
                        <th class="px-2 py-2 text-start">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([['INV-2408', 'Riyadh Office Supplies', '4,850.00', 'Sent'], ['INV-2409', 'جدة للتجارة', '12,300.00', 'Paid'], ['INV-2410', 'Sample Trading Co.', '2,150.00', 'Draft'], ['INV-2411', 'Eastern Logistics LLC', '8,420.00', 'Overdue']] as $row)
                        <tr class="border-b">
                            <td class="px-2 py-3 font-medium">{{ $row[0] }}</td>
                            <td class="px-2 py-3">{{ $row[1] }}</td>
                            <td class="px-2 py-3 text-end">SAR {{ $row[2] }}</td>
                            <td class="px-2 py-3"><span class="rounded bg-[#1e3a8a]/10 px-2 py-0.5 text-xs font-semibold text-[#1e3a8a]">{{ $row[3] }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-mockup-shell>
        @break
    @case('ledger')
        <x-mockup-shell title="General ledger" subtitle="Account 1100 · Cash on hand" :nav="$nav">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-neutral-600"><th class="py-2 text-start">Date</th><th class="py-2 text-start">Memo</th><th class="py-2 text-end">Debit</th><th class="py-2 text-end">Credit</th></tr>
                </thead>
                <tbody>
                    @foreach ([['03 Nov', 'POS deposit – Branch A', '18,200', '—'], ['05 Nov', 'Supplier payment – مورد تجريبي', '—', '9,400'], ['07 Nov', 'Bank transfer in', '25,000', '—']] as $row)
                        <tr class="border-b"><td class="py-3">{{ $row[0] }}</td><td class="py-3">{{ $row[1] }}</td><td class="py-3 text-end">{{ $row[2] }}</td><td class="py-3 text-end">{{ $row[3] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
            <p class="mt-4 text-sm text-neutral-600">Running balance: <strong>SAR 43,800</strong></p>
        </x-mockup-shell>
        @break
    @case('pl-report')
        <x-mockup-shell title="Profit & loss" subtitle="Q4 2026 · consolidated" :nav="$nav">
            <div class="grid gap-3 text-sm">
                @foreach ([['Revenue', 'SAR 812,400'], ['COGS', 'SAR 401,200'], ['Gross profit', 'SAR 411,200'], ['Operating expenses', 'SAR 198,750'], ['Net profit', 'SAR 212,450']] as $row)
                    <div class="flex justify-between border-b border-neutral-200 py-2 {{ $row[0] === 'Net profit' ? 'font-semibold text-[#1e3a8a]' : '' }}">
                        <span>{{ $row[0] }}</span><span>{{ $row[1] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 h-32 rounded border border-neutral-200 bg-gradient-to-r from-[#1e3a8a]/20 via-[#1e3a8a]/5 to-transparent p-4 text-xs text-neutral-600">Trend chart (dummy) · اتجاه الإيرادات</div>
        </x-mockup-shell>
        @break
@endswitch
