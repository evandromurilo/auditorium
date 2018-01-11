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

Route::get('/calls/{call}/exit', 'CallController@getOut')->name('calls.exit');
Route::get('/calls/{call}/members', 'CallController@members')->name('calls.members');
Route::get('/calls/{call}/messages', 'CallController@messages')->name('calls.messages');

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

Route::get('/roles/setup', 'RoleController@setup');

Route::put('/requirements/{id}/grant', 'RequirementController@grant')->name('requirements.grant')->middleware('auth');
Route::put('/requirements/{id}/ungrant', 'RequirementController@ungrant')->name('requirements.ungrant')->middleware('auth');
Route::get('/requirements/{id}/verification', 'RequirementController@showVerification')->name('requirements.showVerification');
Route::put('/requirements/{id}/verification', 'RequirementController@updateVerification')->name('requirements.updateVerification');

Route::get('/blocked-dates/', 'BlockedDateController@index')->name('blocked-dates.index');
Route::post('/blocked-dates/', 'BlockedDateController@store')->name('blocked-dates.store');
Route::delete('/blocked-dates/', 'BlockedDateController@delete')->name('blocked-dates.delete');
Route::get('/blocked-dates.json/', 'BlockedDateController@all')->name('blocked-dates.all');
