<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelRequestScope\Scopes\RequestScope;
use Submtd\LaravelWebhooks\Models\WebhookTrigger;
use Submtd\LaravelWebhooks\Resources\WebhookTriggerCollection;

class ListTriggers extends Controller
{
    public function __invoke()
    {
        WebhookTrigger::addGlobalScope(new RequestScope);
        $triggers = WebhookTrigger::where('user_id', Auth::id())->jsonPaginate();
        return new WebhookTriggerCollection($triggers);
    }
}
