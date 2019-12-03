<?php

namespace Submtd\LaravelWebhooks\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Webhookable
{
    /**
     * Jobs relationship
     * should be:
     * return $this->morphMany(Submtd\LaravelWebhooks\Models\WebhookJob::class, 'payload')'
     * Use helper trait Submtd\LaravelWebhooks\Traits\IsWebhookable
     */
    public function jobs() : MorphMany;

    /**
     * User id
     * should return the user id for the model
     */
    public function userId() : int;
}
