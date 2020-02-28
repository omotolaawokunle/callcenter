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

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contact', 'ContactController@index')->name('contact');

Route::get('/call', 'CallController@index')->name('call');

Route::get('/sms', 'SMSController@index')->name('sms');

Route::get('/history', 'ContactController@index')->name('history');

Route::post('/contact/create', 'ContactController@store');

Route::post('/call/create', 'CallController@store');

Route::post('/sms/create', 'SMSController@store');

Route::get('/contact/{id}/delete', 'ContactController@destroy');

Route::patch('/contact/{id}', 'ContactController@update');

Route::get('/broadcast', 'BroadcastController@index');

Route::post('/broadcast/sendBroadcast', 'BroadcastController@processForm');

Route::post('/broadcast/processAudio', 'BroadcastController@processAudio');

Route::post('/broadcast/deleteAudio', 'BroadcastController@deleteAudio');
