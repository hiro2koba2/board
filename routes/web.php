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

Route::get('/', 'PostController@index')->name('index');

Auth::routes();

Route::get('profile', 'AvatarController@index')->name('profile');

// タグ検索のルート
Route::get('tags/{id}', 'SearchPostsWithTagController')->name('TagSearch');

// 特定ユーザーのポストだけを返すルート
Route::get('users/{id}', 'SearchUsersPostsController')->name('UserSearch');

Route::resource('avatar', 'AvatarController', ['only' => ['index', 'store']]);

Route::resource('posts', 'PostController');

// ログインしてないとできないやつ　ルートの段階で処理する
Route::group(['middleware' => 'auth'], function() {

    //コメント投稿
    Route::resource('comments', 'CommentController', ['only' => ['store']]);

    // いいね
    Route::post('posts/{id}/likes', 'LikeController@like');

    // いいね解除
    Route::delete('posts/{id}/likes/{like_id}', 'LikeController@unlike');

    // 特定のユーザーがいいねしたポストを返すルート
    Route::get('users/{id}/likes', 'UserLikesPostsController')->name('UserLikes');
});


