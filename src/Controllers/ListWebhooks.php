<?php

namespace Submtd\LaravelWebhooks\Controllers;

use DBD\Webhooks\Resources\WebhookCollection;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\Webhook;

class ListWebhooks extends Controller
{
    public function __invoke()
    {
        Webhook::addGlobalScope(new RequestScope);
        $webhooks = Webhook::where('user_id', Auth::id())->jsonPaginate();
        return new WebhookCollection($webhooks);
    }
}
