<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Auth::routes();

Route::get('threads/create', 'ThreadsController@create')->name('threads.create');
Route::get('threads', 'ThreadsController@index')->name('threads.index');
Route::get('threads/{channel}', 'ThreadsController@index')->name('threads.channel');
Route::post('threads/', 'ThreadsController@store')->name('threads.store');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show')->name('threads.show');
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy')->name('threads.delete');
Route::post('/threads/{channel}/{thread}/replies/', 'RepliesController@store')->name('replies.store');
Route::get('/threads/{channel}/{thread}/replies/', 'RepliesController@index')->name('replies.index');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store')->name('reply.favorite');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy')->name('reply.un_favorite');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('reply.delete');
Route::patch('/replies/{reply}', 'RepliesController@update')->name('reply.update');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store');
