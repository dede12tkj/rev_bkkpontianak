<?php

namespace App\Providers;

use App\Support\HomeCache;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
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
        Paginator::useBootstrapFour();

        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        // Counter pengunjung hanya dipakai di layout publik ini. Sebelumnya composer
        // dipasang di '*' sehingga 2 query COUNT dijalankan untuk SETIAP view/partial.
        View::composer(['layouts.app', 'layouts.detail'], function ($view) {
            $view->with(HomeCache::visitorCounts());
        });
    }
}
