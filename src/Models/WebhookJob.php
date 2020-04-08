<?php

namespace Submtd\LaravelWebhooks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WebhookJob extends Model
{
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
     * Boot method
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!isset($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
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
