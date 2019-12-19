<?php

namespace Submtd\LaravelWebhooks\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;

class WebhookJob extends Model
{
    use GeneratesUuid;

    /**
     * Fillable attributes
     * @var array $fillable
     */
    protected $fillable = [
        'payload_type',
        'payload_id',
        'complete',
        'success',
    ];

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo(config('webhooks.userModel', config('auth.providers.users.model', App\User::class)));
    }

    /**
     * Webhook relationship
     */
    public function webhook()
    {
        return $this->belongsTo(Webhook::class, 'webhook_id', 'id');
    }

    /**
     * Trigger relationship
     */
    public function trigger()
    {
        return $this->belongsTo(WebhookTrigger::class, 'webhook_trigger_id', 'id');
    }

    /**
     * Payload relationship
     */
    public function payload()
    {
        return $this->morphTo();
    }

    /**
     * Results relationship
     */
    public function results()
    {
        return $this->hasMany(WebhookJobResult::class, 'webhook_job_id', 'id');
    }
}
