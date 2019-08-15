<?php

namespace Submtd\LaravelWebhooks\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelWebhooksFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-webhooks';
    }
}
