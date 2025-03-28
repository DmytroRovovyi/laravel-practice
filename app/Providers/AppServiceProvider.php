<?php

namespace App\Providers;

use App\Services\YouTubeService;
use App\Services\WikipediaService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(YouTubeService::class, function () {
            return new YouTubeService();
        });

        $this->app->singleton(WikipediaService::class, function () {
            return new WikipediaService();
        });
    }

    public function boot(): void
    {
        Paginator::useBootstrapFour();
    }
}
