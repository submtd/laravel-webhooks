<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelWebhooks\Models\Webhook;
use Submtd\LaravelWebhooks\Models\WebhookTrigger;

class DeleteTrigger extends Controller
{
    public function __invoke($trigger_uuid)
    {
        if (!$trigger = WebhookTrigger::where('user_id', Auth::id())->whereUuid($trigger_uuid)->first()) {
            abort(404);
        }
        $trigger->jobs->results()->delete();
        $trigger->jobs()->delete();
        $trigger->delete();
        return response()->json([], 202);
    }
}
