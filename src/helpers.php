<?php

if (!function_exists('webhooks')) {
    function webhooks() : Submtd\LaravelWebhooks\Services\LaravelWebhooksService
    {
        return app()->make('webhooks');
    }
}
