<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Portfolio;
use Illuminate\Contracts\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'caseStudies' => Portfolio::caseStudies(),
            'samples' => Portfolio::samples(),
        ]);
    }

    public function work(string $locale, string $slug): View
    {
        $study = Portfolio::findCaseStudy($slug);
        abort_if($study === null, 404);

        return view('pages.work.show', [
            'study' => $study,
        ]);
    }

    public function sample(string $locale, string $slug): View
    {
        $sample = Portfolio::findSample($slug);
        abort_if($sample === null, 404);

        return view('pages.samples.show', [
            'sample' => $sample,
        ]);
    }
}
