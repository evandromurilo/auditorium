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

Route::get('/', 'AuditoriumController@index')
    ->middleware('auth')
    ->name('home');

Route::redirect('/home', '/', 301);

Auth::routes();

Route::prefix('users')->name('users.')->middleware('auth')->group(function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('{user}', 'UserController@show')->name('show');
    Route::put('{user}', 'UserController@update')->name('update');

    Route::put('{user}/deactivate', 'UserController@deactivate')->name('deactivate');
    Route::put('{user}/activate', 'UserController@activate')->name('activate');
    Route::get('{user}/edit', 'UserController@edit')->name('edit');
    Route::get('{user}/calls', 'UserController@calls')->name('calls');
});

Route::prefix('requests')->name('requests.')->middleware('auth')->group(function () {
    Route::get('/', 'RequestController@index')->name('index');
    Route::get('create', 'RequestController@create')->name('create');
    Route::post('/', 'RequestController@store')->name('store');
    Route::get('{request}', 'RequestController@show')->name('show');
    Route::match(['put', 'patch'], '{request}', 'RequestController@update')->name('update');

    Route::get('{request}/modal', 'RequestController@modal')->name('modal');
    Route::get('{request}/accept', 'RequestController@accept')->name('accept');
    Route::put('{request}/negate', 'RequestController@negate')->name('negate');
    Route::put('{request}/pending', 'RequestController@pending')->name('pending');
});

Route::prefix('calls')->name('calls.')->middleware('auth')->group(function () {
    Route::get('/', 'CallController@index')->name('index');
    Route::get('create', 'CallController@create')->name('create');
    Route::post('/', 'CallController@store')->name('store');
    Route::get('{call}', 'CallController@show')->name('show'); // TODO: rename

    Route::get('{call}/exit', 'CallController@getOut')->name('exit');
    Route::get('{call}/members', 'CallController@members')->name('members');
    Route::get('{call}/messages', 'CallController@messages')->name('messages');
});

Route::prefix('messages')->name('messages.')->middleware('auth')->group(function () {
    Route::post('/', 'MessageController@store')->name('store');
    Route::get('{message}', 'MessageController@show')->name('show'); // TODO: rename
});

Route::prefix('notifications')->name('notifications.')->middleware('auth')->group(function () {
    Route::get('clear', 'NotificationController@markAllAsRead')->name('markAllAsRead');
    Route::get('/', 'NotificationController@unreadNotifications')->name('index');
    Route::get('newmessage/{id}', 'NotificationController@markNewMessageAsRead');
    Route::get('{id}', 'NotificationController@markAsRead');
});

Route::prefix('requirements')->name('requirements.')->group(function () {
    Route::put('{requirement}/grant', 'RequirementController@grant')
        ->name('grant')->middleware('auth');
    Route::put('{requirement}/ungrant', 'RequirementController@ungrant')
        ->name('ungrant')->middleware('auth');
    Route::get('{requirement}/verification', 'RequirementController@showVerification')
        ->name('showVerification');
    Route::put('{requirement}/verification', 'RequirementController@updateVerification')
        ->name('updateVerification');
});

Route::prefix('blocked-dates')->name('blocked-dates.')->middleware('auth')->group(function () {
    Route::get('/', 'BlockedDateController@index')->name('index');
    Route::post('/', 'BlockedDateController@store')->name('store');
    Route::delete('{blocked_date}', 'BlockedDateController@delete')->name('delete');
    Route::get('all.json', 'BlockedDateController@all')->name('all');
});

