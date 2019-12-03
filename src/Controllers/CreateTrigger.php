<?php

namespace Submtd\LaravelWebhooks\Controllers;

use DBD\Webhooks\Resources\TriggerResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelWebhooks\Models\Webhook;
use Submtd\LaravelWebhooks\Rules\TriggerExists;

class CreateTrigger extends Controller
{
    public function __invoke(Request $request, $webhook_uuid)
    {
        if (!$webhook = Webhook::where('user_id', Auth::id())->whereUuid($webhook_uuid)->first()) {
            abort(404);
        }
        $request->validate([
            'trigger' => ['required', new TriggerExists],
        ]);
        $trigger = $webhook->triggers()->firstOrNew($request->all());
        $trigger->user_id = Auth::id();
        if ($trigger->isDirty()) {
            $trigger->save();
        }
        return new TriggerResource($trigger);
    }
}
