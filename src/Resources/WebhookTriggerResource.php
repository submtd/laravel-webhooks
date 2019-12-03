<?php

namespace Submtd\LaravelWebhooks\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebhookTriggerResource extends JsonResource
{
    public function toArray($request = null)
    {
        return [
            'type' => 'trigger',
            'id' => $this->uuid,
            'attributes' => [
                'integer_id' => $this->id,
                'user_id' => $this->user_id,
                'webhook_id' => $this->webhook_id,
                'trigger' => $this->trigger,
                'updated_at' => $this->updated_at->toIso8601String(),
                'created_at' => $this->created_at->toIso8601String(),
            ],
            'related' => [
                'webhook' => new WebhookResource($this->whenLoaded('webhook')),
                'jobs' => new WebhookJobCollection($this->whenLoaded('jobs')),
                'results' => new WebhookJobResultCollection($this->whenLoaded('results')),
            ]
        ];
    }
}
