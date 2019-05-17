<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Shortener;
use App\Models\Employee;
use App\Observers\EmployeeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Employee::observe(EmployeeObserver::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Shortener::class, function ($app) {
            return new Shortener(config('shortener.login'), config('shortener.password'), config('shortener.base_url'));
        });
    }
}
