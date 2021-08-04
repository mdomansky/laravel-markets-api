<?php

namespace App\Providers;

use App\Services\Markets\ImportAssetsInterface;
use App\Services\Markets\MOEX\ImportAssets;
use Illuminate\Support\ServiceProvider;

class MarketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImportAssetsInterface::class, ImportAssets::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
