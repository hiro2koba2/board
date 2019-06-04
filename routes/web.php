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

// タグ検索のルート
Route::get('tags/{id}', 'SearchPostWithTagController')->name('TagSearch');

// 特定ユーザーのポストだけを返すルート
Route::get('users/{id}', 'UsersPostSearchController')->name('UserSearch');

// 特定のユーザーがいいねしたポストを返すルート
Route::get('users/{id}/likes', 'UserLikesPostsController')->name('UserLikes');

Route::resource('avatar', 'AvatarController', ['only' => ['index', 'store']]);

Route::resource('posts', 'PostsController');

//コメント投稿はログイン　新規投稿も追加する　リダイレクトを決める
Route::group(['middleware' => 'auth'], function() {
    Route::resource('comments', 'CommentsController', ['only' => ['store']]);

    Route::post('posts/{id}/likes', 'LikesController@like');

    Route::delete('posts/{id}/likes/{like_id}', 'LikesController@unlike');
});

