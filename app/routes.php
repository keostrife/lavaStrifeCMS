<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/* Admin Stuffs */
Route::get('admin', 'AdminController@landing');
Route::post('admin/login', 'AdminController@login');
Route::get('admin/logout', 'AdminController@logout');
Route::get('admin/create', 'AdminController@create');
//End Admin Stuffs - Strife





Route::get('/', function()
{
	echo "test";
});



