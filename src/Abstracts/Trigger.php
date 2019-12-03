<?php

namespace Submtd\LaravelWebhooks\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Submtd\LaravelWebhooks\Interfaces\TriggerInterface;

abstract class Trigger implements TriggerInterface
{
    /**
     * ID
     * @var string $id
     */
    protected $id;

    /**
     * Name
     * @var string $name
     */
    protected $name;

    /**
     * Description
     * @var string $description
     */
    protected $description;

    /**
     * Payload
     * @var Model $payload
     */
    protected $payload;

    /**
     * ID
     * Returns the ID of the webhook. This should
     * be unique throughout your entire application.
     * @return string
     */
    public function id() : string
    {
        if (!$this->id) {
            throw new \Exception('Property id is required.');
        }
        return $this->id;
    }

    /**
     * Name
     * Returns the friendly name of the webhook.
     * @return string
     */
    public function name() : string
    {
        return $this->name ?? $this->id();
    }

    /**
     * Description
     * Returns the description of the webhook.
     * @return string
     */
    public function description() : string
    {
        return $this->description ?? $this->id();
    }

    /**
     * Payload setter
     * Sets the payload for the webhook.
     * @param Model $payload
     * @return TriggerInterface
     */
    public function setPayload(Model $payload) : TriggerInterface
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * Payload getter
     * Gets the payload for the webhook.
     * @return array
     */
    public function getPayload() : array
    {
        return $this->payload->toArray();
    }
}
