<?php

Auth::routes();

Route::get('calculator', 'DiveCalculatorController@getIndex')->name('calculator');

Route::get('/', 'HomeController@getHome')->name('home');
Route::get('/image/{folder}/{file_name}', 'ImageController@getImage')->name('images');

Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'AdminController@getIndex')->name('admin');

    Route::group(['prefix' => '/images'], function () {
        Route::get('/', 'ImageController@getAdminList')->name('admin_image_list');
        Route::get('/create', 'ImageController@getAdminCreate')->name('admin_image_create');
        Route::post('/create', 'ImageController@postAdminCreate');
        Route::get('/edit/{id}', 'ImageController@getAdminEdit')->name('admin_image_edit');
        Route::post('/edit/{id}', 'ImageController@postAdminEdit');
    });

    Route::group(['prefix' => 'home'], function () {
        Route::get('/{id?}', 'HomeController@getEdit')->name('admin_home_edit');
        Route::post('/', 'HomeController@postEdit');
    });

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('test', 'TestController@getTest');
});

// web api group
Route::group(['prefix' => '/api'], function () {
    Route::post('/heartbeat', 'HeartbeatController@postHeartbeat');

    // admin api routes
    Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {
        // admin image api routes
        Route::group(['prefix' => '/images'], function () {
            Route::get('/', 'ImageController@getAdminApiList')->name('api_admin_image_list');
            Route::get('/{id}', 'ImageController@getAdminApiDetail')->name('api_admin_image_detail');
        });
    });
});
