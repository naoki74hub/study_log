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

Route::group(['prefix' => 'posts', 'as' => 'posts.', 'middleware' => 'auth'], function() {
    Route::get('index', 'PostController@index')->name('index');
    Route::get('create', 'PostController@create')->name('create');
    Route::post('store', 'PostController@store')->name('store');
    Route::get('twitter/create', 'TwitterController@create')->name('twitter.create');
    Route::post('twitter/store', 'TwitterController@store')->name('twitter.store');
    Route::get('{post}/edit', 'PostController@edit')->name('edit');
    Route::post('{post}/update', 'PostController@update')->name('update');
    Route::post('{post}/destroy', 'PostController@destroy')->name('destroy');
    Route::get('{post}/', 'PostController@show')->name('show');
    Route::post('search', 'PostController@search')->name('search');
    Route::post('{post}/follow', 'PostController@follow')->name('follow');
    Route::delete('{post}/unfollow', 'PostController@unfollow')->name('unfollow');
    Route::get('followings/timeline', 'PostController@timeline')->name('followings.timeline');
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('users', 'UserController');
    Route::resource('comments', 'CommentController');
});

Route::group(['prefix' => 'comments', 'as' => 'replies.', 'middleware' => 'auth'], function() {
    Route::get('{comment}/reply/create', 'ReplyController@create')->name('create');
    Route::post('{comment}/reply/store', 'ReplyController@store')->name('store');
    Route::get('{comment}/reply/{reply}/edit', 'ReplyController@edit')->name('edit');
    Route::post('{comment}/reply/{reply}/update', 'ReplyController@update')->name('update');
    Route::get('{comment}/reply/{reply}/destroy', 'ReplyController@destroy')->name('destroy');
});

Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth'], function() {
    Route::get('{name}/followings', 'UserController@followings')->name('followings');
    Route::get('{name}/followers', 'UserController@followers')->name('followers');
    Route::post('{user}/follow', 'UserController@follow')->name('follow');
    Route::delete('{user}/unfollow', 'UserController@unfollow')->name('unfollow');
});

Route::group(['prefix' => 'folders', 'as' => 'folders.', 'middleware' => 'auth'], function() {
   Route::get('{folder}/tasks', 'TaskController@index')->name('index');
   Route::get('create', 'FolderController@create')->name('create');
   Route::post('store', 'FolderController@store')->name('store');
   Route::post('{folder}/destroy', 'FolderController@destroy')->name('destroy');
   Route::get('{folder}/edit', 'FolderController@edit')->name('edit');
   Route::post('{folder}/update', 'FolderController@update')->name('update');
   Route::get('{folder}/tasks/create', 'TaskController@create')->name('tasks.create');
   Route::post('{folder}/tasks/store', 'TaskController@store')->name('tasks.store');
   Route::get('{folder}/tasks/{task}/edit', 'TaskController@edit')->name('tasks.edit');
   Route::post('{folder}/tasks/{task}/update', 'TaskController@update')->name('tasks.update');
   Route::post('{folder}/tasks/{task}/destroy', 'TaskController@destroy')->name('tasks.destroy');
});  

Auth::routes();

//Googleログイン
Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
//GoogleコールバックURL
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');
//Twitterログイン
Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
//TwitterコールバックURL
Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterProviderCallback');
//ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

//いいねボタン
Route::post('posts/{post}/likes', 'LikeController@store')->name('likes');
Route::post('posts/{post}/unlikes', 'LikeController@destroy')->name('unlikes');
Route::get('posts/{post}/likes/users', 'PostController@getLikesUsers')->name('likes.users');

Route::get('/home', 'HomeController@index')->name('home');
