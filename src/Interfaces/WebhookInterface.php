<?php

namespace Submtd\LaravelWebhooks\Interfaces;

interface WebhookInterface
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
}
