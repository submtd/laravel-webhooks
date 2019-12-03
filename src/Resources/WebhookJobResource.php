<?php

namespace Submtd\LaravelWebhooks\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebhookJobResource extends JsonResource
{
    public function toArray($request = null)
    {
        return [
            'type' => 'webhookJob',
            'id' => $this->uuid,
            'attributes' => [
                'integer_id' => $this->id,
                'user_id' => $this->user_id,
                'webhook_id' => $this->webhook_id,
                'webhook_trigger_id' => $this->webhook_trigger_id,
                'payload_type' => $this->payload_type,
                'payload_id' => $this->payload_id,
                'complete' => (bool) $this->complete,
                'success' => (bool) $this->success,
                'updated_at' => $this->updated_at->toIso8601String(),
                'created_at' => $this->created_at->toIso8601String(),
            ],
        ];
    }
}
