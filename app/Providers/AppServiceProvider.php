<?php

namespace App\Providers;

use App\Helper\JsonResponder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('responder', fn ($app) => new JsonResponder());


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
