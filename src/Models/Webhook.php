<?php

namespace Submtd\LaravelWebhooks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Webhook extends Model
{
    /**
     * Fillable attributes
     * @var array $fillable
     */
    protected $fillable = [
        'title',
        'url',
        'encryption_key',
        'active',
    ];

    /**
     * Encrypted fields
     * @var array $encrypt
     */
    public static $encrypt = [
        'encryption_key',
    ];

    /**
     * Hidden fields
     * @var array $hidden
     */
    protected $hidden = [
        'encryption_key',
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
     * get encryption key
     */
    public function getEncryptionKeyAttribute($value)
    {
        if (!empty($value)) {
            return decrypt($value);
        }
    }

    /**
     * set encryption key
     */
    public function setEncryptionKeyAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['encryption_key'] = encrypt($value);
        }
    }

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo(config('webhooks.userModel', config('auth.providers.users.model', App\User::class)));
    }

    /**
     * Triggers relationship
     */
    public function triggers()
    {
        return $this->hasMany(WebhookTrigger::class, 'webhook_id', 'id');
    }

    /**
     * Jobs relationship
     */
    public function jobs()
    {
        return $this->hasMany(WebhookJob::class, 'webhook_id', 'id');
    }

    /**
     * Results relationship
     */
    public function results()
    {
        return $this->hasMany(WebhookJobResult::class, 'webhook_id', 'id');
    }
}
