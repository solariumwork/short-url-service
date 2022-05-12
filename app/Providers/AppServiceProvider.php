<?php

namespace App\Providers;

use App\Repositories\ShortUrlRepository;
use App\Repositories\ShortUrlRepositoryInterface;
use App\Services\ShortUrlCachedService;
use App\Services\ShortUrlCachedServiceInterface;
use App\Services\UrlShortenerService;
use App\Services\UrlShortenerServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UrlShortenerServiceInterface::class, UrlShortenerService::class);
        $this->app->bind(ShortUrlCachedServiceInterface::class, ShortUrlCachedService::class);

        $this->app->bind(ShortUrlRepositoryInterface::class, ShortUrlRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
