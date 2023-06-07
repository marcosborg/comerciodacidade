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
    Route::get('companyByProductCategory/{id}', 'ShopCompanyApiController@companyByProductCategory');

    // Shop Product Category
    Route::apiResource('shop-product-categories', 'ShopProductCategoryApiController');
    Route::get('categoriesByCompany/{id}', 'ShopProductCategoryApiController@categoriesByCompany');

    // Shop Product Sub Category
    Route::apiResource('shop-product-sub-categories', 'ShopProductSubCategoryApiController');
    Route::get('shop-product-sub-category-by-category-id/{id}', 'ShopProductSubCategoryApiController@shopProductSubCategoryByCategoryId');

    // Shop Product
    Route::post('shop-products/media', 'ShopProductApiController@storeMedia')->name('shop-products.storeMedia');
    Route::apiResource('shop-products', 'ShopProductApiController');
    Route::get('shopProductsByCategoryProduct/{id}', 'ShopProductApiController@shopProductsByCategoryProduct');
    Route::get('shopProductsBySubcategoryProduct/{id}', 'ShopProductApiController@shopProductsBySubcategoryProduct');
    Route::get('randomShopProducts', 'ShopProductApiController@randomShopProducts');

    // Service
    Route::post('services/media', 'ServiceApiController@storeMedia')->name('services.storeMedia');
    Route::apiResource('services', 'ServiceApiController');
    Route::get('shopServicesByCategoryProduct/{id}', 'ServiceApiController@shopServicesByCategoryProduct');
    Route::get('shopServicesBySubcategoryProduct/{id}', 'ServiceApiController@shopServicesBySubcategoryProduct');
    Route::get('randomServices', 'ServiceApiController@randomServices');

    // Service Employee
    Route::apiResource('service-employees', 'ServiceEmployeeApiController');
    Route::post('serviceEmployeeSchedules', 'ServiceEmployeeApiController@serviceEmployeeSchedules');
});

Route::middleware('verifyAntiPhishingKey')->prefix('callback')->group(function () {
    Route::get('mb', 'Api\PaymentsController@mb');
    Route::get('mbway', 'Api\PaymentsController@mbway');
});