<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function() {
    Route::group(['prefix' => 'tracking', 'as' => 'tracking.'], function(){
        // Route untuk gis wisata (map)
        Route::post('/get_all_wisata', 'Api\WisataController@get_all_wisata')->name('get_all_wisata');
        Route::post('/get_all_wisata_front', 'Api\WisataController@get_all_wisata_front')->name('get_all_wisata_front');

    });
});
