<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        view()->composer('*', function ($view) {
            $view->with('categoriesShared', \App\Models\Category::all());
            $view->with('breakingNewsShared', \App\Models\BreakingNews::with('article')->first() ?? new \App\Models\BreakingNews([
                'mode' => 'custom',
                'content' => 'Ibukota Nusantara Siap Diresmikan Bulan Depan. • Presiden Kunjungi Papua Untuk Proyek Strategis. • Kurs Rupiah Menguat Terhadap Dollar AS. • NDN'
            ]));
        });
    }
}
