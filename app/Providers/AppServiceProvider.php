<?php

namespace App\Providers;

use App\Support\Portfolio;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.site', function ($view): void {
            $view->with('brandTheme', Portfolio::brandTheme());
            $view->with('brandLogo', Portfolio::brandLogo());
        });
    }
}
