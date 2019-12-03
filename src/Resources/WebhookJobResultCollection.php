<?php

namespace Submtd\LaravelWebhooks\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WebhookJobResultCollection extends ResourceCollection
{
    public function toArray($request = null)
    {
        return [
            'data' => WebhookJobResultResource::collection($this->collection),
        ];
    }
}
