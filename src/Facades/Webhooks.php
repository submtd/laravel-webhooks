<?php

namespace Submtd\LaravelWebhooks\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getTriggers()
 * @method static \Submtd\LaravelWebhooks\Interfaces\TriggerInterface getTrigger(string $id)
 * @method static \Submtd\LaravelWebhooks\Services\WebhooksService addTrigger(\Submtd\LaravelWebhooks\Interfaces\TriggerInterface $trigger)
 * @method static void fire(string $id, \Submtd\LaravelWebhooks\Interfaces\Webhookable $payload, int $tries = null)
 *
 * @see \Submtd\LaravelWebhooks\Services\WebhooksService
 */
class Webhooks extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'webhooks';
    }
}
