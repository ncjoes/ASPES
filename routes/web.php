<?php
/**
 * Web Routes
 *--------------------------------------------------------------------------
 **/

if (config('app.env') == 'local' or config('app.debug')) {
    Route::group(['as' => '_tools.'], function () {
        Route::get('routes', ['as' => 'routes', 'uses' => 'Tools@showAppRoutes']);
        Route::get('console', ['as' => 'console', 'uses' => 'Tools@showWebConsole']);
        Route::get('tester', [
            'as' => 'tester', 'uses' => function () {
                //return (\App\Models\Evaluator::find(5))->getComparisonMatrix();
                //return (\App\Models\Factor::find(1))->getRawWeight();
                //return (\App\Models\Exercise::find(2))->getResult();
                //return (\App\Models\Subject::find(3))->getEvaluationMatrix();
                return Lapack::eigenValues([
                    [1, 2, 3],
                    [4, 5, 6],
                    [7, 8, 9]
                ]);
            }
        ]);
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

    Route::group(['as' => 'app.'], function () {
        Route::get('/', ['as' => 'home', 'uses' => 'PublicController@home']);

        Route::group(['prefix' => 'results', 'as' => 'results.'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'PublicController@listResults']);
            Route::get('{id}', ['as' => 'view', 'uses' => 'PublicController@viewResult']);
        });
        Route::group(['prefix' => 'live', 'as' => 'live.'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'PublicController@listLiveExercises']);
            Route::get('eval/{id}', ['as' => 'evaluate', 'uses' => 'PublicController@showEvaluationForm'])->middleware('auth');
            Route::post('evaluate', ['as' => 'evaluate.submit', 'uses' => 'PublicController@processEvaluationForm'])->middleware('auth');
            Route::post('compare', ['as' => 'compare.submit', 'uses' => 'PublicController@processComparisonForm'])->middleware('auth');
        });
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth' => 'auth']], function () {
        Route::get('/', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);

        Route::group(['prefix' => 'exercises', 'as' => 'exercises.'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'AdminController@listExercises']);
            Route::get('view', ['as' => 'view', 'uses' => 'AdminController@viewExercise']);
            Route::get('edit', ['as' => 'edit', 'uses' => 'AdminController@editExercise']);
            Route::post('save', ['as' => 'update', 'uses' => 'AdminController@saveExercise']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'AdminController@deleteExercise']);
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'AdminController@listUsers']);
            Route::get('view', ['as' => 'view', 'uses' => 'AdminController@getUserInfo']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'AdminController@deleteUser']);
        });

        Route::match(['get', 'post'], 'settings', ['as' => 'settings', 'uses' => 'AdminController@settings']);

        Route::group(['prefix' => 'notifications', 'as' => 'notes.'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'AdminController@listNotifications']);
            Route::get('view', ['as' => 'view', 'uses' => 'AdminController@getNotificationInfo']);
            Route::post('update', ['as' => 'update', 'uses' => 'AdminController@updateNotification']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'AdminController@deleteNotification']);
        });
    });

    //-------------USER ACCOUNT ROUTES-----------------//
    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth' => 'auth']], function () {

        Route::get('/', ['as' => 'view', 'uses' => 'ProfileController@showOrGet']);
        Route::post('update', ['as' => 'update', 'uses' => 'ProfileController@update']);
        Route::post('photo', ['as' => 'photo', 'uses' => 'ProfileController@photo']);
        Route::post('password', ['as' => 'password', 'uses' => 'ProfileController@password']);
    });
});
