<?php

namespace Submtd\LaravelWebhooks\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Submtd\LaravelWebhooks\Models\WebhookJob;

trait IsWebhookable
{
    /**
     * Jobs relationship
     */
    public function jobs() : MorphMany
    {
        return $this->morphMany(WebhookJob::class, 'payload');
    }

    /**
     * Formatter
     */
    public function formatter() : string
    {
        return $this->formatter;
    }
}
