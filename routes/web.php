<?php
/**
 * Web Routes
 *--------------------------------------------------------------------------
 **/

if (config('app.env') == 'local' or config('app.debug')) {
    Route::group(['as' => '_tools.'], function () {
        Route::get('routes', ['as' => 'routes', 'uses' => 'Tools@showAppRoutes']);
        Route::get('console', ['as' => 'console', 'uses' => 'Tools@showWebConsole']);
    });
}

//-------------AUTHENTICATION, REGISTRATION & PASSWORD RESET ROUES-----------------//
Route::group(['as' => 'auth.', 'namespace' => 'Auth'], function () {
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

Route::group(['namespace' => 'Web'], function () {

    Route::group(['as'=>'app.'], function (){
        Route::get('/', ['as' => 'home', 'uses' => 'PublicController@showHomePage']);
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth' => 'auth']], function () {
        Route::get('/', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);

        Route::group(['prefix' => 'exercises', 'as' => 'exercises.'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'AdminController@listExercises']);
            Route::get('get', ['as' => 'get', 'uses' => 'AdminController@getExerciseInfo']);
            Route::post('create', ['as' => 'create', 'uses' => 'AdminController@createExercise']);
            Route::post('update', ['as' => 'update', 'uses' => 'AdminController@updateExercise']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'AdminController@deleteExercise']);
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'AdminController@listUsers']);
            Route::get('get', ['as' => 'get', 'uses' => 'AdminController@getUserInfo']);
            Route::post('create', ['as' => 'create', 'uses' => 'AdminController@createUser']);
            Route::post('update', ['as' => 'update', 'uses' => 'AdminController@updateUser']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'AdminController@deleteUser']);
        });

        Route::match(['get', 'post'], 'settings', ['as' => 'settings', 'uses' => 'AdminController@settings']);

        Route::group(['prefix' => 'notifications', 'as' => 'notes.'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'AdminController@listNotifications']);
            Route::get('get', ['as' => 'get', 'uses' => 'AdminController@getNotificationInfo']);
            Route::post('update', ['as' => 'update', 'uses' => 'AdminController@updateNotification']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'AdminController@deleteNotification']);
        });

    });

    //-------------USER ACCOUNT ROUTES-----------------//
    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth' => 'auth']], function () {

        Route::get('/', ['as' => 'showOrGet', 'uses' => 'ProfileController@showOrGet']);
        Route::post('update', ['as' => 'update', 'uses' => 'ProfileController@update']);
        Route::post('photo', ['as' => 'photo', 'uses' => 'ProfileController@photo']);
        Route::post('password', ['as' => 'password', 'uses' => 'ProfileController@password']);
    });

});
