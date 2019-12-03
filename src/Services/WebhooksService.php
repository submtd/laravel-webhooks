<?php

namespace Submtd\LaravelWebhooks\Services;

use Submtd\LaravelWebhooks\Interfaces\TriggerInterface;
use Submtd\LaravelWebhooks\Interfaces\Webhookable;

class WebhooksService
{
    /**
     * Available Triggers
     * @var array $triggers
     */
    protected $triggers = [];

    /**
     * Get triggers
     * @return array
     */
    public function getTriggers()
    {
        return $this->triggers;
    }

    /**
     * Get trigger
     * @param string $id
     * @return TriggerInterface
     */
    public function getTrigger(string $id)
    {
        if (!isset($this->triggers[$id])) {
            throw new \Exception('Unknown trigger');
        }
        return $this->triggers[$id];
    }

    /**
     * Add trigger
     * @param TriggerInterface $trigger
     * @return WebhooksService
     */
    public function addTrigger(TriggerInterface $trigger)
    {
        $this->triggers[$trigger->id()] = $trigger;
        return $this;
    }

    /**
     * trigger
     * @param string $id
     * @param Webhookable $payload
     */
    public function fire(string $id, Webhookable $payload)
    {
        $trigger = $this->getTrigger($id);
        $trigger->setPayload($payload);
        return $trigger;
    }
}
