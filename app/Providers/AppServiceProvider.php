<?php

namespace App\Providers;

use App\Shared\Cache;
use App\Shared\Database;
use Core\Shared\Interfaces\CacheInterface;
use Core\Shared\Interfaces\DatabaseInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DatabaseInterface::class, Database::class);
        $this->app->singleton(CacheInterface::class, Cache::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
