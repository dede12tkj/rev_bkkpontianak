<?php

namespace App\Providers;

use App\Support\HomeCache;
use App\Support\HtmlSanitizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
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
        // Saring HTML dari editor admin sebelum disimpan (daftar model/kolom: config/richtext.php).
        Event::listen('eloquent.saving: *', function (string $eventName, array $payload) {
            if (! config('richtext.enabled', true)) {
                return;
            }

            $model = $payload[0] ?? null;
            if (! $model instanceof Model) {
                return;
            }

            $fields = config('richtext.fields', [])[$model::class] ?? [];
            foreach ($fields as $field) {
                $value = $model->getAttribute($field);
                if ($model->isDirty($field) && is_string($value)) {
                    $model->setAttribute($field, HtmlSanitizer::clean($value));
                }
            }
        });

        View::composer(['layouts.app', 'layouts.detail'], function ($view) {
            $view->with(HomeCache::visitorCounts());
        });
    }
}
