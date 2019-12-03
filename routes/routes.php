<?php

Route::group([
    'prefix' => 'api/v1/webhooks',
    'middleware' => 'auth:api',
    'namespace' => 'Submtd\LaravelWebhooks\Controllers',
], function () {
    Route::get('', 'ListWebhooks');
    Route::post('', 'CreateWebhook');
    Route::get('{uuid}', 'GetWebhook');
    Route::match(['put', 'patch'], '{uuid}', 'UpdateWebhook');
    Route::delete('{uuid}', 'DeleteWebhook');
    Route::get('availabletriggers', 'AvailableTriggers');
});
