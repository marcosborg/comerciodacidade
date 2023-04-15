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