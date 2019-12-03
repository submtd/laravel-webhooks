<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookTrigger;
use Submtd\LaravelWebhooks\Resources\WebhookTriggerResource;

class GetTrigger extends Controller
{
    public function __invoke($webhook_uuid, $trigger_uuid)
    {
        WebhookTrigger::addGlobalScope(new RequestScope);
        if (!$trigger = WebhookTrigger::where('user_id', Auth::id())->whereUuid($trigger_uuid)->first()) {
            abort(404);
        }
        return new WebhookTriggerResource($trigger);
    }
}
