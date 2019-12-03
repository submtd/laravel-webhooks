<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\Webhook;
use Submtd\LaravelWebhooks\Models\WebhookTrigger;
use Submtd\LaravelWebhooks\Resources\WebhookTriggerCollection;

class ListTriggers extends Controller
{
    public function __invoke($webhook_uuid)
    {
        if (!$webhook = Webhook::where('user_id', Auth::id())->whereUuid($webhook_uuid)->first()) {
            abort(404);
        }
        WebhookTrigger::addGlobalScope(new RequestScope);
        $triggers = WebhookTrigger::where('user_id', Auth::id())->where('webhook_id', $webhook->id)->jsonPaginate();
        return new WebhookTriggerCollection($triggers);
    }
}
