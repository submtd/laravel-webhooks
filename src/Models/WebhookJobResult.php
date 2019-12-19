<?php

namespace Submtd\LaravelWebhooks\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;

class WebhookJobResult extends Model
{
    use GeneratesUuid;

    /**
     * Fillable attributes
     * @var array $fillable
     */
    protected $fillable = [
        'response_code',
        'response_body',
        'success',
    ];

    /**
     * Boot method
     */
    public static function boot()
    {
        parent::boot();
        // make body fit in 255 characters
        static::creating(function ($model) {
            $model->response_body = substr($model->response_body, 0, 255);
        });
        static::updating(function ($model) {
            $model->response_body = substr($model->response_body, 0, 255);
        });
    }

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
     * Job relationship
     */
    public function job()
    {
        return $this->belongsTo(WebhookJob::class, 'webhook_job_id', 'id');
    }
}
