<?php

namespace Submtd\LaravelWebhooks\Traits;

use Submtd\LaravelWebhooks\Models\WebhookJob;

trait IsWebhookable
{
    /**
     * Jobs relationship
     */
    public function jobs()
    {
        return $this->morphMany(WebhookJob::class, 'payload');
    }
}
