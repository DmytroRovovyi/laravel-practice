<?php

namespace App\Providers;

use App\Services\YouTubeService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(YouTubeService::class, function () {
            return new YouTubeService();
        });
    }

    public function boot(): void
    {
        Paginator::useBootstrapFour();
    }
}
