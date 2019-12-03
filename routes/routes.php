<?php

Route::group([
    'prefix' => 'api/v1/webhooks',
    'middleware' => 'auth:api',
    'namespace' => 'Submtd\LaravelWebhooks\Controllers',
], function () {
    Route::get('availabletriggers', 'AvailableTriggers');
    Route::get('', 'ListWebhooks');
    Route::post('', 'CreateWebhook');
    Route::get('{webhook_uuid}', 'GetWebhook');
    Route::match(['put', 'patch'], '{webhook_uuid}', 'UpdateWebhook');
    Route::delete('{webhook_uuid}', 'DeleteWebhook');
    Route::get('{webhook_uuid}/triggers', 'ListTriggers');
    Route::post('{webhook_uuid}/triggers', 'CreateTrigger');
    Route::get('{webhook_uuid}/triggers/{trigger_uuid}', 'GetTrigger');
    Route::match(['put', 'patch'], '{webhook_uuid}/triggers/{trigger_uuid}', 'UpdateTrigger');
    Route::delete('{webhook_uuid}/triggers/{trigger_uuid}', 'DeleteTrigger');
    Route::get('{webhook_uuid}/triggers/{trigger_uuid}/jobs', 'ListJobs');
    Route::get('{webhook_uuid}/triggers/{trigger_uuid}/jobs/{job_uuid}', 'GetJob');
    Route::get('{webhook_uuid}/triggers/{trigger_uuid}/jobs/{job_uuid}/results', 'ListResults');
    Route::get('{webhook_uuid}/triggers/{trigger_uuid}/jobs/{job_uuid}/results/{result_uuid}', 'GetResult');
});
