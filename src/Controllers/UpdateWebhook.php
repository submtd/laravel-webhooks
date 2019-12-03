<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelWebhooks\Models\Webhook;
use Submtd\LaravelWebhooks\Resources\WebhookResource;

class UpdateWebhook extends Controller
{
    public function __invoke(Request $request, $webhook_uuid)
    {
        $request->validate([
            'title' => 'nullable|max:255',
            'url' => 'nullable|max:255|url',
            'active' => 'nullable|boolean',
            'verify_ssl' => 'nullable|boolean',
        ]);
        if (!$webhook = Webhook::where('user_id', Auth::id)->whereUuid($webhook_uuid)->first()) {
            abort(404);
        }
        $webhook->update($request->all());
        return new WebhookResource($webhook);
    }
}
