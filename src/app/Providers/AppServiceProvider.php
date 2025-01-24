<?php

namespace App\Providers;

use App\Http\Clients\PetStoreApiClient;
use App\Http\Clients\PetStoreApiClientInterface;
use App\Services\PetStoreService;
use App\Services\PetStoreServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PetStoreServiceInterface::class, PetStoreService::class);
        $this->app->bind(PetStoreApiClientInterface::class, PetStoreApiClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
