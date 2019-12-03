<?php

namespace Submtd\LaravelWebhooks\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebhookJobResultResource extends JsonResource
{
    public function toArray($request = null)
    {
        return [
            'type' => 'webhookJobResult',
            'id' => $this->uuid,
            'attributes' => [
                'integer_id' => $this->id,
                'user_id' => $this->user_id,
                'webhook_id' => $this->webhook_id,
                'webhook_trigger_id' => $this->webhook_trigger_id,
                'webhook_job_id' => $this->webhook_job_id,
                'response_code' => $this->response_code,
                'response_body' => $this->response_body,
                'success' => (bool) $this->success,
                'updated_at' => $this->updated_at->toIso8601String(),
                'created_at' => $this->created_at->toIso8601String(),
            ],
        ];
    }
}
