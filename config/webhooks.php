<?php

return [
    'userModel' => env('WEBHOOKS_USER_MODEL', App\User::class),
    'retryAttempts' => env('WEBHOOKS_RETRY_ATTEMPTS', 5),
    'paginationLimit' => env('WEBHOOKS_PAGINATION_LIMIT', 50),
];
