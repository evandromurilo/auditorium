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
/* Route::get('requests', 'RequestController@index')->name('requests.index'); */
/* Route::get('requests/create', 'RequestController@create')->name('requests.create'); */
/* Route::post('requests', 'RequestController@store')->name('requests.store'); */
/* Route::put('requests/{request}', 'RequestController@update')->name('requests.update'); */

Route::get('/auditoria', 'AuditoriumController@index')->name('auditoria.index');
