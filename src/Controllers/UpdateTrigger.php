<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelWebhooks\Models\Webhook;
use Submtd\LaravelWebhooks\Models\WebhookTrigger;
use Submtd\LaravelWebhooks\Resources\WebhookTriggerResource;
use Submtd\LaravelWebhooks\Rules\TriggerExists;

class UpdateTrigger extends Controller
{
    public function __invoke(Request $request, $webhook_uuid, $trigger_uuid)
    {
        if (!$webhook = Webhook::where('user_id', Auth::id())->whereUuid($webhook_uuid)->first()) {
            abort(404);
        }
        if (!$trigger = WebhookTrigger::where('webhook_id', $webhook->id)->whereUuid($trigger_uuid)->first()) {
            abort(404);
        }
        $request->validate([
            'trigger' => ['nullable', new TriggerExists],
        ]);
        $trigger->fill($request->all());
        if ($trigger->isDirty()) {
            $trigger->save();
        }
        return new WebhookTriggerResource($trigger);
    }
}
