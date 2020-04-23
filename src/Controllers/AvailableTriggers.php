<?php

namespace Submtd\LaravelWebhooks\Controllers;

use Illuminate\Routing\Controller;
use Submtd\LaravelWebhooks\Facades\Webhooks;

class AvailableTriggers extends Controller
{
    public function __invoke()
    {
        $triggers = Webhooks::getTriggers();
        $return = [];
        foreach ($triggers as $trigger) {
            $return[] = [
                'type' => 'availableTrigger',
                'id' => $trigger->id(),
                'attributes' => [
                    'name' => $trigger->name(),
                    'description' => $trigger->description(),
                ],
            ];
        }

        return response()->json(['data' => $return]);
    }
}
