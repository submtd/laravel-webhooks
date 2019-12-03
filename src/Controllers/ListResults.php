<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookJobResult;
use Submtd\LaravelWebhooks\Resources\WebhookJobResultCollection;

class ListResults extends Controller
{
    public function __invoke()
    {
        WebhookJobResult::addGlobalScope(new RequestScope);
        $results = WebhookJobResult::where('user_id', Auth::id())->jsonPaginate();
        return new WebhookJobResultCollection($results);
    }
}
