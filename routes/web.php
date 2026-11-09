<?php

use App\Http\Controllers\MockupController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $locale = $request->getPreferredLanguage(config('portfolio.locales', ['en', 'ar'])) ?? 'en';

    return redirect('/'.$locale);
});

Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

Route::prefix('{locale}')
    ->where(['locale' => 'en|ar'])
    ->middleware('locale')
    ->group(function (): void {
        Route::get('/', [SiteController::class, 'home'])->name('home');
        Route::get('/work/{slug}', [SiteController::class, 'work'])->name('work.show');
        Route::get('/samples/{slug}', [SiteController::class, 'sample'])->name('samples.show');
    });

if (app()->environment(['local', 'testing'])) {
    Route::get('/mockups/{slug}/{screen?}', [MockupController::class, 'show'])->name('mockups.show');
}
