<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Portfolio;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $body = "User-agent: *\nAllow: /\n\nSitemap: ".route('sitemap')."\n";

        return response($body, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    public function sitemap(): Response
    {
        $locales = config('portfolio.locales', ['en', 'ar']);
        $urls = [];

        foreach ($locales as $locale) {
            $urls[] = $this->entry('home', ['locale' => $locale], $locales);
        }

        foreach (Portfolio::caseStudies() as $study) {
            foreach ($locales as $locale) {
                $urls[] = $this->entry('work.show', ['locale' => $locale, 'slug' => $study['slug']], $locales);
            }
        }

        foreach (Portfolio::samples() as $sample) {
            foreach ($locales as $locale) {
                $urls[] = $this->entry('samples.show', ['locale' => $locale, 'slug' => $sample['slug']], $locales);
            }
        }

        return response()
            ->view('seo.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    /**
     * @param  array<string, mixed>  $params
     * @param  list<string>  $locales
     * @return array{loc: string, alternates: array<string, string>}
     */
    private function entry(string $name, array $params, array $locales): array
    {
        $alternates = [];

        foreach ($locales as $locale) {
            $alternates[$locale] = route($name, array_merge($params, ['locale' => $locale]));
        }

        return [
            'loc' => route($name, $params),
            'alternates' => $alternates,
        ];
    }
}
