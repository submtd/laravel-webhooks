<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelWebhooks\Models\Webhook;

class DeleteWebhook extends Controller
{
    public function __invoke($webhook_uuid)
    {
        if (!$webhook = Webhook::with('triggers')->with('triggers.jobs')->with('triggers.jobs.results')->where('user_id', Auth::id)->whereUuid($webhook_uuid)->first()) {
            abort(404);
        }
        $webhook->triggers->jobs->results()->delete();
        $webhook->triggers->jobs()->delete();
        $webhook->triggers()->delete();
        $webhook->delete();
        return response()->json([], 202);
    }
}
