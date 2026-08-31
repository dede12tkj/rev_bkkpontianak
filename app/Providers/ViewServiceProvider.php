<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Footer;
use App\Models\Sosmed;

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
        View::composer('pages.frontend.*', function ($view) {
            $view->with([
                'footer' => Footer::first(),
                'sosmed' => Sosmed::first(),
            ]);
        });
    }
}
