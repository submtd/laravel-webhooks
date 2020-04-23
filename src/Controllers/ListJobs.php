<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookJob;
use Submtd\LaravelWebhooks\Resources\WebhookJobCollection;

class ListJobs extends Controller
{
    public function __invoke(Request $request)
    {
        WebhookJob::addGlobalScope(new RequestScope);
        $request->request->add(['sort' => $request->get('sort') ?? '-created_at']);
        $request->request->add(['limit' => $request->get('limit') ?? config('webhooks.paginationLimit', 50)]);
        $request->request->add(['offset' => $request->get('offset') ?? 0]);
        $jobs = WebhookJob::where('user_id', Auth::id())->limit($request->get('limit')->offset($request->get('offset'))->get());

        return new WebhookJobCollection($jobs);
    }
}
