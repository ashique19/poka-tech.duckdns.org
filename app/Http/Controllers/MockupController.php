<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MockupController extends Controller
{
    public function show(string $slug): View
    {
        abort_unless(array_key_exists($slug, config('portfolio.samples', [])), 404);

        return view('mockups.show', [
            'slug' => $slug,
        ]);
    }
}
