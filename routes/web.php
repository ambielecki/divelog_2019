<?php

Auth::routes();

Route::get('calculator', 'DiveCalculatorController@getIndex')->name('calculator');

Route::get('/', 'HomeController@getHome')->name('home');

Route::group(['prefix' => '/blog'], function () {
    Route::get('/list', 'BlogController@getList')->name('blog_list');
    Route::get('/{slug}', 'BlogController@getView')->name('blog_view');
});

Route::group(['prefix' => '/dive-log'], function () {
    // Really just for the name, all will be handle by vue
    Route::get('/', 'DiveLogController@getApp')->name('dive_log_list');
    Route::get('/create', 'DiveLogController@getApp')->name('dive_log_create');
    Route::get('/edit/{dive_number}', 'DiveLogController@getEdit')->name('dive_log_edit');
    Route::fallback('DiveLogController@getApp');
});

Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'AdminController@getIndex')->name('admin');

    Route::group(['prefix' => 'home'], function () {
        Route::get('/{id?}', 'HomeController@getEdit')->name('admin_home_edit');
        Route::post('/', 'HomeController@postEdit');
    });

    Route::group(['prefix' => '/images'], function () {
        Route::get('/', 'ImageController@getAdminList')->name('admin_image_list');
        Route::get('/create', 'ImageController@getAdminCreate')->name('admin_image_create');
        Route::post('/create', 'ImageController@postAdminCreate');
        Route::get('/edit/{id}', 'ImageController@getAdminEdit')->name('admin_image_edit');
        Route::post('/edit/{id}', 'ImageController@postAdminEdit');
    });

    Route::group(['prefix' => '/blog'], function () {
        Route::get('/', 'BlogController@getAdminList')->name('admin_blog_list');
        Route::get('/create', 'BlogController@getAdminCreate')->name('admin_blog_create');
        Route::post('/create', 'BlogController@postAdminCreate');
        Route::get('/edit/{id}', 'BlogController@getAdminEdit')->name('admin_blog_edit');
        Route::post('/edit/{id}', 'BlogController@postAdminEdit');
    });

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('test', 'TestController@getTest');
});

// web api group
Route::group(['prefix' => '/api'], function () {
    Route::post('/heartbeat', 'HeartbeatController@postHeartbeat');

    Route::group(['prefix' => '/blog'], function () {
        Route::get('/list', 'BlogController@getApiList');
    });

    Route::group(['prefix' => '/dive-log'], function () {
        Route::get('/list', 'DiveLogController@getApiList');
        Route::get('/create', 'DiveLogController@getApiCreate');
        Route::get('/edit/{dive_number}', 'DiveLogController@getApiEdit');

        Route::post('/user', 'DiveLogController@postApiUser');
    });

    // admin api routes
    Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {
        // admin image api routes
        Route::group(['prefix' => '/images'], function () {
            Route::get('/', 'ImageController@getAdminApiList')->name('api_admin_image_list');
            Route::get('/{id}', 'ImageController@getAdminApiDetail')->name('api_admin_image_detail');
        });

        Route::group(['prefix' => '/blog'], function () {
            Route::post('/slug-check', 'BlogController@postAdminApiSlugCheck')->name('api_admin_blog_slug_check');
        });

        Route::group(['prefix' => '/home'], function () {
            Route::get('/list', 'HomeController@getApiList')->name('api_admin_home_list');
        });
    });
});
