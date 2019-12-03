<?php

namespace Submtd\LaravelWebhooks\Interfaces;

interface Webhookable
{
    /**
     * Jobs relationship
     * should be:
     * return $this->morphMany(Submtd\LaravelWebhooks\Models\WebhookJob::class, 'payload')'
     * Use helper trait Submtd\LaravelWebhooks\Traits\IsWebhookable
     */
    public function jobs();
}
