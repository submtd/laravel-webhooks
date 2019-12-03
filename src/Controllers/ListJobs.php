<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookJob;
use Submtd\LaravelWebhooks\Resources\WebhookJobCollection;

class ListJobs extends Controller
{
    public function __invoke($webhook_uuid, $trigger_uuid)
    {
        if (!$trigger = WebhookTrigger::where('user_id', Auth::id())->whereUuid($trigger_uuid)->first()) {
            abort(404);
        }
        WebhookJob::addGlobalScope(new RequestScope);
        $jobs = WebhookJob::where('user_id', Auth::id())->where('webhook_trigger_id', $trigger->id)->jsonPaginate();
        return new WebhookJobCollection($jobs);
    }
}
