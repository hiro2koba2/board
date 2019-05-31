<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PostsController@index')->name('index');

Auth::routes();

Route::get('profile', 'AvatarController@index')->name('profile');

Route::get('tags/{id}', 'SearchPostWithTagController')->name('TagSearch');

Route::get('users/{id}', 'UsersPostSearchController')->name('UserSearch');

Route::resource('avatar', 'AvatarController', ['only' => ['index', 'store']]);

Route::resource('posts', 'PostsController');

//コメント投稿フォームページ
Route::group(['middleware' => 'auth'], function() {
    Route::resource('comments', 'CommentsController', ['only' => ['store']]);
});