<?php

namespace App\Providers;

use App\Models\Visitor;
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
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
        View::composer('*', function ($view) {
            $totalVisitors = Visitor::count();
            $todayVisitors = Visitor::where('visit_date', now()->toDateString())->count();

            $view->with('totalVisitors', $totalVisitors);
            $view->with('todayVisitors', $todayVisitors);
        });

    }
}
