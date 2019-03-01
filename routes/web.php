<?php

Auth::routes();
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('test', 'TestController@getTest');

Route::get('calculator', 'DiveCalculatorController@getIndex')->name('calculator');

Route::get('/', 'HomeController@getHome')->name('home');

Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'AdminController@getIndex');

    Route::group(['prefix' => '/images'], function () {
        Route::get('/', 'ImageController@getAdminList')->name('admin_image_list');
        Route::get('/create', 'ImageController@getAdminCreate')->name('admin_image_create');
        Route::post('/create', 'ImageController@postAdminCreate');
        Route::get('/edit/{id}', 'ImageController@getAdminEdit')->name('admin_image_edit');
        Route::post('/edit/{id}', 'ImageController@postAdminEdit');
    });
});
