<?php

Route::get('/', 'WebsiteController@index')->name('homepage');

Route::prefix('forms')->group(function () {
    Route::post('contact', 'WebsiteController@contact');
    Route::post('newsletter', 'WebsiteController@newsletter');
    Route::post('formRegister', 'WebsiteController@formRegister');
    Route::post('companies/media', 'WebsiteController@storeMedia')->name('forms.companies.storeMedia');
});

Route::prefix('registo')->group(function () {
    Route::get('/', 'WebsiteController@register');
    Route::get('/{plan_id}', 'WebsiteController@selectedRegister');
});

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home');
    }
    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'checkSubscription']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('subscription-type/{subscription_type_id}', 'HomeController@subscriptionType');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Register
    Route::delete('registers/destroy', 'RegisterController@massDestroy')->name('registers.massDestroy');
    Route::resource('registers', 'RegisterController');

    // Newsletter
    Route::delete('newsletters/destroy', 'NewsletterController@massDestroy')->name('newsletters.massDestroy');
    Route::resource('newsletters', 'NewsletterController');

    // Page
    Route::delete('pages/destroy', 'PageController@massDestroy')->name('pages.massDestroy');
    Route::post('pages/media', 'PageController@storeMedia')->name('pages.storeMedia');
    Route::post('pages/ckmedia', 'PageController@storeCKEditorImages')->name('pages.storeCKEditorImages');
    Route::resource('pages', 'PageController');

    // Plan
    Route::delete('plans/destroy', 'PlanController@massDestroy')->name('plans.massDestroy');
    Route::resource('plans', 'PlanController');

    // Plan Item
    Route::delete('plan-items/destroy', 'PlanItemController@massDestroy')->name('plan-items.massDestroy');
    Route::resource('plan-items', 'PlanItemController');

    // Company
    Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompanyController@storeMedia')->name('companies.storeMedia');
    Route::post('companies/ckmedia', 'CompanyController@storeCKEditorImages')->name('companies.storeCKEditorImages');
    Route::resource('companies', 'CompanyController');

    // Subscription Type
    Route::delete('subscription-types/destroy', 'SubscriptionTypeController@massDestroy')->name('subscription-types.massDestroy');
    Route::resource('subscription-types', 'SubscriptionTypeController');

    // Subscription
    Route::delete('subscriptions/destroy', 'SubscriptionController@massDestroy')->name('subscriptions.massDestroy');
    Route::resource('subscriptions', 'SubscriptionController');

    // Subscription Payment
    Route::delete('subscription-payments/destroy', 'SubscriptionPaymentController@massDestroy')->name('subscription-payments.massDestroy');
    Route::resource('subscription-payments', 'SubscriptionPaymentController');

    // Shop Category
    Route::delete('shop-categories/destroy', 'ShopCategoryController@massDestroy')->name('shop-categories.massDestroy');
    Route::post('shop-categories/media', 'ShopCategoryController@storeMedia')->name('shop-categories.storeMedia');
    Route::post('shop-categories/ckmedia', 'ShopCategoryController@storeCKEditorImages')->name('shop-categories.storeCKEditorImages');
    Route::resource('shop-categories', 'ShopCategoryController');

    // Shop Location
    Route::delete('shop-locations/destroy', 'ShopLocationController@massDestroy')->name('shop-locations.massDestroy');
    Route::resource('shop-locations', 'ShopLocationController');

    // Shop Type
    Route::delete('shop-types/destroy', 'ShopTypeController@massDestroy')->name('shop-types.massDestroy');
    Route::resource('shop-types', 'ShopTypeController');

    // Shop Taxes
    Route::delete('shop-taxes/destroy', 'ShopTaxesController@massDestroy')->name('shop-taxes.massDestroy');
    Route::resource('shop-taxes', 'ShopTaxesController');

    // Shop Company
    Route::delete('shop-companies/destroy', 'ShopCompanyController@massDestroy')->name('shop-companies.massDestroy');
    Route::post('shop-companies/media', 'ShopCompanyController@storeMedia')->name('shop-companies.storeMedia');
    Route::post('shop-companies/ckmedia', 'ShopCompanyController@storeCKEditorImages')->name('shop-companies.storeCKEditorImages');
    Route::resource('shop-companies', 'ShopCompanyController');

    // Shop Product Category
    Route::delete('shop-product-categories/destroy', 'ShopProductCategoryController@massDestroy')->name('shop-product-categories.massDestroy');
    Route::resource('shop-product-categories', 'ShopProductCategoryController');

    // Shop Product
    Route::delete('shop-products/destroy', 'ShopProductController@massDestroy')->name('shop-products.massDestroy');
    Route::post('shop-products/media', 'ShopProductController@storeMedia')->name('shop-products.storeMedia');
    Route::post('shop-products/ckmedia', 'ShopProductController@storeCKEditorImages')->name('shop-products.storeCKEditorImages');
    Route::resource('shop-products', 'ShopProductController');

    // Shop Product Variations
    Route::delete('shop-product-variations/destroy', 'ShopProductVariationsController@massDestroy')->name('shop-product-variations.massDestroy');
    Route::resource('shop-product-variations', 'ShopProductVariationsController');

    // Shop Product Feature
    Route::delete('shop-product-features/destroy', 'ShopProductFeatureController@massDestroy')->name('shop-product-features.massDestroy');
    Route::resource('shop-product-features', 'ShopProductFeatureController');

    // Shop Product Sub Category
    Route::delete('shop-product-sub-categories/destroy', 'ShopProductSubCategoryController@massDestroy')->name('shop-product-sub-categories.massDestroy');
    Route::resource('shop-product-sub-categories', 'ShopProductSubCategoryController');

    // My Categories
    Route::prefix('my-categories')->group(function () {
        Route::get('/', 'MyCategoriesController@index')->name('my-categories.index');
        Route::get('create', 'MyCategoriesController@create')->name('my-categories.create');
        Route::post('store', 'MyCategoriesController@store')->name('my-categories.store');
        Route::get('edit/{id}', 'MyCategoriesController@edit')->name('my-categories.edit');
        Route::put('update', 'MyCategoriesController@update')->name('my-categories.update');
        Route::post('destroy', 'MyCategoriesController@destroy')->name('my-categories.destroy');
    });

    // My Sub Categories
    Route::prefix('my-sub-categories')->group(function () {
        Route::get('index/{category_id?}', 'MySubCategoriesController@index')->name('my-sub-categories.index');
        Route::get('create/{category_id?}', 'MySubCategoriesController@create')->name('my-sub-categories.create');
        Route::post('store', 'MySubCategoriesController@store')->name('my-sub-categories.store');
        Route::get('edit/{id}', 'MySubCategoriesController@edit')->name('my-sub-categories.edit');
        Route::post('update', 'MySubCategoriesController@update')->name('my-sub-categories.update');
        ROute::post('destroy', 'MySubCategoriesController@destroy')->name('my-sub-categories.destroy');
    });

    // My Shop
    Route::prefix('my-shops')->group(function () {
        Route::get('/', 'MyShopController@index')->name('my-shops.index');
        Route::get('create', 'MyShopController@create');
        Route::post('store', 'MyShopController@store')->name('my-shops.store');
        Route::put('update/{shop_company_id}', 'MyShopController@update')->name('my-shops.update');
    });

    // My Product
    Route::prefix('my-products')->group(function () {
        Route::get('/', 'MyProductController@index')->name('my-products.index');
        Route::get('create', 'MyProductController@create')->name('my-products.create');
        Route::get('edit/{id}', 'MyProductController@edit')->name('my-products.edit');
        Route::post('new-shop-product-feature', 'MyProductController@newShopProductFeature');
        Route::get('shop-product-feature-list/{shop_product_id}', 'MyProductController@shopProductFeatureList');
        Route::get('delete-shop-product-feature/{shop_product_feature_id}', 'MyProductController@deleteShopProductFeature');
        Route::post('new-shop-product-variation', 'MyProductController@newShopProductVariation');
        Route::get('shop-product-variation-list/{shop_product_id}', 'MyProductController@shopProductVariationList');
        Route::get('delete-shop-product-variation/{shop_product_variation_id}', 'MyProductController@deleteShopProductVariation');
        Route::post('update-shop-product-variation-prices', 'MyProductController@updateShopProductVariationPrices');
        Route::get('product-list', 'MyProductController@productList');
        Route::post('position', 'MyProductController@position');
    });

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::middleware(['auth'])->prefix('payments')->group(function () {
    Route::post('subscriptionPaymentGenerate', 'PaymentsController@subscriptionPaymentGenerate');
    Route::get('mb/{subscriptionPayment}/{amount}', 'PaymentsController@mb');
    Route::post('sendMbByEmail', 'PaymentsController@sendMbByEmail');
    Route::get('mbway/{subscriptionPayment}/{amount}', 'PaymentsController@mbway');
    Route::post('submitMbway', 'PaymentsController@submitMbway');
    Route::get('list', 'PaymentsController@list');
    Route::post('selectSubscriptionType', 'PaymentsController@selectSubscriptionType');
});