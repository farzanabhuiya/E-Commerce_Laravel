<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();


        
        view()->composer('layouts/frontendlayouts',function($view){
            $view->with('categories',Category::with('Subcategorie')->latest()->get());
        });

        view()->composer('layouts/frontendlayouts',function($view){
            $view->with('pages',Page::get());
        });
    }
}