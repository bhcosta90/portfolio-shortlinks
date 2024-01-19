<?php

namespace App\Providers;

use App\Shared\ShortLinkCache;
use App\Shared\Database;
use Core\Domain\Cache\ShortLinkCacheInterface;
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
        $this->app->singleton(ShortLinkCacheInterface::class, ShortLinkCache::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
