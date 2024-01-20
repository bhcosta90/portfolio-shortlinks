<?php

namespace App\Providers;

use App\Shared\Database;
use App\Shared\RabbitMQ;
use App\Shared\ShortLinkCache;
use Core\Infra\Cache\ShortLinkCacheInterface;
use Core\Shared\Interfaces\DatabaseInterface;
use Core\Shared\Interfaces\PublishInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrapFive();

        $this->app->singleton(DatabaseInterface::class, Database::class);
        $this->app->singleton(ShortLinkCacheInterface::class, ShortLinkCache::class);
        $this->app->singleton(PublishInterface::class, RabbitMQ::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
