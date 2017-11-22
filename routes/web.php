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

Route::resource('requests', 'RequestController');
Route::resource('calls', 'CallController');
Route::get('/calls/{call}/exit', 'CallController@getOut')->name('calls.exit');
Route::resource('messages', 'MessageController');
/* Route::get('requests', 'RequestController@index')->name('requests.index'); */
/* Route::get('requests/create', 'RequestController@create')->name('requests.create'); */
/* Route::post('requests', 'RequestController@store')->name('requests.store'); */
/* Route::put('requests/{request}', 'RequestController@update')->name('requests.update'); */

/* Route::get('/events', 'EventController@index')->name('events.index'); */
Route::get('/auditoria', 'AuditoriumController@index')->name('auditoria.index');

Route::put('/users/{user}', 'UserController@update')->name('users.update');
Route::get('/users/{user}', 'UserController@show')->name('users.show');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}/calls', 'UserController@calls')->name('users.calls');

Route::get('/notifications/clear', 'NotificationController@markAllAsRead')
	->name('notifications.markAllAsRead');
Route::get('/notifications', 'NotificationController@unreadNotifications')->name('notifications');
Route::get('/notifications/newmessage/{id}', 'NotificationController@markNewMessageAsRead');
Route::get('/notifications/{id}', 'NotificationController@markAsRead');

Route::get('/requests/{id}/modal', 'RequestController@modal')->name('requests.modal');
Route::get('/requests/{id}/accept', 'RequestController@accept')->name('requests.accept');
Route::get('/requests/{id}/negate', 'RequestController@negate')->name('requests.negate');
Route::get('/requests/{id}/pending', 'RequestController@pending')->name('requests.pending');

/* Route::put('/messages', 'MessageController@store')->name('messages.store'); */
/* Route::put('/calls', 'CallController@store')->name('calls.store'); */
/* Route::get('/calls/{call}', 'CallController@show')->name('calls.show'); */
/* Route::get('/calls/create', 'CallController@create')->name('calls.create'); */

Route::get('/roles/setup', 'RoleController@setup');
