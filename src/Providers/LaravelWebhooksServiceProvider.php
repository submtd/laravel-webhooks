<?php

namespace Submtd\LaravelWebhooks\Providers;

use Illuminate\Support\ServiceProvider;
use Submtd\LaravelWebhooks\Services\LaravelWebhooksService;

class LaravelWebhooksServiceProvider extends ServiceProvider
{
    /**
     * register method
     */
    public function register()
    {
        $this->app->bind('laravel-webhooks', function () {
            return new LaravelWebhooksService();
        });
    }

    /**
     * boot method
     */
    public function boot()
    {
        // config
        $this->mergeConfigFrom(__DIR__ . '/../../config/laravel-webhooks.php', 'laravel-webhooks');
        $this->publishes([__DIR__ . '/../../config' => config_path()], 'config');
        // migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->publishes([__DIR__ . '/../../database' => database_path()], 'migrations');
        // routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }
}
