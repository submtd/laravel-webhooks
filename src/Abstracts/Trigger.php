<?php

namespace Submtd\LaravelWebhooks\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Submtd\LaravelWebhooks\Interfaces\TriggerInterface;

abstract class Trigger implements TriggerInterface
{
    /**
     * ID.
     * @var string
     */
    protected $id;

    /**
     * Name.
     * @var string
     */
    protected $name;

    /**
     * Description.
     * @var string
     */
    protected $description;

    /**
     * Payload.
     * @var Model
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
        if (! $this->id) {
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
}
