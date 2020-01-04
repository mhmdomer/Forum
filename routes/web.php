<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('threads/create', 'ThreadsController@create')->name('threads.create');
Route::get('threads', 'ThreadsController@index')->name('threads.index');
Route::get('threads/{channel}', 'ThreadsController@index')->name('threads.index');
Route::post('threads/', 'ThreadsController@store')->name('threads.store');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show')->name('threads.show');
Route::post('/threads/{channel}/{thread}/replies/', 'RepliesController@store')->name('replies.store');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store')->name('reply.favorite');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
