<?php

namespace Submtd\LaravelWebhooks\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WebhookTriggerCollection extends ResourceCollection
{
    public function toArray($request = null)
    {
        return [
            'data' => WebhookTriggerResource::collection($this->collection),
        ];
    }
}
