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
Route::any('admin/login', 'AdminController@login');
Route::any('admin/logout', 'AdminController@logout');
Route::any('admin/create', 'AdminController@create');
Route::any('admin/build', 'AdminController@build');
Route::any('admin/update', 'AdminController@update');
Route::any('admin/delete', 'AdminController@delete');
//End Admin Stuffs



Route::get('/', 'HomeController@home');

