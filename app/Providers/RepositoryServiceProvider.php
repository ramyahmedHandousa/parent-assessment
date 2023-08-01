<?php

namespace App\Providers;

use App\Repository\interface\JsonFileRepositoryInterface;
use App\Repository\JsonFileRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(JsonFileRepositoryInterface::class, JsonFileRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
