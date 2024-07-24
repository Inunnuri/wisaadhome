<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Jenis;

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
        // Mengirim data kategori ke semua view
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });
        View::composer('*', function ($view) {
            $view->with('jenis', Jenis::all());
        });
    }

}
