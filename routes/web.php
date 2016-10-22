<?php
/**
 * Web Routes
 *--------------------------------------------------------------------------
**/

if (config('app.env') == 'local' or config('app.debug')) {
    $view_dir = '_tools.';
    Route::group(['as' => '_tools.'], function () use ($view_dir) {
        Route::get('/routes', ['as' => 'routes', 'uses' => 'WebController@showAppRoutes']);
        Route::get('/console', ['as' => 'console', 'uses' => 'WebController@showAppConsole']);
    });
}

Route::group(['as' => 'app.'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'WebController@showAppHome']);
});

//-------------AUTHENTICATION, REGISTRATION & PASSWORD RESET ROUES-----------------//
Route::group(['as' => 'auth.', 'namespace' => 'Core\Auth'], function () {
    // Authentication Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'LoginController@logout'])->middleware(['m' => 'auth']);

    // Registration Routes...
    Route::get('signup', ['as' => 'signup', 'uses' => 'RegisterController@showRegistrationForm']);
    Route::post('signup', ['as' => 'signup', 'uses' => 'RegisterController@register']);

    // Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset', 'uses' => 'ResetPasswordController@reset']);
});
