<?php

namespace Submtd\LaravelWebhooks\Controllers;

use DBD\Webhooks\Resources\TriggerCollection;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\Webhook;
use Submtd\LaravelWebhooks\Models\WebhookTrigger;

class ListTriggers extends Controller
{
    public function __invoke($webhook_uuid)
    {
        if (!$webhook = Webhook::where('user_id', Auth::id())->whereUuid($webhook_uuid)->first()) {
            abort(404);
        }
        WebhookTrigger::addGlobalScope(new RequestScope);
        $triggers = WebhookTrigger::where('user_id', Auth::id())->where('webhook_id', $webhook->id)->jsonPaginate();
        return new TriggerCollection($triggers);
    }
}
