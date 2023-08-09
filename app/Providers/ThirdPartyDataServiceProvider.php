<?php

namespace App\Providers;

use App\Services\TMDB\Service;
use Illuminate\Support\ServiceProvider;

class ThirdPartyDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            abstract: Service::class,
            concrete: function (){
                return new Service(
                    config('api.tmdb.base_url'),
                    config('api.tmdb.paths'),
                    config('api.tmdb.api_key'),
                    config('api.tmdb.timeout')
                );
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
