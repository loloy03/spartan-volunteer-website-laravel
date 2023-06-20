<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

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
        // uses bootstrap to design laravel page pagination
        Paginator::useBootstrap();

        // custom blade components: @staff & @admin
        Blade::if('staff', function () {
            return auth()->guard('staff')->check();
        });

        Blade::if('admin', function () {
            return auth()->guard('admin')->check();
        });

        Blade::if('visitor', function () {
            return !auth()->check() && !auth()->guard('admin')->check() && !auth()->guard('staff')->check();
        });
    }
}
