<?php

Auth::routes();
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('test', 'TestController@getTest');

Route::get('calculator', 'DiveCalculatorController@getIndex');

Route::get('/', 'HomeController@getHome')->name('home');

Route::group(['prefix' => '/admin'], function () {
    Route::get('/', 'FallbackController@getAdminFallback');
    Route::fallback('FallbackController@getAdminFallback');
});

Route::fallback('FallbackController@getWebFallback');
