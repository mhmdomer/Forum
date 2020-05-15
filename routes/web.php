<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('threads/create', 'ThreadsController@create')->name('threads.create');
Route::get('threads', 'ThreadsController@index')->name('threads.index');
Route::get('threads/{channel}', 'ThreadsController@index')->name('threads.channel');
Route::post('threads/', 'ThreadsController@store')->name('threads.store');
Route::patch('threads/{channel}/{thread}', 'ThreadsController@update')->name('threads.update');
Route::get('threads/{channel}/{id}', 'ThreadsController@show')->name('threads.show');
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy')->name('threads.destroy');
Route::post('favorite/threads/{thread}', 'FavoritesController@storeThread');
Route::delete('favorite/threads/{thread}', 'FavoritesController@destroyThread');

Route::post('threads/{thread}/lock', 'LockThreadsController@lock')->name('threads.lock');
Route::post('threads/{thread}/unlock', 'LockThreadsController@unlock')->name('threads.unlock');

Route::post('/threads/{channel}/{thread}/replies/', 'RepliesController@store');
Route::get('/threads/{channel}/{thread}/replies/', 'RepliesController@index');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');
Route::delete('/replies/{reply}', 'RepliesController@destroy');
Route::patch('/replies/{reply}', 'RepliesController@update');

Route::post('/replies/{reply}/best', 'BestRepliesController@store')->name('best-reply.store');

Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
Route::get('/query/profiles/{query}', 'ProfilesController@query')->name('profile.query');
Route::get('/profiles/{user}/notifications', 'UserNotifications@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotifications@destroy');
Route::post('/api/users/{user}/avatar', 'ProfilesController@storeAvatar')->name('avatar');
