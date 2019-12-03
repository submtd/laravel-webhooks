<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookJob;
use Submtd\LaravelWebhooks\Resources\WebhookJobCollection;

class ListJobs extends Controller
{
    public function __invoke()
    {
        WebhookJob::addGlobalScope(new RequestScope);
        $jobs = WebhookJob::where('user_id', Auth::id())->paginate();
        return new WebhookJobCollection($jobs);
    }
}
