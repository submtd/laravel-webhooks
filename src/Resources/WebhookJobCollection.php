<?php

namespace Submtd\LaravelWebhooks\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WebhookJobCollection extends ResourceCollection
{
    public function toArray($request = null)
    {
        return [
            'data' => WebhookJobResource::collection($this->collection),
        ];
    }
}
