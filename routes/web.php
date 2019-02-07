<?php

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::group(['prefix' => '/admin'], function() {
    Route::get('/', 'FallbackController@getAdminFallback');
    Route::fallback('FallbackController@getAdminFallback');
});

Route::fallback('FallbackController@getWebFallback');
