<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('threads', 'ThreadController')->except(['show']);
Route::get('threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');
Route::post('/threads/{channel}/{thread}/replies/', 'ReplyController@store')->name('replies.store');
Route::get('/threads/{channel}', 'ChannelController@show')->name('channels.show')->where(['channel' => '[a-z]+']);

