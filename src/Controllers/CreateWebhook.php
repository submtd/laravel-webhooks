<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelWebhooks\Models\Webhook;
use Submtd\LaravelWebhooks\Resources\WebhookResource;

class CreateWebhook extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'title' => 'nullable|max:255',
            'url' => 'required|max:255|url',
            'active' => 'nullable|boolean',
        ]);
        $input = $request->all();
        if (!isset($input['title'])) {
            $input['title'] = $input['url'];
        }
        if (!isset($input['active'])) {
            $input['active'] = true;
        }
        $webhook = new Webhook($input);
        $webhook->user_id = Auth::id();
        $webhook->save();
        return new WebhookResource($webhook);
    }
}
