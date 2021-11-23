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
Route::group(['prefix'=>'posts','as'=>'posts.','middleware'=>'auth'],function() {
    Route::get('index','PostController@index')->name('index');
    Route::get('create','PostController@create')->name('create');
    Route::post('store','PostController@store')->name('store');
    Route::get('{post}/edit','PostController@edit')->name('edit');
    Route::post('{post}/update','PostController@update')->name('update');
    Route::post('{post}/destroy','PostController@destroy')->name('destroy');
    Route::get('{post}/','PostController@show')->name('show');
    Route::post('search','PostController@search')->name('search');
    Route::post('{post}/follow','PostController@follow')->name('follow');
    Route::delete('{post}/unfollow','PostController@unfollow')->name('unfollow');
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('users','UserController');
    Route::resource('comments','CommentController');
});

Route::group(['prefix'=>'folders','as'=>'folders.','middleware'=>'auth'],function() {
Route::get('{id}/tasks','TaskController@index')->name('tasks.index');
Route::get('create','FolderController@create')->name('create');
Route::post('store','FolderController@store')->name('store');
Route::get('{id}/tasks/create','TaskController@create')->name('tasks.create');
Route::post('{id}/tasks/store','TaskController@store')->name('tasks.store');
Route::get('{id}/tasks/{task_id}/edit','TaskController@edit')->name('tasks.edit');
Route::post('{id}/tasks/{task_id}/update','TaskController@update')->name('tasks.update');
Route::post('{id}/tasks/{task_id}/destroy','TaskController@destroy')->name('tasks.destroy');
});   
Auth::routes();

Route::post('posts/{post}/likes','LikeController@store')->name('likes');
Route::post('posts/{post}/unlikes','LikeController@destroy')->name('unlikes');


Route::get('/home', 'HomeController@index')->name('home');
