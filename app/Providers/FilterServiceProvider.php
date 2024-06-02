<?php

namespace App\Providers;

use App\Services\FilterService;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(FilterService::class, function ($app) {
            return new FilterService();
        });
    }
}
