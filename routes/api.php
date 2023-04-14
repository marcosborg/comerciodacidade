<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Subscription Payment
    Route::apiResource('subscription-payments', 'SubscriptionPaymentApiController');
});

Route::middleware('verifyAntiPhishingKey')->prefix('callback')->group(function(){
    Route::get('mb', 'Api\PaymentsController@mb');
    Route::get('mbway', 'Api\PaymentsController@mbway');
});