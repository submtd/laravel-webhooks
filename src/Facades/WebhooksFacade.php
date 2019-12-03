<?php

namespace Submtd\LaravelWebhooks\Facades;

use Illuminate\Support\Facades\Facade;

class WebhooksFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'webhooks';
    }
}
