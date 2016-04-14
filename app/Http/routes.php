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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

/* Tasks routes */

Route::get('delete_task/{id}',['uses' =>'TaskController@destroy']);

Route::post('store_task', [
	'as' => 'storeTask',
	'uses' => 'TaskController@store'
]);

/* Tags routes */

Route::get('delete_tag/{id}',['uses' =>'TagController@destroy']);

Route::post('store_tag', [
	'as' => 'storeTag',
	'uses' => 'TagController@store'
]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
