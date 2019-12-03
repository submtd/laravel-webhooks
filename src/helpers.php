<?php

if (!function_exists('webhooks')) {
    function webhooks() : Submtd\LaravelWebhooks\Services\WebhooksService
    {
        return app()->make('webhooks');
    }
}
