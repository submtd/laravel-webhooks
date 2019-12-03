<?php

namespace Submtd\LaravelWebhooks\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebhookResource extends JsonResource
{
    public function toArray($request = null)
    {
        return [
            'type' => 'webhook',
            'id' => $this->uuid,
            'attributes' => [
                'integer_id' => $this->id,
                'user_id' => $this->user_id,
                'title' => $this->title,
                'url' => $this->url,
                'active' => (bool) $this->active,
                'verify_ssl' => (bool) $this->verify_ssl,
                'updated_at' => $this->updated_at->toIso8601String(),
                'created_at' => $this->created_at->toIso8601String(),
            ],
        ];
    }
}
