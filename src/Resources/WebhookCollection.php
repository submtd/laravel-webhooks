<?php

namespace Submtd\LaravelWebhooks\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WebhookCollection extends ResourceCollection
{
    public function toArray($request = null)
    {
        return [
            'data' => WebhookResource::collection($this->collection),
        ];
    }
}
