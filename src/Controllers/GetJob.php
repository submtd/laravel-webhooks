<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookJob;
use Submtd\LaravelWebhooks\Resources\WebhookJobResource;

class GetJob extends Controller
{
    public function __invoke($job_uuid)
    {
        WebhookJob::addGlobalScope(new RequestScope);
        if (!$job = WebhookJob::where('user_id', Auth::id())->whereUuid($job_uuid)->first()) {
            abort(404);
        }
        return new WebhookJobResource($job);
    }
}
