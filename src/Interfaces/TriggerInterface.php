<?php

namespace Submtd\LaravelWebhooks\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface TriggerInterface
{
    /**
     * ID
     * Returns the ID of the webhook. This should
     * be unique throughout your entire application.
     * @return string
     */
    public function id() : string;

    /**
     * Name
     * Returns the friendly name of the webhook.
     * @return string
     */
    public function name() : string;

    /**
     * Description
     * Returns the description of the webhook.
     * @return string
     */
    public function description() : string;

    /**
     * Payload setter
     * Sets the payload for the webhook.
     * @param Model $payload
     * @return TriggerInterface
     */
    public function setPayload(Model $payload) : TriggerInterface;

    /**
     * Payload getter
     * Gets the payload for the webhook.
     * @return array
     */
    public function getPayload() : array;
}
