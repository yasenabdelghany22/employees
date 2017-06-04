<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
		'uses' => 'NiceActionController@getHome',
		'as' => 'home'
	]);

Route::get('/{action}/{name?}',[
		'uses' => 'NiceActionController@getNiceAction',
		'as' => 'niceaction'
	]);

// Route::get('/hug',function(){
// 	return view('actions.hug');
// })->name('hug');

// Route::get('/kiss',function(){
// 	return view('actions.kiss');
// })->name('kiss');

Route::post('/add_action',[
		'uses' => 'NiceActionController@postInsertNiceAction',
		'as' => 'add_action'
	]);