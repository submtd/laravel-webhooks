<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelWebhooks\Models\Webhook;
use Submtd\LaravelWebhooks\Models\WebhookTrigger;

class DeleteTrigger extends Controller
{
    public function __invoke($webhook_uuid, $trigger_uuid)
    {
        if (!$webhook = Webhook::where('user_id', Auth::id())->whereUuid($webhook_uuid)->first()) {
            abort(404);
        }
        if (!$trigger = WebhookTrigger::with('jobs')->with('jobs.results')->where('webhook_id', $webhook->id)->whereUuid($trigger_uuid)->first()) {
            abort(404);
        }
        $trigger->jobs->results()->delete();
        $trigger->jobs()->delete();
        $trigger->delete();
        return response()->json([], 202);
    }
}
