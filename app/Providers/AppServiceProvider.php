<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use App\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('default.layouts.header', function ($view) {
            $categories = Category::latest()->where('parent_id',0)->get();
            return $view->with(compact('categories'));
        });
    }
}
