@switch($screen)
    @case('play')
        <div class="mx-auto max-w-lg p-6">
            <h1 class="text-center text-2xl font-semibold text-[#1e3a8a]">Sample Quest</h1>
            <p class="text-center text-sm text-neutral-600">Level 3 · Score 12,400</p>
            <div class="mt-4 grid grid-cols-4 gap-2">
                @foreach (range(1, 16) as $tile)
                    <div class="flex aspect-square items-center justify-center {{ $tile % 5 === 0 ? 'bg-[#1e3a8a] text-white' : 'bg-neutral-800 text-white' }} text-lg font-semibold">{{ $tile }}</div>
                @endforeach
            </div>
            <p class="mt-4 text-center text-xs text-neutral-500">Tap tiles · لعبة تجريبية</p>
        </div>
        @break
    @case('menu')
        <div class="mx-auto max-w-md p-8 text-center">
            <h1 class="text-3xl font-semibold">Sample Quest</h1>
            <nav class="mt-8 grid gap-3">
                @foreach (['Continue', 'New game', 'Scores', 'Settings'] as $item)
                    <button type="button" class="border border-neutral-300 bg-white py-3 font-semibold">{{ $item }}</button>
                @endforeach
            </nav>
        </div>
        @break
    @case('scores')
        <div class="mx-auto max-w-md p-6">
            <h1 class="text-xl font-semibold">High scores</h1>
            <ol class="mt-4 space-y-2 text-sm">
                @foreach ([['Sara', '18,200'], ['فهد', '16,400'], ['Guest', '12,400']] as $i => $row)
                    <li class="flex justify-between border-b py-2"><span>{{ $i + 1 }}. {{ $row[0] }}</span><span class="font-semibold text-[#1e3a8a]">{{ $row[1] }}</span></li>
                @endforeach
            </ol>
        </div>
        @break
    @case('settings')
        <div class="mx-auto max-w-md p-6 text-sm">
            <h1 class="text-xl font-semibold">Settings</h1>
            <p class="mt-4">Sound: On · Music: Off · Language: EN / AR</p>
            <p class="mt-2 text-neutral-600">Representative web game mockup only.</p>
        </div>
        @break
@endswitch
