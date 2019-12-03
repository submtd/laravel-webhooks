<?php

Route::group([
    'prefix' => 'api/v1/webhooks',
    'middleware' => 'auth:api',
    'namespace' => 'Submtd\LaravelWebhooks\Controllers',
], function () {
    Route::get('availabletriggers', 'AvailableTriggers');
    Route::get('triggers', 'ListTriggers');
    Route::get('triggers/{trigger_uuid}', 'GetTrigger');
    Route::match(['put', 'patch'], 'triggers/{trigger_uuid}', 'UpdateTrigger');
    Route::delete('triggers/{trigger_uuid}', 'DeleteTrigger');
    Route::get('jobs', 'ListJobs');
    Route::get('jobs/{job_uuid}', 'GetJob');
    Route::get('results', 'ListResults');
    Route::get('results/{result_uuid}', 'GetResult');
    Route::get('', 'ListWebhooks');
    Route::post('', 'CreateWebhook');
    Route::get('{webhook_uuid}', 'GetWebhook');
    Route::match(['put', 'patch'], '{webhook_uuid}', 'UpdateWebhook');
    Route::delete('{webhook_uuid}', 'DeleteWebhook');
    Route::post('{webhook_uuid}/triggers', 'CreateTrigger');
});
