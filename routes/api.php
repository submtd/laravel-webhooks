<?php

Route::group([
    'prefix' => config('laravel-webhooks.routePrefix', 'api/v1/webhooks'),
    'middleware' => config('laravel-webhooks.routeMiddleware', ['auth:api']),
    'namespace' => 'Submtd\LaravelWebhooks\Controllers',
], function() {
    // api routes go here
});