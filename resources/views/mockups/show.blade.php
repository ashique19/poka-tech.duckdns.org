<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Representative mockup · نموذج تمثيلي</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-100 text-neutral-900">
    <p class="sticky top-0 z-50 bg-neutral-950 px-4 py-2 text-center text-sm font-semibold text-white">
        Representative mockup · نموذج تمثيلي
    </p>
    <p class="bg-amber-200 px-4 py-1 text-center text-xs font-semibold text-neutral-950">
        Not a client project · ليس مشروع عميل
    </p>

    @switch($slug)
        @case('accounting')
            <div class="mx-auto grid max-w-6xl gap-4 p-4 md:grid-cols-[14rem_1fr]">
                <aside class="bg-neutral-900 p-4 text-sm text-white">
                    <p class="font-semibold">Sample books</p>
                    <p class="mt-4">Invoices</p>
                    <p class="mt-2 text-neutral-400">Bills</p>
                    <p class="mt-2 text-neutral-400">Ledger</p>
                </aside>
                <section class="bg-white p-4">
                    <h1 class="text-xl font-semibold">Sample invoices</h1>
                    <table class="mt-4 w-full text-start text-sm">
                        <thead>
                            <tr class="border-b text-neutral-500">
                                <th class="py-2 font-medium">Number</th>
                                <th class="py-2 font-medium">Party</th>
                                <th class="py-2 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (['INV-1001' => 'Draft', 'INV-1002' => 'Sent', 'INV-1003' => 'Draft'] as $number => $status)
                                <tr class="border-b">
                                    <td class="py-3">{{ $number }}</td>
                                    <td>Sample company</td>
                                    <td>{{ $status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
            @break
        @case('logistics')
            <div class="mx-auto grid max-w-6xl gap-4 p-4">
                <h1 class="text-xl font-semibold">Sample shipments</h1>
                <div class="grid gap-3 md:grid-cols-3">
                    @foreach (['SHP-1001' => 'Packed', 'SHP-1002' => 'In transit', 'SHP-1003' => 'Delivered'] as $code => $status)
                        <article class="bg-white p-4">
                            <p class="text-sm text-neutral-500">{{ $code }}</p>
                            <h2 class="mt-1 font-semibold">Sample city → Sample city</h2>
                            <p class="mt-3 inline-block bg-neutral-900 px-2 py-1 text-xs text-white">{{ $status }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
            @break
        @case('crm')
            <div class="mx-auto grid max-w-6xl gap-4 p-4 md:grid-cols-[16rem_1fr]">
                <aside class="bg-white p-4">
                    <h1 class="font-semibold">Sample pipeline</h1>
                    <p class="mt-3 text-sm">New</p>
                    <p class="mt-2 text-sm">Talking</p>
                    <p class="mt-2 text-sm">Won</p>
                </aside>
                <section class="grid gap-3">
                    @foreach (['Sample contact A', 'Sample contact B', 'Sample contact C'] as $name)
                        <article class="bg-white p-4">
                            <h2 class="font-semibold">{{ $name }}</h2>
                            <p class="text-sm text-neutral-600">Sample company · follow-up note</p>
                        </article>
                    @endforeach
                </section>
            </div>
            @break
        @case('hrm')
            <div class="mx-auto max-w-6xl p-4">
                <h1 class="text-xl font-semibold">Sample people</h1>
                <ul class="mt-4 divide-y bg-white">
                    @foreach (['Sample employee 1', 'Sample employee 2', 'Sample employee 3'] as $name)
                        <li class="flex items-center justify-between gap-4 px-4 py-3">
                            <span>{{ $name }}</span>
                            <span class="text-sm text-neutral-600">Sample team · leave request</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            @break
        @case('pos')
            <div class="mx-auto grid max-w-6xl gap-4 p-4 md:grid-cols-[1fr_18rem]">
                <section>
                    <h1 class="text-xl font-semibold">Sample register</h1>
                    <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
                        @foreach (['Sample item A', 'Sample item B', 'Sample item C', 'Sample item D'] as $item)
                            <button type="button" class="min-h-24 bg-white p-3 text-start font-semibold">{{ $item }}</button>
                        @endforeach
                    </div>
                </section>
                <aside class="bg-neutral-900 p-4 text-white">
                    <h2 class="font-semibold">Sample ticket</h2>
                    <p class="mt-4 text-sm">Sample item A</p>
                    <p class="mt-6 text-sm text-neutral-300">Pay · cash / card</p>
                </aside>
            </div>
            @break
        @case('erp')
            <div class="mx-auto max-w-6xl p-4">
                <h1 class="text-xl font-semibold">Sample operations</h1>
                <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach (['Purchasing', 'Inventory', 'Production', 'Finance', 'People', 'Projects'] as $module)
                        <article class="bg-white p-4">
                            <h2 class="font-semibold">{{ $module }}</h2>
                            <p class="mt-2 text-sm text-neutral-600">Sample module. No live records.</p>
                        </article>
                    @endforeach
                </div>
            </div>
            @break
        @case('ecommerce')
            <div class="mx-auto max-w-6xl p-4">
                <header class="flex items-center justify-between bg-white px-4 py-3">
                    <p class="font-semibold">Sample store</p>
                    <p class="text-sm">Sample cart</p>
                </header>
                <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach (['Sample product A', 'Sample product B', 'Sample product C'] as $product)
                        <article class="bg-white p-4">
                            <div class="aspect-[4/3] bg-neutral-200"></div>
                            <h2 class="mt-3 font-semibold">{{ $product }}</h2>
                            <p class="text-sm text-neutral-600">Price on request</p>
                        </article>
                    @endforeach
                </div>
            </div>
            @break
        @case('android')
            <div class="flex justify-center px-4 py-8">
                <div class="w-full max-w-[22rem] rounded-[2rem] border-8 border-neutral-950 bg-white">
                    <div class="flex items-center justify-between px-5 py-3 text-xs text-neutral-500">
                        <span>Sample</span>
                        <span>00:00</span>
                    </div>
                    <div class="px-5 pb-4">
                        <h1 class="text-lg font-semibold">Sample app</h1>
                        <p class="mt-1 text-sm text-neutral-600">A phone screen for a representative Android mockup.</p>
                        <ul class="mt-4 grid gap-2">
                            <li class="border border-neutral-200 px-3 py-3">Sample task</li>
                            <li class="border border-neutral-200 px-3 py-3">Sample note</li>
                            <li class="border border-neutral-200 px-3 py-3">Sample reminder</li>
                        </ul>
                    </div>
                    <nav class="grid grid-cols-3 border-t text-center text-xs">
                        <span class="py-3 font-semibold">Home</span>
                        <span class="py-3 text-neutral-500">List</span>
                        <span class="py-3 text-neutral-500">You</span>
                    </nav>
                </div>
            </div>
            @break
        @case('game')
            <div class="mx-auto max-w-md p-4">
                <h1 class="text-center text-xl font-semibold">Sample game</h1>
                <p class="mt-1 text-center text-sm text-neutral-600">Static board. Nothing here is a shipped game.</p>
                <div class="mt-4 grid grid-cols-4 gap-2">
                    @foreach (range(1, 16) as $tile)
                        <div class="flex aspect-square items-center justify-center bg-neutral-900 font-semibold text-white">{{ $tile }}</div>
                    @endforeach
                </div>
            </div>
            @break
    @endswitch
</body>
</html>
