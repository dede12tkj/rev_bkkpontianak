<?php

namespace App\Providers;

use App\Support\HomeCache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Footer & sosmed dibaca dari cache (bukan query di tiap view/partial).
        View::composer('pages.frontend.*', function ($view) {
            $view->with([
                'footer' => HomeCache::footer(),
                'sosmed' => HomeCache::sosmed(),
            ]);
        });
    }
}
