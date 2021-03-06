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


Route::get('/', function () {
	return view('spark::welcome');
});

Route::get('home',  ['middleware' => 'auth', 'uses' => 'LogController@show']);

Route::get('spark', ['middleware' => 'auth', function () {
	return view('home');
}]);