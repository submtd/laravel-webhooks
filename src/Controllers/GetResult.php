<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookJobResult;
use Submtd\LaravelWebhooks\Resources\WebhookJobResultResource;

class GetResult extends Controller
{
    public function __invoke($webhook_uuid, $trigger_uuid, $job_uuid, $result_uuid)
    {
        WebhookJobResult::addGlobalScope(new RequestScope);
        if (!$result = WebhookJobResult::where('user_id', Auth::id())->whereUuid($result_uuid)->first()) {
            abort(404);
        }
        return new WebhookJobResultResource($result);
    }
}
