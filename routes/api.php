<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('calculator', 'DiveCalculatorController@getApiCalculation');

// TODO :: Setup passport
Route::group(['prefix' => '/admin'], function () {
    Route::group(['prefix' => '/images'], function () {
        Route::get('/', 'ImageController@getAdminApiList')->name('api_admin_image_list');
        Route::get('/{id}', 'ImageController@getAdminApiView')->name('api_admin_image_view');
    });
});
