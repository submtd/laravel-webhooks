<?php

namespace Submtd\LaravelWebhooks\Services;

use Submtd\LaravelWebhooks\Interfaces\TriggerInterface;
use Submtd\LaravelWebhooks\Interfaces\Webhookable;
use Submtd\LaravelWebhooks\Jobs\FireWebhook;
use Submtd\LaravelWebhooks\Models\WebhookJob;
use Submtd\LaravelWebhooks\Models\WebhookTrigger;

class WebhooksService
{
    /**
     * Available Triggers
     * @var array $triggers
     */
    protected $triggers = [];

    /**
     * Get triggers
     * @return array
     */
    public function getTriggers()
    {
        return $this->triggers;
    }

    /**
     * Get trigger
     * @param string $id
     * @return TriggerInterface
     */
    public function getTrigger(string $id)
    {
        if (!isset($this->triggers[$id])) {
            throw new \Exception('Unknown trigger');
        }
        return $this->triggers[$id];
    }

    /**
     * Add trigger
     * @param TriggerInterface $trigger
     * @return WebhooksService
     */
    public function addTrigger(TriggerInterface $trigger)
    {
        $this->triggers[$trigger->id()] = $trigger;
        return $this;
    }

    /**
     * trigger
     * @param string $id
     * @param Webhookable $payload
     */
    public function fire(string $id, Webhookable $payload, int $tries = null)
    {
        $triggers = WebhookTrigger::with('webhook')->where('webhooks.active', true)->where('user_id', $payload->userId())->where('trigger', $id)->get();
        foreach ($triggers as $trigger) {
            $job = new WebhookJob([
                'payload_type' => get_class($payload),
                'payload_id' => $payload->id,
            ]);
            $job->user_id = $trigger->user_id;
            $job->webhook_id = $trigger->webhook_id;
            $job->webhook_trigger_id = $trigger->id;
            $job->save();

            dispatch(new FireWebhook($job, $tries ?? config('webhooks.retryAttempts', 5)));
        }
    }
}
