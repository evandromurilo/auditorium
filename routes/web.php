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

Route::get('/notifications', 'NotificationController@unreadNotifications')->name('notifications');
Route::get('/notifications/newmessage/{id}', 'NotificationController@markNewMessageAsRead');

/* Route::put('/messages', 'MessageController@store')->name('messages.store'); */
/* Route::put('/calls', 'CallController@store')->name('calls.store'); */
/* Route::get('/calls/{call}', 'CallController@show')->name('calls.show'); */
/* Route::get('/calls/create', 'CallController@create')->name('calls.create'); */

Route::get('/roles/setup', 'RoleController@setup');
