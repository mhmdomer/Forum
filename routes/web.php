<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('threads/create', 'ThreadController@create')->name('threads.create');
Route::get('threads', 'ThreadController@index')->name('threads.index');
Route::get('threads/{channel}', 'ThreadController@index')->name('threads.index');
Route::post('threads/', 'ThreadController@store')->name('threads.store');
Route::get('threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');
Route::post('/threads/{channel}/{thread}/replies/', 'ReplyController@store')->name('replies.store');
// Route::get('/threads/{channel}', 'ChannelController@show')->name('channels.show')->where(['channel' => '[a-z]+']);

