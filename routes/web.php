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
    Route::post('like', 'PostController@like')->name('like');
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('/users','UserController');
    Route::resource('comments','CommentController');
    Route::get('time','PostController@time')->name('time');
});
   
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
