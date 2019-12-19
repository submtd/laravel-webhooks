<?php

namespace Submtd\LaravelWebhooks\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;

class WebhookTrigger extends Model
{
    use GeneratesUuid;

    /**
     * Fillable attributes
     * @var array $fillable
     */
    protected $fillable = [
        'trigger',
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
     * Jobs relationship
     */
    public function jobs()
    {
        return $this->hasMany(WebhookJob::class, 'webhook_trigger_id', 'id');
    }

    /**
     * Results relationship
     */
    public function results()
    {
        return $this->hasMany(WebhookJobResult::class, 'webhook_trigger_id', 'id');
    }
}
