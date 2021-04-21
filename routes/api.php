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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('temp', 'Api\V1\AuthController@temp');

Route::group(['namespace' => 'Api\V1','prefix' => 'v1'], function(){

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
  
    Route::get('temp', 'AuthController@temp');
    Route::get('exceptionTest', 'AuthController@exceptionTest');

    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('logout', 'AuthController@logout');
        Route::resource('products', 'ProductController');
        Route::get('test', 'ProductController@test');

    });
});
