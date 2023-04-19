<?php

Route::post('login', 'Api\\AuthController@login');
Route::post('register', 'Api\\AuthController@register');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {

    // Company
    Route::post('companies/media', 'CompanyApiController@storeMedia')->name('companies.storeMedia');
    Route::apiResource('companies', 'CompanyApiController');

    // Subscription Payment
    Route::apiResource('subscription-payments', 'SubscriptionPaymentApiController');

    // Shop Category
    Route::post('shop-categories/media', 'ShopCategoryApiController@storeMedia')->name('shop-categories.storeMedia');
    Route::apiResource('shop-categories', 'ShopCategoryApiController');

    // Shop Company
    Route::post('shop-companies/media', 'ShopCompanyApiController@storeMedia')->name('shop-companies.storeMedia');
    Route::apiResource('shop-companies', 'ShopCompanyApiController');
    Route::get('companiesByCategory/{category_id}', 'ShopCompanyApiController@companiesByCategory');

    // Shop Product Category
    Route::apiResource('shop-product-categories', 'ShopProductCategoryApiController');
    Route::get('categoriesByCompany/{id}', 'ShopProductCategoryApiController@categoriesByCompany');

    // Shop Product
    Route::post('shop-products/media', 'ShopProductApiController@storeMedia')->name('shop-products.storeMedia');
    Route::apiResource('shop-products', 'ShopProductApiController');
});

Route::middleware('verifyAntiPhishingKey')->prefix('callback')->group(function () {
    Route::get('mb', 'Api\PaymentsController@mb');
    Route::get('mbway', 'Api\PaymentsController@mbway');
});