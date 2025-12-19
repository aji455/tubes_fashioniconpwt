<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\URL;


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
    public function boot()
    {
        if (app()->environment('local')) {
            URL::forceScheme('https');
        }
        // View composer untuk semua view yang membutuhkan kategori
        View::composer(['product.index', 'homepage.layouts.app',], function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
