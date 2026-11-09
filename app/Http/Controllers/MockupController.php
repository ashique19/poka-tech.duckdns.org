<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MockupController extends Controller
{
    public function show(string $slug, ?string $screen = null): View
    {
        abort_unless(array_key_exists($slug, config('portfolio.samples', [])), 404);

        $capture = config('mockup-captures.'.$slug, []);
        $screens = $capture['screens'] ?? ['main'];
        $screen ??= $screens[0] ?? 'main';

        abort_unless(in_array($screen, $screens, true), 404);
        abort_unless(view()->exists('mockups.screens.'.$slug), 404);

        return view('mockups.layout', [
            'slug' => $slug,
            'screen' => $screen,
        ]);
    }
}
