<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
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
        view()->composer('front.app.nav', function ($view) {
            $setting = Setting::whereIn('id', [1, 2, 3, 4])
                ->orderBy('id')
                ->get();

            $view->with([
                'slogan' => $setting,
            ]);
        });

        view()->composer('front.app.menu', function ($view) {
            $menuCategories = Category::whereMenu(1)
                ->whereActive(1)
                ->orderBy('sort_order')
                ->get();

            $view->with([
                'menuCategories' => $menuCategories,
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
