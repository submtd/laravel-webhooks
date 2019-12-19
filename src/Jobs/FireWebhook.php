<?php

namespace Submtd\LaravelWebhooks\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Submtd\LaravelHttpRequest\Facades\Http;
use Submtd\LaravelWebhooks\Models\WebhookJob;
use Submtd\LaravelWebhooks\Models\WebhookJobResult;

class FireWebhook implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Webhook job
     * @var WebhookJob $webhookJob
     */
    protected $webhookJob;

    /**
     * Tries
     * @var int $tries
     */
    protected $tries;

    /**
     * Class constructor
     * @param WebhookJob $webhookJob
     * @param int $tries
     */
    public function __construct(WebhookJob $webhookJob, int $tries = null)
    {
        $this->webhookJob = $webhookJob;
        $this->tries = $tries ?? config('webhooks.retryAttempts', 5);
    }

    /**
     * Handle method
     */
    public function handle()
    {
        try {
            // create the result model
            $webhookJobResult = new WebhookJobResult();
            $webhookJobResult->user_id = $this->webhookJob->user_id;
            $webhookJobResult->webhook_id = $this->webhookJob->webhook_id;
            $webhookJobResult->webhook_trigger_id = $this->webhookJob->webhook_trigger_id;
            $webhookJobResult->webhook_job_id = $this->webhookJob->id;
            $webhookJobResult->save();
            $trigger = $this->webhookJob->trigger->trigger;
            $payload = json_encode($this->webhookJob->payload->toArray());
            $hash = hash('sha256', $payload . $this->webhookJob->webhook->encryption_key);
            $body = [
                'trigger' => $trigger,
                'payload' => $payload,
                'hash' => $hash,
            ];
            Log::debug(json_encode($body));
            $http = Http::init();
            $http->url($this->webhookJob->webhook->url);
            $http->method('POST');
            $http->header('Content-Type', 'application/x-www-form-urlencoded');
            $http->body([
                'trigger' => $trigger,
                'payload' => $payload,
                'hash' => $hash,
            ]);
            $http->request();
            $webhookJobResult->update([
                'response_code' => $http->getStatusCode(),
                'response_body' => $http->getResponse(),
                'success' => true,
            ]);
            $this->webhookJob->update([
                'complete' => true,
                'success' => true,
            ]);
            return true;
        } catch (\Exception $e) {
            $webhookJobResult->update([
                'response_code' => $e->getCode(),
                'response_body' => $e->getMessage(),
            ]);
            if ($this->attempts() < $this->tries) {
                $this->release($this->attempts() * 60);
            } else {
                $this->webhookJob->update([
                    'complete' => true,
                ]);
                $this->fail($e);
            }
        }
    }
}
