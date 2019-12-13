<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Submtd\LaravelWebhooks\Resources\WebhookResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\Webhook;

class GetWebhook extends Controller
{
    public function __invoke($webhook_uuid)
    {
        Webhook::addGlobalScope(new RequestScope);
        if (!$webhook = Webhook::where('user_id', Auth::id())->whereUuid($webhook_uuid)->first()) {
            abort(404);
        }
        return new WebhookResource($webhook);
    }
}
