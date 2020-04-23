<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookJobResult;
use Submtd\LaravelWebhooks\Resources\WebhookJobResultCollection;

class ListResults extends Controller
{
    public function __invoke(Request $request)
    {
        WebhookJobResult::addGlobalScope(new RequestScope);
        $request->request->add(['sort' => $request->get('sort') ?? '-created_at']);
        $request->request->add(['limit' => $request->get('limit') ?? config('webhooks.paginationLimit', 50)]);
        $request->request->add(['offset' => $request->get('offset') ?? 0]);
        $results = WebhookJobResult::where('user_id', Auth::id())->limit($request->get('limit')->offset($request->get('offset'))->get());

        return new WebhookJobResultCollection($results);
    }
}
