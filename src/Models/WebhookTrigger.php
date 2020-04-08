<?php

namespace Submtd\LaravelWebhooks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WebhookTrigger extends Model
{
    /**
     * Fillable attributes
     * @var array $fillable
     */
    protected $fillable = [
        'trigger',
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
