<?php

namespace Submtd\LaravelWebhooks\Rules;

use Illuminate\Contracts\Validation\Rule;
use Submtd\LaravelWebhooks\Facades\Webhooks;

class TriggerExists implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return array_key_exists($value, Webhooks::getTriggers());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute is not a valid trigger.';
    }
}
