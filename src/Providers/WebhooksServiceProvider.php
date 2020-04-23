<?php

namespace Submtd\LaravelWebhooks\Providers;

use Illuminate\Support\ServiceProvider;
use Submtd\LaravelWebhooks\Services\WebhooksService;

class WebhooksServiceProvider extends ServiceProvider
{
    /**
     * register method.
     */
    public function register()
    {
        // webhooks singleton
        $this->app->singleton(WebhooksService::class, function () {
            return new WebhooksService();
        });
        // webhooks facade
        $this->app->bind('webhooks', function () {
            return $this->app->make(WebhooksService::class);
        });
    }

    /**
     * boot method.
     */
    public function boot()
    {
        // config
        $this->mergeConfigFrom(__DIR__.'/../../config/webhooks.php', 'webhooks');
        $this->publishes([__DIR__.'/../../config' => config_path()], 'config');
        // migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->publishes([__DIR__.'/../../database' => database_path()], 'migrations');
        // routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/routes.php');
    }
}
