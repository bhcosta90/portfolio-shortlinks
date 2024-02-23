<?php

namespace App\Providers;

use App\Core\Cache\ShortLinkCache;
use App\Core\Event\ShortLinkEventManager;
use App\Core\Repositories\ShortLinkRepository;
use Core\Domain\Contracts\ShortLinkCacheInterface;
use Core\Domain\Contracts\ShortLinkEventManagerInterface;
use Core\Domain\Contracts\ShortLinkRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ShortLinkRepositoryInterface::class, ShortLinkRepository::class);
        $this->app->bind(ShortLinkCacheInterface::class, ShortLinkCache::class);
        $this->app->bind(ShortLinkEventManagerInterface::class, ShortLinkEventManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
