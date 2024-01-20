<?php

namespace App\Providers;

use App\Repositories\Eloquent\ShotLinkRepository;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShotLinkRepositoryInterface::class, ShotLinkRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
