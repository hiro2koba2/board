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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PostsController@index')->name('index');

Route::resource('posts', 'PostsController');

Route::resource('comments', 'CommentsController', ['only' => ['store']]);

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// apiの確認
Route::get('/api/notifications', function () {
  return [
      [
          'id'      => 1,
          'message' => 'message 1',
      ],
      [
          'id'      => 2,
          'message' => 'message 2',
      ],
  ];
});
