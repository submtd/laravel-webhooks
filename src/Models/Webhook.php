<?php

namespace Submtd\LaravelWebhooks\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    use GeneratesUuid;

    /**
     * Fillable attributes
     * @var array $fillable
     */
    protected $fillable = [
        'title',
        'url',
        'active',
        'verify_ssl',
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
