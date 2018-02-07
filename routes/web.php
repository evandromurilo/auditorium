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

Route::get('/', 'AuditoriumController@index');
Route::get('/home', 'AuditoriumController@index')->name('home');

Auth::routes();

Route::get('/auditoria', 'AuditoriumController@index')->name('auditoria.index');

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('{user}', 'UserController@show')->name('show');
    Route::put('{user}', 'UserController@update')->name('update');

    Route::put('{user}/deactivate', 'UserController@deactivate')->name('deactivate');
    Route::put('{user}/activate', 'UserController@activate')->name('activate');
    Route::get('{user}/edit', 'UserController@edit')->name('edit');
    Route::get('{user}/calls', 'UserController@calls')->name('calls');
});

Route::prefix('requests')->name('requests.')->group(function () {
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

Route::prefix('calls')->name('calls.')->group(function () {
    Route::get('/', 'CallController@index')->name('index');
    Route::get('create', 'CallController@create')->name('create');
    Route::post('/', 'CallController@store')->name('store');
    Route::get('{call}', 'CallController@show')->name('show'); // TODO: rename

    Route::get('{call}/exit', 'CallController@getOut')->name('exit');
    Route::get('{call}/members', 'CallController@members')->name('members');
    Route::get('{call}/messages', 'CallController@messages')->name('messages');
});

Route::prefix('messages')->name('messages.')->group(function () {
    Route::post('/', 'MessageController@store')->name('store');
    Route::get('{message}', 'MessageController@show')->name('show'); // TODO: rename
});

Route::prefix('notifications')->name('notifications.')->group(function () {
    Route::get('clear', 'NotificationController@markAllAsRead')->name('markAllAsRead');
    Route::get('/', 'NotificationController@unreadNotifications')->name('index');
    Route::get('newmessage/{id}', 'NotificationController@markNewMessageAsRead');
    Route::get('{id}', 'NotificationController@markAsRead');
});


Route::get('/roles/setup', 'RoleController@setup');

Route::put('/requirements/{id}/grant', 'RequirementController@grant')->name('requirements.grant')->middleware('auth');
Route::put('/requirements/{id}/ungrant', 'RequirementController@ungrant')->name('requirements.ungrant')->middleware('auth');
Route::get('/requirements/{id}/verification', 'RequirementController@showVerification')->name('requirements.showVerification');
Route::put('/requirements/{id}/verification', 'RequirementController@updateVerification')->name('requirements.updateVerification');

Route::get('/blocked-dates/', 'BlockedDateController@index')->name('blocked-dates.index');
Route::post('/blocked-dates/', 'BlockedDateController@store')->name('blocked-dates.store');
Route::delete('/blocked-dates/', 'BlockedDateController@delete')->name('blocked-dates.delete');
Route::get('/blocked-dates.json/', 'BlockedDateController@all')->name('blocked-dates.all');
