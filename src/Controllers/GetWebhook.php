<?php

namespace Submtd\LaravelWebhooks\Controllers;

use DBD\Webhooks\Resources\WebhookResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelWebhooks\Models\Webhook;

class GetWebhook extends Controller
{
    public function __invoke($uuid)
    {
        if (!$webhook = Webhook::where('user_id', Auth::id)->whereUuid($uuid)->first()) {
            abort(404);
        }
        return new WebhookResource($webhook);
    }
}
