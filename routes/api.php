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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api'], function () {

    Route::post('authenticate', 'AuthenticateController@authenticate');

    // api認証通ったものだけ通れる 認証方法はjwtを今回は使う
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('me', 'AuthenticateController@getCurrentUser');

        Route::apiResource('posts', 'Api\PostController');
    });

});



