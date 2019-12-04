<?php

namespace Submtd\LaravelWebhooks\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Submtd\LaravelEncryptedFields\HasEncryptedFields;

class Webhook extends Model
{
    use GeneratesUuid, HasEncryptedFields;

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
        return $this->hasMany(WebhookTrigger::class);
    }

    /**
     * Jobs relationship
     */
    public function jobs()
    {
        return $this->hasMany(WebhookJob::class);
    }

    /**
     * Results relationship
     */
    public function results()
    {
        return $this->hasMany(WebhookJobResult::class);
    }
}
