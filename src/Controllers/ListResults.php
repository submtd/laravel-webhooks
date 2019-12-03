<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookJob;
use Submtd\LaravelWebhooks\Models\WebhookJobResult;
use Submtd\LaravelWebhooks\Resources\WebhookJobResultCollection;

class ListResults extends Controller
{
    public function __invoke($webhook_uuid, $trigger_uuid, $job_uuid)
    {
        if (!$job = WebhookJob::where('user_id', Auth::id())->whereUuid($job_uuid)->first()) {
            abort(404);
        }
        WebhookJobResult::addGlobalScope(new RequestScope);
        $results = WebhookJobResult::where('user_id', Auth::id())->where('webhook_job_id', $job->id)->jsonPaginate();
        return new WebhookJobResultCollection($results);
    }
}
