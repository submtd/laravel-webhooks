<?php

return [
    'routePrefix' => 'api/v1/webhooks',
    'routeMiddleware' => ['auth:api'],
    'routeNamespace' => 'Submtd\LaravelWebhooks\Controllers',
];
