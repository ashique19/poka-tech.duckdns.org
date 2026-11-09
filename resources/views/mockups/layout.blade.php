<!DOCTYPE html>
<html lang="en" data-theme="theme-2">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Representative mockup · {{ $slug }} · {{ $screen }}</title>
    @vite(['resources/css/app.css'])
    <style>
        .mockup-accent { background-color: #1e3a8a; }
        .mockup-accent-text { color: #1e3a8a; }
        .mockup-surface { background: #f7f4ee; }
    </style>
</head>
<body class="mockup-surface text-neutral-900 antialiased">
    <p class="sticky top-0 z-50 bg-neutral-950 px-4 py-2 text-center text-sm font-semibold text-white">
        Representative mockup · نموذج تمثيلي
    </p>
    <p class="bg-amber-200 px-4 py-1 text-center text-xs font-semibold text-neutral-950">
        Not a client project · ليس مشروع عميل · Sample Trading Co. / شركة العينة التجارية
    </p>
    @include('mockups.screens.'.$slug, ['screen' => $screen])
</body>
</html>
